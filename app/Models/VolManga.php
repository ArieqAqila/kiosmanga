<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VolManga extends Model
{
    use HasFactory;
    protected $table = 'vol_manga';
    protected $primaryKey = 'id_vol';
    protected $guarded = [
        'id_vol',
    ];

    public $timestamps = false;


    public function manga()
    {
        return $this->belongsTo(Manga::class, 'id_manga');
    }

    public function keranjang()
    {
        return $this->hasMany(keranjang::class, 'id_vol', 'id_vol');
    }

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'id_vol', 'id_vol');
    }



    public static function volSlugFind($volumeSlug, $columns = ['*'])
    {
        $record = static::where('slug_vol', $volumeSlug)->first($columns);

        if (!$record) {
            throw (new ModelNotFoundException)->setModel(static::class, $volumeSlug);
        }

        return $record;
    }
}
