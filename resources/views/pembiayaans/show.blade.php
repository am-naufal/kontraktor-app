
@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')
<div class="page-inner">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Detail Penjualan</div>
        </div>
        <div class="card-body">
            @extends('layouts.app')

@section('content')
<div class="container">
    <h3>Detail Penjualan</h3>

    <div class="card mb-4">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Invoice</dt>
                <dd class="col-sm-9">{{ $penjualan->invoice }}</dd>

                <dt class="col-sm-3">Tanggal</dt>
                <dd class="col-sm-9">{{ $penjualan->tanggal_penjualan }}</dd>

                <dt class="col-sm-3">Mandor</dt>
                <dd class="col-sm-9">{{ $penjualan->user->name ?? '-' }}</dd>

                <dt class="col-sm-3">Proyek</dt>
                <dd class="col-sm-9">{{ $penjualan->proyek->nama_proyek ?? '-' }}</dd>

                <dt class="col-sm-3">Total Jenis Barang</dt>
                <dd class="col-sm-9">{{ $penjualan->total_barang }}</dd>

                <dt class="col-sm-3">Total Harga</dt>
                <dd class="col-sm-9">Rp {{ number_format($penjualan->total_harga, 2, ',', '.') }}</dd>

                <dt class="col-sm-3">Keterangan</dt>
                <dd class="col-sm-9">{{ $penjualan->keterangan ?? '-' }}</dd>

                <dt class="col-sm-3">Foto</dt>
                <dd class="col-sm-9">
                    @if ($penjualan->foto)
                        <img src="{{ asset('storage/' . $penjualan->foto) }}" width="180">
                    @else
                        <span class="text-muted">Tidak ada foto</span>
                    @endif
                </dd>
            </dl>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Detail Barang</div>
        <div class="card-body p-0">
            <table class="table table-striped m-0">
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualan->details as $detail)
                        <tr>
                            <td>{{ $detail->barang->nama_barang ?? '-' }}</td>
                            <td>{{ $detail->jumlah }}</td>
                            <td>Rp {{ number_format($detail->harga_satuan, 2, ',', '.') }}</td>
                            <td>Rp {{ number_format($detail->subtotal, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('penjualans.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection

        </div>
    </div>
</div>
@endsection
