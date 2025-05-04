<?php

namespace App\Http\Controllers;

use App\Models\Pembiayaan;
use App\Models\User;
use App\Models\Proyek;
use Illuminate\Http\Request;

class PembiayaanController extends Controller
{
    public function index()
    {
        $pembiayaans = Pembiayaan::with('mandor', 'proyek')->latest()->get();
        return view('pembiayaans.index', compact('pembiayaans'));
    }

    public function create()
    {
        $mandors = User::where('role', 'mandor')->get();
        $proyeks = Proyek::all();

        return view('pembiayaans.create', compact('mandors', 'proyeks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_proyek' => 'required|exists:proyeks,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = $request->only(['id_user', 'id_proyek', 'tanggal', 'jumlah', 'keterangan']);

        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')->store('pembiayaan_bukti', 'public');
        }

        Pembiayaan::create($data);

        return redirect()->route('pembiayaans.index')->with('success', 'Pembiayaan berhasil ditambahkan.');
    }
    public function edit($id)
{
    $pembiayaan = Pembiayaan::findOrFail($id);
    $mandors = User::where('role', 'mandor')->get();
    $proyeks = Proyek::all();

    return view('pembiayaans.edit', compact('pembiayaan', 'mandors', 'proyeks'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'id_user' => 'required|exists:users,id',
        'id_proyek' => 'required|exists:proyeks,id',
        'tanggal' => 'required|date',
        'jumlah' => 'required|numeric|min:0',
        'keterangan' => 'nullable|string',
        'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $pembiayaan = Pembiayaan::findOrFail($id);
    $data = $request->only(['id_user', 'id_proyek', 'tanggal', 'jumlah', 'keterangan']);

    if ($request->hasFile('bukti')) {
        if ($pembiayaan->bukti && \Storage::disk('public')->exists($pembiayaan->bukti)) {
            \Storage::disk('public')->delete($pembiayaan->bukti);
        }
        $data['bukti'] = $request->file('bukti')->store('pembiayaan_bukti', 'public');
    }

    $pembiayaan->update($data);

    return redirect()->route('pembiayaans.index')->with('success', 'Data pembiayaan berhasil diperbarui.');
}

public function destroy($id)
{
    $pembiayaan = Pembiayaan::findOrFail($id);

    if ($pembiayaan->bukti && \Storage::disk('public')->exists($pembiayaan->bukti)) {
        \Storage::disk('public')->delete($pembiayaan->bukti);
    }

    $pembiayaan->delete();

    return redirect()->route('pembiayaans.index')->with('success', 'Data pembiayaan berhasil dihapus.');
}
}
