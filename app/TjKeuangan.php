<?php

namespace App;

use Hashids;
use Illuminate\Database\Eloquent\Model;

class TjKeuangan extends Model
{
    protected $table = 'tj_keuangan';
    protected $primaryKey = 'id';
    protected $fillable = ['tahun', 'bulan', 'lembaga_id', 'nilai'];

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('keuangan')->encode($this->attributes['id']);
    }

    public function lembaga()
    {
        return $this->belongsTo('\App\Lembaga', 'lembaga_id');
    }
}
