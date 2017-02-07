<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Hash;
use Hashids;
use Session;

use App\DataTables\LembagaDataTable;
use App\Lembaga;

class LembagaController extends Controller
{
    //
    public function index(LembagaDataTable $dataTable)
    {
    	return $dataTable->render('master.lembaga');
    }

    public function create(Request $request)
    {
    	$lembaga = Lembaga::all();
    	return view('master.lembaga-create', compact('lembaga'));
    }

    public function show($id)
    {
        $id = Hashids::connection('lembaga')->decode($id);
        if (count($id) == 0) {
            abort(404);
        }

        $lembaga = Lembaga::findOrFail($id[0]);

        return view('master.lembaga-detail', compact('lembaga'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_lembaga' => 'required|in:pendidikan,non_pendidikan',
            'nama' => 'required|max:255',
            'alias' => 'max:255',
            'alamat' => 'max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $lembaga = new Lembaga();
        $lembaga->nama_lembaga = $request->nama;
        $lembaga->jenis_lembaga = $request->jenis_lembaga;
        $lembaga->alias = $request->alias;
        $lembaga->alamat = $request->alamat;

        if (null != $request->induk_langsung) {
            $idInduk = Hashids::connection('lembaga')->decode($request->induk_langsung);
            if (count($idInduk) > 0) {
                $induk = Lembaga::findOrFail($idInduk[0]);
                $lembaga->induk_langsung = $induk->id;
            }
        }

        if ($lembaga->save()) {
            Session::flash('message', 'Berhasil menambah lembaga');
            Session::flash('alert-class', 'alert-success');
        }

        return redirect('master/lembaga');
    }

    public function sunting($id)
    {
        $id = Hashids::connection('lembaga')->decode($id);
        if (count($id) > 0) {
            $lembaga = Lembaga::findOrFail($id[0]);
        }
        
        $lembagas = Lembaga::all();
        return view('master.lembaga-sunting', compact('lembaga', 'lembagas'));
    }

    public function update($id, Request $request)
    {
        $id = Hashids::connection('lembaga')->decode($id);
        if (count($id) == 0) {
            abort(404);
        }

        $lembaga = Lembaga::findOrFail($id[0]);

        $validator = Validator::make($request->all(), [
            'jenis_lembaga' => 'required|in:pendidikan,non_pendidikan',
            'nama' => 'required|max:255',
            'alias' => 'max:255',
            'alamat' => 'max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $lembaga->nama_lembaga = $request->nama;
        $lembaga->jenis_lembaga = $request->jenis_lembaga;
        $lembaga->alias = $request->alias;
        $lembaga->alamat = $request->alamat;

        if (null != $request->induk_langsung && $request->induk_langsung != '0') {
            $idInduk = Hashids::connection('lembaga')->decode($request->induk_langsung);
            if (count($idInduk) > 0) {
                $induk = Lembaga::findOrFail($idInduk[0]);
                $lembaga->induk_langsung = $induk->id;
            }
        }else{
            $lembaga->induk_langsung = 0;
        }

        if ($lembaga->save()) {
            Session::flash('message', 'Berhasil memperbaharui lembaga');
            Session::flash('alert-class', 'alert-success');
        }

        return redirect('master/lembaga');
    }
}
