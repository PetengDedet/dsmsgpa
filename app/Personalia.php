<?php

namespace App;
use Hashids;
use Illuminate\Database\Eloquent\Model;
use App\Library\Datify;

class Personalia extends Model
{
    //
    protected $table = 'personalia';

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::connection('personalia')->encode($this->attributes['id']);
    }

    public function getTempatTanggalLahirAttribute()
    {
        return ucfirst($this->attributes['tempat_lahir']) . ', ' . Datify::readify(substr($this->attributes['tanggal_lahir'], 0, 10));
    }

    public function getTglLahirAttribute($separator = '/') {
        $returnValue = '';
        $returnValue .= substr($this->attributes['tanggal_lahir'], 8, 2);
        $returnValue .= $separator;
        $returnValue .= substr($this->attributes['tanggal_lahir'], 5, 2);
        $returnValue .= $separator;
        $returnValue .= substr($this->attributes['tanggal_lahir'], 0, 4);
        
        return $returnValue;
    }

    public function alamat()
    {
    	return $this->hasMany('\App\Alamat', 'personalia_id');
    }

    public function kontak()
    {
    	return $this->hasMany('\App\Kontak', 'personalia_id');
    }

    public function riwayat_pendidikan()
    {
    	return $this->hasMany('\App\RiwayatPendidikan', 'personalia_id');
    }

    public function riwayat_organisasi()
    {
    	return $this->hasMany('\App\RiwayatOrganisasi', 'personalia_id');
    }
}
