<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class ProyekController extends Controller
{
    public function index(Request $request)
    {
        $query = Proyek::with('user');

        if ($request->filled('search')) {
            $query->where('nama_proyek', 'like', '%' . $request->search . '%')
                  ->orWhere('lokasi', 'like', '%' . $request->search . '%');
        }

        $proyeks = $query->latest()->paginate(10);

        return view('proyeks.index', compact('proyeks'));
    }

    public function create()
    {
        $mandors = User::where('role', 'mandor')->get(); // ambil semua mandor
        return view('proyeks.create', compact('mandors')); // kirim ke view
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_proyek' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:perencanaan,berjalan,selesai,batal',
            'biaya' => 'nullable|numeric',
            'foto' => 'nullable|image|max:2048',
            'user_id' => 'required|exists:users,id',
        ]);

        $data = $request->only([
            'nama_proyek', 'lokasi', 'tanggal_mulai', 'tanggal_selesai',
            'status', 'biaya', 'user_id'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('proyek_foto', 'public');
        }

        Proyek::create($data);

    return redirect()->route('proyeks.index')->with('success', 'Proyek berhasil ditambahkan');
}

    public function edit(Proyek $proyek)
    {
        $mandors = \App\Models\User::where('role', 'mandor')->get();
    return view('proyeks.edit', compact('proyek', 'mandors'));
    }

    public function update(Request $request, Proyek $proyek)
    {
        $request->validate([
            'nama_proyek' => 'required|string|max:255',
            'lokasi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:perencanaan,berjalan,selesai,batal',
            'biaya' => 'nullable|numeric',
            'foto' => 'nullable|image|max:2048',
            'user_id' => 'required|exists:users,id',
        ]);

        $data = $request->only([
            'nama_proyek', 'lokasi', 'tanggal_mulai',
            'tanggal_selesai', 'status', 'biaya', 'user_id'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('proyek_foto', 'public');
        }
        $proyek->update($data);

        return redirect()->route('proyeks.index')->with('success', 'Proyek berhasil diperbarui');
    }

    public function show(Proyek $proyek)
    {
        $proyek->load(['customer', 'user']);

        $availableCustomers = Customer::whereNotIn('id', $proyek->customer->pluck('id'))->get();

        return view('proyeks.show', compact('proyek', 'availableCustomers'));
    }

    public function destroy(Proyek $proyek)
    {
        $proyek->delete();
        return redirect()->route('proyeks.index')->with('success', 'Proyek berhasil dihapus');
    }

    public function addCustomer(Request $request, Proyek $proyek)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
        ]);

        if (!$proyek->customer->contains($request->customer_id)) {
            $proyek->customer()->attach($request->customer_id);
        }

        return back()->with('success', 'Customer berhasil ditambahkan ke proyek');
    }

    public function removeCustomer(Proyek $proyek, Customer $customer)
    {
        $proyek->customer()->detach($customer->id);
        return back()->with('success', 'Customer berhasil dihapus dari proyek');
    }

    public function updateStatus(Request $request, Proyek $proyek)
    {
        $request->validate([
            'status' => 'required|in:perencanaan,berjalan,selesai,batal',
        ]);

        $proyek->status = $request->status;
        $proyek->save();

        return back()->with('success', 'Status proyek berhasil diperbarui.');
    }
}
