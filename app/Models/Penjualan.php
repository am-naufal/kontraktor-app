<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_proyek',
        'tanggal_penjualan',
        'total_barang',
        'total_harga',
        'keterangan',
        'foto',
        'invoice'

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'id_proyek');
    }

    public function details()
    {
        return $this->hasMany(PenjualanDetail::class, 'id_penjualan');
    }
}
