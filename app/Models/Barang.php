<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_barang_id',
        'nama_barang',
        'satuan',
        'keterangan',
    ];

    public function penjualanDetails()
    {
        return $this->hasMany(PenjualanDetail::class, 'id_barang');
    }
}
