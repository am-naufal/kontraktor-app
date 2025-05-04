
@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="page-inner">
    <div class="card">
        <div class="card-header"><div class="card-title">Edit Barang</div></div>
        <div class="card-body">
            @extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Barang</h3>

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

            <form action="{{ route('barangs.update', $barang->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang"
                        class="form-control @error('nama_barang') is-invalid @enderror"
                        value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                    @error('nama_barang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Satuan</label>
                    <input type="text" name="satuan"
                        class="form-control @error('satuan') is-invalid @enderror"
                        value="{{ old('satuan', $barang->satuan) }}" required>
                    @error('satuan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $barang->keterangan) }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Kembali</a>
            </form>

        </div>
    </div>
</div>
@endsection

        </div>
    </div>
</div>
@endsection
