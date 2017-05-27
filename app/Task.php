<?php

namespace App;

use Hashids;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'task';
    protected $primaryKey = 'id';
    protected $fillable = ['tahun', 'bulan', 'lembaga_id', 'tugas', 'terlaksana'];

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('task')->encode($this->attributes['id']);
    }

    public function lembaga()
    {
        return $this->belongsTo('\App\Lembaga', 'lembaga_id');
    }
}
