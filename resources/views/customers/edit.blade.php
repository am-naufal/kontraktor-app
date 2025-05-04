
@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
<div class="page-inner">
    <div class="card">
        <div class="card-header"><div class="card-title">Edit Customer</div></div>
        <div class="card-body">
            @extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Customer</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Customer</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $customer->nama) }}" required>
                </div>

                <div class="form-group">
                    <label>Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" class="form-control" value="{{ old('nama_perusahaan', $customer->nama_perusahaan) }}">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $customer->email) }}">
                </div>

                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $customer->telepon) }}">
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control">{{ old('alamat', $customer->alamat) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Upload NPWP (PDF/Gambar)</label>
                    <input type="file" name="npwp" class="form-control-file">
                    @if ($customer->npwp)
                        <p class="mt-2">File saat ini:
                            <a href="{{ asset('storage/' . $customer->npwp) }}" target="_blank">Lihat NPWP</a>
                        </p>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
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
