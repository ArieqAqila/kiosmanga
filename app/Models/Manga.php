<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Manga extends Model
{
    use HasFactory;
    protected $table = 'manga';
    protected $primaryKey = 'id_manga';
    protected $guarded = [
        'id_manga',
    ];

    public $timestamps = false;
    
    public function mangaka()
    {
        return $this->belongsTo(Mangaka::class, 'id_mangaka', 'id_mangaka');
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'id_penerbit', 'id_penerbit');
    }

    public function genreManga()
    {
        return $this->hasMany(GenreManga::class, 'id_manga', 'id_manga');
    }

    public function volManga()
    {
        return $this->hasMany(VolManga::class, 'id_manga', 'id_manga');
    }


    public static function mangaSlugFind($mangaSlug, $columns = ['*'])
    {
        $record = static::where('slug_manga', $mangaSlug)->first($columns);

        if (!$record) {
            throw (new ModelNotFoundException)->setModel(static::class, $mangaSlug);
        }

        return $record;
    }
}
