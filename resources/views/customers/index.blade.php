@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-3">Daftar Customer</h3>
    <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Tambah Customer</a>
    <form action="{{ route('customers.index') }}" method="GET" class="form-inline mb-3">
        <input type="text" name="search" class="form-control mr-2" placeholder="Cari nama, email, atau perusahaan..."
            value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Cari</button>
        @if(request('search'))
            <a href="{{ route('customers.index') }}" class="btn btn-secondary ml-2">Reset</a>
        @endif
    </form>
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Perusahaan</th>
                        <th>NPWP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $index => $customer)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $customer->nama }}</td>
                            <td>{{ $customer->telepon }}</td>
                            <td>{{ $customer->alamat }}</td>
                            <td>{{ $customer->nama_perusahaan ?? '-' }}</td>
                            <td>
                                @if ($customer->npwp)
                                    <a href="{{ asset('storage/' . $customer->npwp) }}" target="_blank">Lihat</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus customer ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center">Belum ada customer.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $customers->appends(['search' => request('search')])->links() }}
    </div>

</div>
@endsection
