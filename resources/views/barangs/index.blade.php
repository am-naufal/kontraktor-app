@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
    <div class="page-inner">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Daftar Barang</h3>
            <a href="{{ route('barangs.create') }}" class="btn btn-primary btn-sm">Tambah Barang</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Barang</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="barang-table" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($barangs as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>Rp {{ number_format($item->harga, 2, ',', '.') }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('barangs.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('barangs.destroy', $item->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada data barang.</td>
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
                $('#barang-table').DataTable({
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
