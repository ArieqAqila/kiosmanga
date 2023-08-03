<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenreManga extends Model
{
    use HasFactory;
    protected $table = 'genre_manga';
    public $timestamps = false;
    protected $fillable = [
        'id_manga',
        'id_genre',
    ];
    protected $primaryKey = null;
    public $incrementing = false;

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'id_genre', 'id_genre');
    }

    public function manga()
    {
        return $this->belongsTo(Manga::class, 'id_manga', 'id_manga');
    }
}
