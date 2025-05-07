@extends('layouts.app')

@section('title', 'Daftar Penjualan')

@section('content')
    <div class="page-inner">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold">Daftar Penjualan</h3>
            <a href="{{ route('penjualans.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Penjualan
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Penjualan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="penjualan-table" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Invoice</th>
                                <th>Tanggal</th>
                                <th>Mandor</th>
                                <th>Proyek</th>
                                <th>Total Barang</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($penjualans as $index => $penjualan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $penjualan->invoice }}</td>
                                    <td>{{ $penjualan->tanggal_penjualan }}</td>
                                    <td>{{ $penjualan->user->name }}</td>
                                    <td>{{ $penjualan->proyek->nama_proyek }}</td>
                                    <td>{{ $penjualan->total_barang }}</td>
                                    <td>Rp {{ number_format($penjualan->total_harga, 2, ',', '.') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('penjualans.show', $penjualan->id) }}"
                                                class="btn btn-info btn-sm" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('penjualans.edit', $penjualan->id) }}"
                                                class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('penjualans.pdf', $penjualan->id) }}"
                                                class="btn btn-success btn-sm" title="Cetak PDF" target="_blank">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
                                            <form action="{{ route('penjualans.destroy', $penjualan->id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada data penjualan.</td>
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
                $('#penjualan-table').DataTable({
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
