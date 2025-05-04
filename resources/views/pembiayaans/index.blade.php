@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Pembiayaan</h3>
    <a href="{{ route('pembiayaans.create') }}" class="btn btn-primary mb-3">Tambah Pembiayaan</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-bordered m-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Mandor</th>
                        <th>Proyek</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Bukti</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pembiayaans as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->mandor->name ?? '-' }}</td>
                            <td>{{ $item->proyek->nama_proyek ?? '-' }}</td>
                            <td>Rp {{ number_format($item->jumlah, 2, ',', '.') }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                @if ($item->bukti)
                                    <a href="{{ asset('storage/' . $item->bukti) }}" target="_blank">Lihat</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pembiayaans.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('pembiayaans.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data pembiayaan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
