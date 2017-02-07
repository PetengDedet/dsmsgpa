<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Hashids;

class Kontak extends Model
{
    //
    protected $table = 'kontak';

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('kontak')->encode($this->attributes['id']);
    }
}
