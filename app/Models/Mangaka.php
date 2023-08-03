<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mangaka extends Model
{
    use HasFactory;
    protected $table = 'mangaka';
    protected $primaryKey = 'id_mangaka';
    protected $guarded = [
        'id_mangaka',
    ];

    public $timestamps = false;

    public function manga()
    {
        return $this->hasMany(Manga::class, 'id_mangaka', 'id_mangaka');
    }
}
