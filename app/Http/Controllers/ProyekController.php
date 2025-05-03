<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\Customer;
use Illuminate\Http\Request;

class ProyekController extends Controller
{
    public function index()
    {
        $proyeks = Proyek::with('customer')->paginate(10);
        return view('proyeks.index', compact('proyeks'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('proyeks.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_proyek' => 'required',
            'lokasi' => 'required',
            'customer_id' => 'required|exists:customers,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:perencanaan,berjalan,selesai,batal',
        ]);

        Proyek::create($request->all());

        return redirect()->route('proyeks.index')->with('success', 'Proyek berhasil ditambahkan');
    }

    public function edit(Proyek $proyek)
    {
        $customers = Customer::all();
        return view('proyeks.edit', compact('proyek', 'customers'));
    }

    public function update(Request $request, Proyek $proyek)
    {
        $request->validate([
            'nama_proyek' => 'required',
            'lokasi' => 'required',
            'customer_id' => 'required|exists:customers,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:perencanaan,berjalan,selesai,batal',
        ]);

        $proyek->update($request->all());

        return redirect()->route('proyeks.index')->with('success', 'Proyek berhasil diperbarui');
    }

    public function destroy(Proyek $proyek)
    {
        $proyek->delete();
        return redirect()->route('proyeks.index')->with('success', 'Proyek berhasil dihapus');
    }
}
