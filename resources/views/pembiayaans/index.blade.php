@extends('layouts.app')

@section('title', 'Daftar Pembiayaan')

@section('content')
    <div class="page-inner">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Daftar Pembiayaan</h3>

        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title">Data Pembiayaan</h4>
                <a href="{{ route('pembiayaans.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>Tambah
                    Pembiayaan</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="pembiayaan-table" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Mandor</th>
                                <th>Proyek</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th>Bukti</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pembiayaans as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->mandor->name ?? '-' }}</td>
                                    <td>{{ $item->proyek->nama_proyek ?? '-' }}</td>
                                    <td>Rp {{ number_format($item->jumlah, 2, ',', '.') }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        @if ($item->bukti)
                                            <a href="{{ asset('storage/' . $item->bukti) }}" target="_blank"
                                                class="btn btn-sm btn-info">Lihat</a>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('pembiayaans.edit', $item->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('pembiayaans.destroy', $item->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada data pembiayaan.</td>
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
                $('#pembiayaan-table').DataTable({
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
        <script src="{{ asset('build/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    @endpush
@endsection
