<?php
namespace App\Exports;

use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenjualanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Penjualan::all();
    }

    public function headings(): array
    {
        return ['ID', 'Invoice', 'Tanggal', 'Total Barang', 'Total Harga'];
    }
}
