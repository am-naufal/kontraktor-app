@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h3 class="mb-3">Daftar Proyek</h3>
        <a href="{{ route('proyeks.create') }}" class="btn btn-primary mb-3">Tambah Proyek</a>

        <div class="card">
            <div class="card-body p-0">
                <table class="table table-striped m-0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Customer</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($proyeks as $proyek)
                            <tr>
                                <td>{{ $proyek->nama_proyek }}</td>
                                <td>{{ $proyek->customer->nama }}</td>
                                <td>{{ $proyek->tanggal_mulai }}</td>
                                <td>{{ $proyek->tanggal_selesai ?? '-' }}</td>
                                <td><span class="badge badge-info">{{ ucfirst($proyek->status) }}</span></td>
                                <td>
                                    <a href="{{ route('proyeks.edit', $proyek->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('proyeks.destroy', $proyek->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Hapus proyek ini?')">Hapus</button>
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
            {{ $proyeks->links() }}
        </div>
    </div>
@endsection
