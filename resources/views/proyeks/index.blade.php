
@extends('layouts.app')

@section('title', 'Daftar Proyek')

@section('content')
<div class="page-inner">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Daftar Proyek</h3>
        <a href="{{ route('proyeks.create') }}" class="btn btn-primary">Tambah Proyek</a>
    </div>
    <div class="card">
        <div class="card-body">
            @extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-3">Daftar Proyek</h3>
    <a href="{{ route('proyeks.create') }}" class="btn btn-primary mb-3">Tambah Proyek</a>
    <form action="{{ route('proyeks.index') }}" method="GET" class="form-inline mb-3">
        <input type="text" name="search" class="form-control mr-2" placeholder="Cari nama atau lokasi..."
            value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Cari</button>
        @if(request('search'))
            <a href="{{ route('proyeks.index') }}" class="btn btn-secondary ml-2">Reset</a>
        @endif
    </form>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Foto</th>
                        <th>Penanggung Jawab</th>
                        <th>Biaya</th>
                        <th>Detail</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($proyeks as $index => $proyek)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $proyek->nama_proyek }}</td>
                            <td>
                                @if ($proyek->foto)
                                    <img src="{{ asset('storage/' . $proyek->foto) }}" alt="Foto Proyek" width="80">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $proyek->user->name ?? '-' }}</td>
                            <td>Rp {{ number_format($proyek->biaya, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('proyeks.show', $proyek->id) }}" class="btn btn-sm btn-info">Detail</a>
                            </td>
                            <td><span class="badge badge-info">{{ ucfirst($proyek->status) }}</span></td>
                            <td>
                                <a href="{{ route('proyeks.edit', $proyek->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('proyeks.destroy', $proyek->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus proyek ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada proyek.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $proyeks->appends(['search' => request('search')])->links() }}
    </div>
</div>
@endsection

        </div>
    </div>
</div>
@endsection
