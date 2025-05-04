<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_proyek', 'lokasi', 'tanggal_mulai', 'tanggal_selesai', 'status', 'biaya', 'foto', 'customer_id', 'user_id'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date'
    ];

    public function customer()
    {
        return $this->belongsToMany(Customer::class, 'customer_proyek');
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

}
