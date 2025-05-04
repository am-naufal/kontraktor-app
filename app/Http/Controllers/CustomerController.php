<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_perusahaan', 'like', '%' . $request->search . '%');
        }

        $customers = $query->latest()->paginate(10);

        return view('customers.index', compact('customers'));
    }


    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'telepon' => 'required|string|max:20|unique:customers,telepon',
        'alamat' => 'required|string',
        'nama_perusahaan' => 'required|string|max:255',
        'npwp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    $path = null;
    if ($request->hasFile('npwp')) {
        $path = $request->file('npwp')->store('customer_npwp', 'public');
    }

    Customer::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'telepon' => $request->telepon,
        'alamat' => $request->alamat,
        'nama_perusahaan' => $request->nama_perusahaan,
        'npwp' => $path,
    ]);

    return redirect()->route('customers.index')->with('success', 'Customer berhasil ditambahkan');
}

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'telepon' => 'required|string|max:20|unique:customers,telepon,' . $customer->id,
        'alamat' => 'required|string',
        'nama_perusahaan' => 'required|string|max:255',
        'npwp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);


    $data = $request->only(['nama', 'email', 'telepon', 'alamat', 'nama_perusahaan']);

    if ($request->hasFile('npwp')) {
        $data['npwp'] = $request->file('npwp')->store('customer_npwp', 'public');
    }

    $customer->update($data);

    return redirect()->route('customers.index')->with('success', 'Customer berhasil diperbarui');
}


    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer berhasil dihapus');
    }
}
