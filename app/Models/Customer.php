<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'email', 'telepon', 'alamat', 'nama_perusahaan', 'npwp'
    ];

    public function proyeks()
    {
        return $this->belongsToMany(Proyek::class, 'customer_proyek');
    }
}
