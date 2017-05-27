<?php

namespace App;

use Hashids;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audit';
    protected $primaryKey = 'id';
    protected $fillable = ['tahun', 'triwulan', 'pending', 'selesai'];

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('audit')->encode($this->attributes['id']);
    }
}
