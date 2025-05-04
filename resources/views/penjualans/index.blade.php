@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-3">Daftar Penjualan</h3>
    <a href="{{ route('penjualans.create') }}" class="btn btn-primary mb-3">Tambah Penjualan</a>
    <form action="{{ route('penjualans.index') }}" method="GET" class="form-inline mb-3">
        <input type="text" name="search" class="form-control mr-2" placeholder="Cari Invoice..." value="{{ request('search') }}">

        <label class="mr-1">Dari</label>
        <input type="date" name="tanggal_mulai" class="form-control mr-2" value="{{ request('tanggal_mulai') }}">

        <label class="mr-1">Sampai</label>
        <input type="date" name="tanggal_selesai" class="form-control mr-2" value="{{ request('tanggal_selesai') }}">

        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('penjualans.index') }}" class="btn btn-secondary ml-2">Reset</a>
    </form>
    <a href="{{ route('penjualans.export') }}" class="btn btn-success mb-3">Export Excel</a>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered table-striped m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Mandor</th>
                        <th>Proyek</th>
                        <th>Total Harga</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penjualans as $index => $penjualan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                            <td>{{ $penjualan->invoice }}</td>
                            <td>{{ $penjualan->tanggal_penjualan }}</td>
                            <td>{{ $penjualan->user->name ?? '-' }}</td>
                            <td>{{ $penjualan->proyek->nama_proyek ?? '-' }}</td>
                            <td>Rp {{ number_format($penjualan->total_harga, 2, ',', '.') }}</td>
                            <td>
                                @if ($penjualan->foto)
                                    <img src="{{ asset('storage/' . $penjualan->foto) }}" width="60">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('penjualans.destroy', $penjualan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                                <a href="{{ route('penjualans.show', $penjualan->id) }}" class="btn btn-sm btn-info">Detail</a>
                                <a href="{{ route('penjualans.pdf', $penjualan->id) }}" class="btn btn-sm btn-outline-secondary" target="_blank">
                                    PDF
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data penjualan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $penjualans->links() }}
    </div>
</div>
@endsection
