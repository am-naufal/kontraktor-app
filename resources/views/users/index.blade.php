@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Manajemen User</h1>

        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">Daftar Pengguna</h4>
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah
                    User</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="users-table" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. HP</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if ($user->foto)
                                            <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto" width="50"
                                                height="50" style="object-fit: cover; border-radius: 50%;">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->no_hp ?? '-' }}</td>
                                    <td><span class="badge badge-info">{{ $user->role }}</span></td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Hapus user ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada user.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#users-table').DataTable({
                    "pageLength": 10,
                    "ordering": true,
                    "responsive": true,
                    "searching": true,
                    "processing": true,
                    "language": {
                        "search": "Cari:",
                        "lengthMenu": "Tampilkan _MENU_ data per halaman",
                        "zeroRecords": "Data tidak ditemukan",
                        "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                        "infoEmpty": "Tidak ada data yang tersedia",
                        "infoFiltered": "(difilter dari _MAX_ total data)",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "Selanjutnya",
                            "previous": "Sebelumnya"
                        },
                        "processing": "Memproses...",
                        "loadingRecords": "Memuat...",
                        "emptyTable": "Tidak ada data yang tersedia"
                    },
                    "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                });
            });
        </script>
    @endpush
@endsection
