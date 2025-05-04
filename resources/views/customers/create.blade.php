
@extends('layouts.app')

@section('title', 'Tambah Customer')

@section('content')
<div class="page-inner">
    <div class="card">
        <div class="card-header"><div class="card-title">Tambah Customer</div></div>
        <div class="card-body">
            @extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Customer</h3>

    <div class="card">
        <div class="card-body">

            {{-- Tampilkan Error Validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Nama Customer</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                </div>

                <div class="form-group">
                    <label>Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" class="form-control" value="{{ old('nama_perusahaan') }}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" name="telepon" class="form-control" value="{{ old('telepon') }}" required>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Upload NPWP (PDF/Gambar)</label>
                    <input type="file" name="npwp" class="form-control-file">
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection

        </div>
    </div>
</div>
@endsection
