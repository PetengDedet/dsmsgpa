<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;

class RiwayatOrganisasi extends Model
{
    protected $table = 'riwayat_organisasi';

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('riwayat_organisasi')->encode($this->attributes['id']);
    }
}
