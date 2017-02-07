<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;

class Alamat extends Model
{
    protected $table = 'alamat';

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('alamat')->encode($this->attributes['id']);
    }
}
