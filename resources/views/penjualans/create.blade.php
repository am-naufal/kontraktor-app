@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Penjualan</h3>
    <div class="card">
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

            <form action="{{ route('penjualans.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Mandor</label>
                    <select name="id_user" class="form-control" required>
                        <option value="">-- Pilih Mandor --</option>
                        @foreach ($mandors as $mandor)
                            <option value="{{ $mandor->id }}">{{ $mandor->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Proyek</label>
                    <select name="id_proyek" class="form-control" required>
                        <option value="">-- Pilih Proyek --</option>
                        @foreach ($proyeks as $proyek)
                            <option value="{{ $proyek->id }}">{{ $proyek->nama_proyek }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Tanggal Penjualan</label>
                    <input type="date" name="tanggal_penjualan" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Upload Foto Bukti</label>
                    <input type="file" name="foto" class="form-control-file">
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control"></textarea>
                </div>

                <h5 class="mt-4">Detail Barang</h5>
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
                        <tr>
                            <td>
                                <select name="details[0][id_barang]" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($barangs as $barang)
                                        <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" name="details[0][jumlah]" class="form-control jumlah" required></td>
                            <td><input type="number" name="details[0][harga_satuan]" class="form-control harga_satuan" step="0.01" required></td>
                            <td><input type="number" name="details[0][subtotal]" class="form-control subtotal" readonly required></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-row">Hapus</button></td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" id="add-row" class="btn btn-info btn-sm">Tambah Barang</button>

                <button type="submit" class="btn btn-success mt-3">Simpan</button>
                <a href="{{ route('penjualans.index') }}" class="btn btn-secondary mt-3">Batal</a>
            </form>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let rowIdx = 1;

    function hitungSubtotal(row) {
        const jumlah = parseFloat(row.find('.jumlah').val()) || 0;
        const harga = parseFloat(row.find('.harga_satuan').val()) || 0;
        row.find('.subtotal').val((jumlah * harga).toFixed(2));
    }

    $(document).ready(function () {
        console.log("Script ready");

        $('#detail-barang-table').on('input', '.jumlah, .harga_satuan', function () {
            const row = $(this).closest('tr');
            hitungSubtotal(row);
        });

        $('#add-row').on('click', function () {
            console.log("Tambah barang diklik");

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
                <td><button type="button" class="btn btn-danger btn-sm remove-row">Hapus</button></td>
            </tr>`;

            $('#detail-barang-table tbody').append(rowHtml);
            rowIdx++;
        });

        $('#detail-barang-table').on('click', '.remove-row', function () {
            $(this).closest('tr').remove();
        });
    });
</script>
@endpush

