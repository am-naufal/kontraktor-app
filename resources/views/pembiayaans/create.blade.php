@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Pembiayaan</h3>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pembiayaans.store') }}" method="POST" enctype="multipart/form-data">
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
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Jumlah Biaya (Rp)</label>
                    <input type="number" name="jumlah" class="form-control" step="0.01" required>
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label>Bukti Pembayaran (gambar/pdf)</label>
                    <input type="file" name="bukti" class="form-control-file">
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('pembiayaans.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
