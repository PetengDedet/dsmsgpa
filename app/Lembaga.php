<?php

namespace App;

use Hashids;
use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    protected $table = 'lembaga';
    protected $primaryKey = 'id';

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('lembaga')->encode($this->attributes['id']);
    }

    public function anggaran()
    {
        return $this->hasMany('\App\Anggaran', 'lembaga_id');
    }

    public function agenda()
    {
        return $this->hasMany('\App\Agenda', 'lembaga_id');
    }

    public function keuangan()
    {
        return $this->hasMany('\App\TjKeuangan', 'lembaga_id');
    }

    public function disposisi()
    {
        return $this->hasMany('\App\Disposisi', 'lembaga_id');
    }
}
