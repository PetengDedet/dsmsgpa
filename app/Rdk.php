<?php

namespace App;

use Hashids;
use Illuminate\Database\Eloquent\Model;

class Rdk extends Model
{
    protected $table = 'rdk';
    protected $primaryKey = 'id';
    protected $fillable = ['tahun', 'bulan', 'pending', 'selesai'];

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('rdk')->encode($this->attributes['id']);
    }
}
