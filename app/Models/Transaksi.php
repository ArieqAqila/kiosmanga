<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $guarded = [
        'id_transaksi',
    ];

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'id_transaksi', 'id_transaksi');
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'id_transaksi', 'id_transaksi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
