
@extends('layouts.app')

@section('title', 'Tambah Proyek')

@section('content')
<div class="page-inner">
    <div class="card">
        <div class="card-header"><div class="card-title">Tambah Proyek</div></div>
        <div class="card-body">
            @extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Proyek</h3>
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

            <form action="{{ route('proyeks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Nama Proyek</label>
                    <input type="text" name="nama_proyek" class="form-control @error('nama_proyek') is-invalid @enderror"
                        value="{{ old('nama_proyek') }}" required>
                    @error('nama_proyek')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Lokasi</label>
                    <textarea name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" required>{{ old('lokasi') }}</textarea>
                    @error('lokasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Pilih Mandor</label>
                    <select name="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Mandor --</option>
                        @foreach ($mandors as $mandor)
                            <option value="{{ $mandor->id }}" {{ old('user_id') == $mandor->id ? 'selected' : '' }}>
                                {{ $mandor->name }} ({{ $mandor->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                        value="{{ old('tanggal_mulai') }}" required>
                    @error('tanggal_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid @enderror"
                        value="{{ old('tanggal_selesai') }}">
                    @error('tanggal_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Biaya Proyek (Rp)</label>
                    <input type="number" name="biaya" class="form-control @error('biaya') is-invalid @enderror"
                        value="{{ old('biaya') }}" step="0.01">
                    @error('biaya')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Upload Foto Proyek</label>
                    <input type="file" name="foto" class="form-control-file @error('foto') is-invalid @enderror">
                    @error('foto')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="perencanaan" {{ old('status') == 'perencanaan' ? 'selected' : '' }}>Perencanaan</option>
                        <option value="berjalan" {{ old('status') == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                        <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="batal" {{ old('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('proyeks.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection

        </div>
    </div>
</div>
@endsection
