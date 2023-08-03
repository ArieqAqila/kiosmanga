<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    use HasFactory;
    protected $table = 'penerbit';
    protected $primaryKey = 'id_penerbit';
    protected $guarded = [
        'id_penerbit',
    ];

    public $timestamps = false;

    public function manga()
    {
        return $this->hasMany(Manga::class, 'id_penerbit');
    }
}
