<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembiayaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_proyek',
        'tanggal',
        'jumlah',
        'keterangan',
        'bukti',
    ];

    public function mandor()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'id_proyek');
    }
}
