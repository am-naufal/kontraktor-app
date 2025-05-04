
@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Daftar Barang</h3>
        <a href="{{ route('barangs.create') }}" class="btn btn-primary">Tambah Barang</a>
    </div>
    <div class="card">
        <div class="card-body">
            @extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-3">Daftar Barang</h3>
    <a href="{{ route('barangs.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered table-striped m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Satuan</th>
                        <th>Keterangan</th>
                        <th style="width: 150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangs as $index => $barang)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->satuan }}</td>
                            <td>{{ $barang->keterangan ?? '-' }}</td>
                            <td>
                                <a href="{{ route('barangs.edit', $barang->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hapus barang ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada barang.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $barangs->links() }}
    </div>
</div>
@endsection

        </div>
    </div>
</div>
@endsection
