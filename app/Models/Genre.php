<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $table = 'genre';
    protected $primaryKey = 'id_genre';
    protected $guarded = [
        'id_genre',
    ];

    public $timestamps = false;

    public function genreManga()
    {
        return $this->hasMany(GenreManga::class, 'id_genre', 'id_genre');
    }
}
