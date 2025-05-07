@extends('layouts.app')

@section('title', 'Detail Proyek')


@section('content')
    <div class="container">
        <h3>Detail Proyek</h3>

        <div class="card mb-4">
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Nama Proyek</dt>
                    <dd class="col-sm-9">{{ $proyek->nama_proyek }}</dd>
                    <dt class="col-sm-3">Penanggung Jawab</dt>
                    <dd class="col-sm-9">
                        {{ $proyek->user ? $proyek->user->name : '-' }}
                    </dd>

                    <dt class="col-sm-3">Customer</dt>
                    <dd class="col-sm-9">
                        @if ($proyek->customer && $proyek->customer->count())
                            <ul class="mb-0">
                                @foreach ($proyek->customer as $customer)
                                    <li class="d-flex justify-content-between align-items-center">
                                        <span>
                                            {{ $customer->nama }}
                                            @if ($customer->nama_perusahaan)
                                                ({{ $customer->nama_perusahaan }})
                                            @endif
                                        </span>
                                        <form action="{{ route('proyeks.removeCustomer', [$proyek->id, $customer->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin hapus customer ini dari proyek?')"
                                            class="ml-3">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </li>
                                @endforeach

                            </ul>
                        @else
                            <span class="text-muted">Belum ada customer</span>
                        @endif
                    </dd>

                    <dt class="col-sm-3">Tanggal Mulai</dt>
                    <dd class="col-sm-9">{{ $proyek->tanggal_mulai }}</dd>

                    <dt class="col-sm-3">Tanggal Selesai</dt>
                    <dd class="col-sm-9">{{ $proyek->tanggal_selesai ?? '-' }}</dd>

                    <dt class="col-sm-3">Status</dt>
                    <dd class="col-sm-9">
                        <form action="{{ route('proyeks.updateStatus', $proyek->id) }}" method="POST"
                            class="form-inline d-flex align-items-center gap-2">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-control form-control-sm mr-2">
                                @foreach (['perencanaan', 'berjalan', 'selesai', 'batal'] as $status)
                                    <option value="{{ $status }}" {{ $proyek->status === $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                            <button class="btn btn-sm btn-primary" type="submit">Update</button>
                        </form>
                    </dd>


                    <dt class="col-sm-3">Lokasi</dt>
                    <dd class="col-sm-9">{{ $proyek->lokasi }}</dd>
                </dl>

                <a href="{{ route('proyeks.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('proyeks.edit', $proyek->id) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
