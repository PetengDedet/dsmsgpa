<?php

namespace App;

use Hashids;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';
    protected $primaryKey = 'id';
    protected $fillable = ['lembaga_id', 'tahun', 'bulan', 'agenda'];

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('agenda')->encode($this->attributes['id']);
    }

    public function lembaga()
    {
        return $this->belongsTo('\App\Lembaga', 'lembaga_id');
    }
}
