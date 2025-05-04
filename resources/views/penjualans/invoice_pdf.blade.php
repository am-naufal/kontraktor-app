<!DOCTYPE html>
<html>
<head>
    <title>Invoice {{ $penjualan->invoice }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h2>Invoice Penjualan</h2>
    <p><strong>Invoice:</strong> {{ $penjualan->invoice }}</p>
    <p><strong>Tanggal:</strong> {{ $penjualan->tanggal_penjualan }}</p>
    <p><strong>Mandor:</strong> {{ $penjualan->user->name ?? '-' }}</p>
    <p><strong>Proyek:</strong> {{ $penjualan->proyek->nama_proyek ?? '-' }}</p>
    <p><strong>Keterangan:</strong> {{ $penjualan->keterangan }}</p>

    <h4>Detail Barang</h4>
    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan->details as $item)
                <tr>
                    <td>{{ $item->barang->nama_barang }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp {{ number_format($item->harga_satuan, 2, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->subtotal, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total: Rp {{ number_format($penjualan->total_harga, 2, ',', '.') }}</h4>
</body>
</html>
