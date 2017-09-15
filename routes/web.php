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

Route::get('test', function () {

});

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('dashboard');
    }

    return view('auth.login');
});

Auth::routes();

Route::get('home', function () {
    return redirect('dashboard');
});

Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'PageController@dashboard'])->middleware('auth');

Route::group(['middleware' => 'Admin'], function () {
    Route::get('anggaran', ['as' => 'anggaran', 'uses' => 'PageController@anggaranIndex']);
    Route::get('agenda', ['as' => 'agenda', 'uses' => 'PageController@agendaIndex']);
    Route::post('simpan-anggaran', ['as' => 'simpan-anggaran', 'uses' => 'PageController@simpanAnggaran']);
    Route::post('simpan-agenda', ['as' => 'simpan-agenda', 'uses' => 'PageController@simpanAgenda']);
    Route::post('hapus-agenda', ['as' => 'hapus-agenda', 'uses' => 'PageController@hapusAgenda']);

    Route::get('task', ['as' => 'task', 'uses' => 'PageController@taskIndex']);
    Route::post('simpan-task', ['as' => 'simpan-task', 'uses' => 'PageController@simpanTask']);

//Audit
    Route::get('audit', ['as' => 'audit', 'uses' => 'PageController@auditIndex']);
    Route::post('simpan-audit', ['as' => 'simpan-audit', 'uses' => 'PageController@simpanAudit']);

//RDK
    Route::get('rdk', ['as' => 'rdk', 'uses' => 'PageController@rdkIndex']);
    Route::post('simpan-rdk', ['as' => 'simpan-rdk', 'uses' => 'PageController@simpanRdk']);

//Keuangan
    Route::get('keuangan', ['as' => 'keuangan', 'uses' => 'PageController@keuanganIndex']);
    Route::post('simpan-keuangan', ['as' => 'simpan-keuangan', 'uses' => 'PageController@simpanKeuangan']);

//Disposisi
    Route::get('disposisi', ['as' => 'disposisi', 'uses' => 'PageController@disposisiIndex']);
    Route::post('simpan-disposisi', ['as' => 'simpan-disposisi', 'uses' => 'PageController@simpanDisposisi']);

//USER
    Route::get('master/user', ['as' => 'master.user', 'uses' => 'UserController@index']);
    Route::get('master/user/create', ['as' => 'master.user.create', 'uses' => 'UserController@create']);
    Route::post('master/user/create', ['as' => 'master.user.create', 'uses' => 'UserController@store']);
    Route::get('master/user/lihat/{id}', ['as' => 'master.user.lihat', 'uses' => 'UserController@show']);
    Route::get('master/user/hapus/{id}', ['as' => 'master.user.hapus', 'uses' => 'UserController@destroy']);

//LEMBAGA
    Route::get('master/lembaga', ['as' => 'master.lembaga', 'uses' => 'LembagaController@index']);
    Route::get('master/lembaga/create', ['as' => 'master.lembaga.create', 'uses' => 'LembagaController@create']);
    Route::get('master/lembaga/lihat/{id}', ['as' => 'master.lembaga.lihat', 'uses' => 'LembagaController@show']);
    Route::get('master/lembaga/sunting/{id}', ['as' => 'master.lembaga.sunting', 'uses' => 'LembagaController@sunting']);
    Route::post('master/lembaga/sunting/{id}', ['as' => 'master.lembaga.sunting.post', 'uses' => 'LembagaController@update']);
    Route::post('master/lembaga/create', ['as' => 'master.lembaga.create.post', 'uses' => 'LembagaController@store']);

});
