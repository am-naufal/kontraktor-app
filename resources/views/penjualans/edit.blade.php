@extends('layouts.app')

@section('title', 'Edit Penjualan')

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Edit Penjualan</h1>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Edit Penjualan</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('penjualans.update', $penjualan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mandor</label>
                                <select name="id_user" class="form-control" required>
                                    <option value="">-- Pilih Mandor --</option>
                                    @foreach ($mandors as $mandor)
                                        <option value="{{ $mandor->id }}"
                                            {{ $penjualan->id_user == $mandor->id ? 'selected' : '' }}>
                                            {{ $mandor->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Proyek</label>
                                <select name="id_proyek" class="form-control" required>
                                    <option value="">-- Pilih Proyek --</option>
                                    @foreach ($proyeks as $proyek)
                                        <option value="{{ $proyek->id }}"
                                            {{ $penjualan->id_proyek == $proyek->id ? 'selected' : '' }}>
                                            {{ $proyek->nama_proyek }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Penjualan</label>
                                <input type="date" name="tanggal_penjualan" class="form-control"
                                    value="{{ $penjualan->tanggal_penjualan }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Upload Foto Bukti</label>
                                <input type="file" name="foto" class="form-control-file">
                                @if ($penjualan->foto)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $penjualan->foto) }}" alt="Foto Bukti"
                                            class="img-thumbnail" style="max-height: 100px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="3">{{ $penjualan->keterangan }}</textarea>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Detail Barang</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="detail-barang-table">
                                    <thead>
                                        <tr>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                            <th>Harga Satuan</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($penjualan->details as $index => $detail)
                                            <tr>
                                                <td>
                                                    <select name="details[{{ $index }}][id_barang]"
                                                        class="form-control" required>
                                                        <option value="">-- Pilih --</option>
                                                        @foreach ($barangs as $barang)
                                                            <option value="{{ $barang->id }}"
                                                                {{ $detail->id_barang == $barang->id ? 'selected' : '' }}>
                                                                {{ $barang->nama_barang }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="details[{{ $index }}][jumlah]"
                                                        class="form-control jumlah" value="{{ $detail->jumlah }}" required>
                                                </td>
                                                <td>
                                                    <input type="number" name="details[{{ $index }}][harga_satuan]"
                                                        class="form-control harga_satuan"
                                                        value="{{ $detail->harga_satuan }}" step="0.01" required>
                                                </td>
                                                <td>
                                                    <input type="number" name="details[{{ $index }}][subtotal]"
                                                        class="form-control subtotal" value="{{ $detail->subtotal }}"
                                                        readonly required>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm remove-row">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" id="add-row" class="btn btn-info btn-sm">
                                <i class="fas fa-plus"></i> Tambah Barang
                            </button>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('penjualans.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let rowIdx = {{ count($penjualan->details) }};

        function hitungSubtotal(row) {
            const jumlah = parseFloat(row.find('.jumlah').val()) || 0;
            const harga = parseFloat(row.find('.harga_satuan').val()) || 0;
            row.find('.subtotal').val((jumlah * harga).toFixed(2));
        }

        $(document).ready(function() {
            // Hitung subtotal saat input berubah
            $('#detail-barang-table').on('input', '.jumlah, .harga_satuan', function() {
                const row = $(this).closest('tr');
                hitungSubtotal(row);
            });

            // Tambah baris baru
            $('#add-row').on('click', function() {
                let rowHtml = `
            <tr>
                <td>
                    <select name="details[${rowIdx}][id_barang]" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="details[${rowIdx}][jumlah]" class="form-control jumlah" required></td>
                <td><input type="number" name="details[${rowIdx}][harga_satuan]" class="form-control harga_satuan" step="0.01" required></td>
                <td><input type="number" name="details[${rowIdx}][subtotal]" class="form-control subtotal" readonly required></td>
                <td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="fas fa-trash"></i></button></td>
            </tr>`;

                $('#detail-barang-table tbody').append(rowHtml);
                rowIdx++;
            });

            // Hapus baris
            $('#detail-barang-table').on('click', '.remove-row', function() {
                if ($('#detail-barang-table tbody tr').length > 1) {
                    $(this).closest('tr').remove();
                } else {
                    alert('Minimal harus ada satu item barang!');
                }
            });
        });
    </script>
@endpush
