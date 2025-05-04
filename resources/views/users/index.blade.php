@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Manajemen User</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah User</a>
    </div>

    <div class="card">
        <div class="card-header bg-gradient-primary text-white">
            <h3 class="card-title">Daftar Pengguna</h3>
        </div>
        <div class="card-body p-0">
            <form action="{{ route('users.index') }}" method="GET" class="form-inline p-3">
                <input type="text" name="search" class="form-control mr-2" placeholder="Cari nama atau email..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary ml-2">Reset</a>
            </form>

            <table class="table table-striped table-bordered m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Role</th>
                        <th style="width: 150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if ($user->foto)
                                    <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto" width="50" height="50" style="object-fit: cover; border-radius: 50%;">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->no_hp ?? '-' }}</td>
                            <td><span class="badge badge-info">{{ $user->role }}</span></td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hapus user ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">Belum ada user.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $users->appends(['search' => request('search')])->links() }}
    </div>
</div>
@endsection
