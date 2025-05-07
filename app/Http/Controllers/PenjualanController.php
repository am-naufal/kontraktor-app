<?php

namespace App\Http\Controllers;

use App\Exports\PenjualanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Penjualan;
use Illuminate\Support\Str;
use App\Models\PenjualanDetail;
use App\Models\Proyek;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penjualan::with('user', 'proyek');

        if ($request->filled('search')) {
            $query->where('invoice', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal_penjualan', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal_penjualan', '<=', $request->tanggal_selesai);
        }

        $penjualans = $query->latest()->paginate(10);

        return view('penjualans.index', compact('penjualans'));
    }

    public function create()
    {
        $proyeks = Proyek::all();
        $barangs = Barang::all();
        $mandors = User::where('role', 'mandor')->get();

        return view('penjualans.create', compact('proyeks', 'barangs', 'mandors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_proyek' => 'required|exists:proyeks,id',
            'tanggal_penjualan' => 'required|date',
            'foto' => 'nullable|image|max:2048',
            'keterangan' => 'nullable|string',
            'details' => 'required|array|min:1',
            'details.*.id_barang' => 'required|exists:barangs,id',
            'details.*.jumlah' => 'required|integer|min:1',
            'details.*.harga_satuan' => 'required|numeric|min:0',
        ]);

        $data = $request->only([
            'id_user',
            'id_proyek',
            'tanggal_penjualan',
            'keterangan'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('penjualan_foto', 'public');
        }

        // Generate kode invoice
        $data['invoice'] = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6));

        // Hitung total dari detail
        $totalBarang = count($request->details);
        $totalHarga = collect($request->details)->sum(function ($item) {
            return $item['jumlah'] * $item['harga_satuan'];
        });

        $data['total_barang'] = $totalBarang;
        $data['total_harga'] = $totalHarga;

        $penjualan = Penjualan::create($data);

        foreach ($request->details as $detail) {
            PenjualanDetail::create([
                'id_penjualan' => $penjualan->id,
                'id_barang' => $detail['id_barang'],
                'jumlah' => $detail['jumlah'],
                'harga_satuan' => $detail['harga_satuan'],
                'subtotal' => $detail['jumlah'] * $detail['harga_satuan'],
            ]);
        }

        return redirect()->route('penjualans.index')->with('success', 'Data penjualan berhasil ditambahkan');
    }

    public function show(Penjualan $penjualan)
    {
        $penjualan->load('user', 'proyek', 'details.barang');
        return view('penjualans.show', compact('penjualan'));
    }
    public function export()
    {
        return Excel::download(new PenjualanExport, 'laporan-penjualan.xlsx');
    }

    public function edit(Penjualan $penjualan)
    {
        $mandors = User::where('role', 'mandor')->get();
        $proyeks = Proyek::all();
        $barangs = Barang::all();
        $penjualan->load('details.barang');
        return view('penjualans.edit', compact('penjualan', 'mandors', 'proyeks', 'barangs'));
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_proyek' => 'required|exists:proyeks,id',
            'tanggal_penjualan' => 'required|date',
            'foto' => 'nullable|image|max:2048',
            'keterangan' => 'nullable|string',
            'details' => 'required|array|min:1',
            'details.*.id_barang' => 'required|exists:barangs,id',
            'details.*.jumlah' => 'required|integer|min:1',
            'details.*.harga_satuan' => 'required|numeric|min:0',
        ]);

        $data = $request->only([
            'id_user',
            'id_proyek',
            'tanggal_penjualan',
            'keterangan'
        ]);

        // Update foto jika ada upload baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($penjualan->foto && Storage::disk('public')->exists($penjualan->foto)) {
                Storage::disk('public')->delete($penjualan->foto);
            }
            $data['foto'] = $request->file('foto')->store('penjualan_foto', 'public');
        }

        // Hitung total dari detail
        $totalBarang = count($request->details);
        $totalHarga = collect($request->details)->sum(function ($item) {
            return $item['jumlah'] * $item['harga_satuan'];
        });

        $data['total_barang'] = $totalBarang;
        $data['total_harga'] = $totalHarga;

        // Update data penjualan
        $penjualan->update($data);

        // Hapus detail lama
        $penjualan->details()->delete();

        // Simpan detail baru
        foreach ($request->details as $detail) {
            PenjualanDetail::create([
                'id_penjualan' => $penjualan->id,
                'id_barang' => $detail['id_barang'],
                'jumlah' => $detail['jumlah'],
                'harga_satuan' => $detail['harga_satuan'],
                'subtotal' => $detail['jumlah'] * $detail['harga_satuan'],
            ]);
        }

        return redirect()->route('penjualans.index')
            ->with('success', 'Data penjualan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        // Hapus detail penjualan dulu
        $penjualan->details()->delete();

        // Hapus foto jika ada
        if ($penjualan->foto && \Storage::disk('public')->exists($penjualan->foto)) {
            \Storage::disk('public')->delete($penjualan->foto);
        }

        // Hapus penjualan
        $penjualan->delete();

        return redirect()->route('penjualans.index')->with('success', 'Data penjualan berhasil dihapus.');
    }
    public function cetakPdf($id)
    {
        $penjualan = Penjualan::with('user', 'proyek', 'details.barang')->findOrFail($id);

        $pdf = Pdf::loadView('penjualans.invoice_pdf', compact('penjualan'));
        return $pdf->stream('invoice-' . $penjualan->invoice . '.pdf');
    }
}
