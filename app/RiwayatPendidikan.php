<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;

class RiwayatPendidikan extends Model
{
    //
    protected $table = 'riwayat_pendidikan';

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('riwayat_pendidikan')->encode($this->attributes['id']);
    }
}
