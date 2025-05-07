@extends('layouts.app')

@section('title', 'Daftar Proyek')

@section('content')
    <div class="page-inner">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Daftar Proyek</h3>

        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">Data Proyek</h4>
                <a href="{{ route('proyeks.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah
                    Proyek</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="proyek-table" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Proyek</th>
                                <th>Lokasi</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($proyeks as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama_proyek }}</td>
                                    <td>{{ $item->lokasi }}</td>
                                    <td>{{ $item->tanggal_mulai }}</td>
                                    <td>{{ $item->tanggal_selesai }}</td>
                                    <td>
                                        <span class="badge badge-{{ $item->status == 'Selesai' ? 'success' : 'warning' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('proyeks.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('proyeks.destroy', $item->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada data proyek.</td>
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
                $('#proyek-table').DataTable({
                    "pageLength": 10,
                    "ordering": true,
                    "responsive": true,
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
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
