<?php

namespace App;

use Hashids;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    //
    protected $table = 'jabatan';
    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('jabatan')->encode($this->attributes['id']);
    }
}
