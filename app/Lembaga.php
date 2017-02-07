<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;

class Lembaga extends Model
{
    //
    protected $table = 'lembaga';
    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('lembaga')->encode($this->attributes['id']);
    }

    public function menaungi()
    {
    	return $this->hasMany('\App\Lembaga', 'induk_langsung');
    }

    public function naungan()
    {
    	return $this->belongsTo('\App\Lembaga', 'induk_langsung');
    }
}
