<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;
use Carbon\Carbon;
use App\Library\Datify;

class Pelantikan extends Model
{
    //
	protected $table = 'distribusi_jabatan';

	public function getHashidAttribute() {
		return Hashids::connection('pelantikan')->encode($this->attributes['id']);
	}

	public function getPeriodAttribute() {
		$now = Carbon::now();

		$period = [
			'sejak' => $this->attributes['sejak'],
			'hingga' => $this->attributes['hingga'],
			'formatSejak' => Datify::readify(substr($this->attributes['sejak'], 0, 10)),
			'formatHingga' => Datify::readify(substr($this->attributes['hingga'], 0, 10)),
			'duration' => Carbon::parse($this->attributes['sejak'])->diffInDays(Carbon::parse($this->attributes['hingga']))
		];
		
		return $period;
	}

	public function personalia() {
		return $this->belongsTo('\App\Personalia', 'personalia_id');
	}

	public function jabatan() {
		return $this->belongsTo('\App\Jabatan', 'jabatan_id');
	}

	public function lembaga() {
		return $this->belongsTo('\App\Lembaga', 'lembaga_id');
	}
}
