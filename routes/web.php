<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('test', function()
{
	$p = Carbon\Carbon::parse(\App\Pelantikan::first()->sejak);
	$t = Carbon\Carbon::parse(\App\Pelantikan::first()->hingga);
	$dur = $p->diffInDays($t);
	return $dur;
	//dd(storage_path('local'));
});

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('master', function()
{
	return view('layouts.master');
});

Route::get('personalia/getJSON', ['as' => 'personalia.getJSON', 'uses' => 'PersonaliaController@getJson']);

Route::group(['middleware' => 'Admin'], function(){
    Route::get('/dashboard', function()
    {
    	return view('dashboard');
    });
//USER
	Route::get('master/user', 				['as' => 'master.user', 		'uses' => 'UserController@index']);
	Route::get('master/user/create', 		['as' => 'master.user.create', 	'uses' => 'UserController@create']);
	Route::post('master/user/create', 		['as' => 'master.user.create', 	'uses' => 'UserController@store']);
	Route::get('master/user/lihat/{id}', 	['as' => 'master.user.lihat', 	'uses' => 'UserController@show']);
	Route::get('master/user/hapus/{id}', 	['as' => 'master.user.hapus', 	'uses' => 'UserController@destroy']);

//LEMBAGA
	Route::get('master/lembaga', 				['as' => 'master.lembaga', 				'uses' => 'LembagaController@index']);
	Route::get('master/lembaga/create', 		['as' => 'master.lembaga.create', 		'uses' => 'LembagaController@create']);
	Route::get('master/lembaga/lihat/{id}', 	['as' => 'master.lembaga.lihat', 		'uses' => 'LembagaController@show']);
	Route::get('master/lembaga/sunting/{id}', 	['as' => 'master.lembaga.sunting', 		'uses' => 'LembagaController@sunting']);
	Route::post('master/lembaga/sunting/{id}', 	['as' => 'master.lembaga.sunting.post', 'uses' => 'LembagaController@update']);
	Route::post('master/lembaga/create', 		['as' => 'master.lembaga.create.post', 	'uses' => 'LembagaController@store']);

//JABATAN
	Route::get('master/jabatan', 				['as' => 'master.jabatan', 				'uses' => 'JabatanController@index']);
	Route::get('master/jabatan/create', 		['as' => 'master.jabatan.create', 		'uses' => 'JabatanController@create']);
	Route::get('master/jabatan/lihat/{id}', 	['as' => 'master.jabatan.lihat', 		'uses' => 'JabatanController@show']);
	Route::get('master/jabatan/sunting/{id}', 	['as' => 'master.jabatan.sunting', 		'uses' => 'JabatanController@sunting']);
	Route::post('master/jabatan/sunting/{id}', 	['as' => 'master.jabatan.sunting.post', 'uses' => 'JabatanController@update']);
	Route::post('master/jabatan/create', 		['as' => 'master.jabatan.create.post', 	'uses' => 'JabatanController@store']);

//PERSONALIA
 	Route::get('personalia', 						 ['as' => 'personalia', 						'uses' => 'PersonaliaController@index']);
 	Route::get('personalia/create', 				 ['as' => 'personalia.create', 					'uses' => 'PersonaliaController@create']);
 	Route::get('personalia/lihat/{hashid}', 		 ['as' => 'personalia.show', 					'uses' => 'PersonaliaController@show']);
 	Route::post('personalia/kirimdatadiri', 		 ['as' => 'personalia.kirimdatadiri', 			'uses' => 'PersonaliaController@kirimDataDiri']);
 	Route::post('personalia/kirimriwayatpendidikan', ['as' => 'personalia.kirimriwayatpendidikan', 	'uses' => 'PersonaliaController@kirimRiwayatPendidikan']);
 	Route::post('personalia/hapusriwayatpendidikan', ['as' => 'personalia.hapusriwayatpendidikan', 	'uses' => 'PersonaliaController@hapusRiwayatPendidikan']);
 	Route::post('personalia/kirimkontak', 			 ['as' => 'personalia.kirimkontak', 			'uses' => 'PersonaliaController@kirimKontak']);
 	Route::post('personalia/hapuskontak', 			 ['as' => 'personalia.hapuskontak', 			'uses' => 'PersonaliaController@hapusKontak']);
 	Route::post('personalia/kirimalamat', 			 ['as' => 'personalia.kirimalamat', 			'uses' => 'PersonaliaController@kirimAlamat']);
 	Route::post('personalia/hapusalamat', 			 ['as' => 'personalia.hapusalamat', 			'uses' => 'PersonaliaController@hapusAlamat']);
 	Route::post('personalia/kirimorganisasi', 		 ['as' => 'personalia.kirimorganisasi', 		'uses' => 'PersonaliaController@kirimOrganisasi']);
 	Route::post('personalia/hapusorganisasi', 		 ['as' => 'personalia.hapusorganisasi', 		'uses' => 'PersonaliaController@hapusOrganisasi']);
 	//Edit
 	Route::post('personalia/editnama', 					['as' => 'personalia.editnama', 				'uses' => 'PersonaliaController@editNama']);
 	Route::post('personalia/editalias', 				['as' => 'personalia.editalias', 				'uses' => 'PersonaliaController@editAlias']);
 	Route::post('personalia/editjk', 					['as' => 'personalia.editjk', 					'uses' => 'PersonaliaController@editJk']);
 	Route::post('personalia/edittempatlahir', 			['as' => 'personalia.edittempat', 				'uses' => 'PersonaliaController@editTempatLahir']);
 	Route::post('personalia/edittanggallahir', 			['as' => 'personalia.edittanggallahir', 		'uses' => 'PersonaliaController@editTanggalLahir']);
 	Route::post('personalia/editpendidikanterakhir', 	['as' => 'personalia.editpendidikanterakhir', 	'uses' => 'PersonaliaController@editPendidikanTerakhir']);
 	Route::post('personalia/edittmt', 					['as' => 'personalia.edittmt', 					'uses' => 'PersonaliaController@editTmt']);
 	Route::post('personalia/editnomor', 				['as' => 'personalia.editnomor', 				'uses' => 'PersonaliaController@editNomor']);

//Pelantikan
 	Route::get('pelantikan', ['as' => 'pelantikan.index', 'uses' => 'PelantikanController@index']);
 	Route::get('pelantikan/new', ['as' => 'pelantikan.new', 'uses' => 'PelantikanController@create']);
 	Route::post('pelantikan/new', ['as' => 'pelantikan.new', 'uses' => 'PelantikanController@store']);

});