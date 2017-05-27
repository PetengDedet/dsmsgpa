<?php

namespace App;

use Hashids;
use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    protected $table = 'anggaran';
    protected $primaryKey = 'id';
    protected $fillable = ['lembaga_id', 'tahun', 'pagu', 'realisasi'];

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('anggaran')->encode($this->attributes['id']);
    }

    public function lembaga()
    {
        return $this->belongsTo('\App\Lembaga', 'lembaga_id');
    }
}
