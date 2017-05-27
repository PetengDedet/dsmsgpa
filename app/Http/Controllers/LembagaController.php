<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Hash;
use Hashids;
use Session;

use App\DataTables\LembagaDataTable;
use App\Lembaga;
use Storage;

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
            'nama' => 'required|max:100',
            'alias' => 'max:50',
            'nama_pimpinan' => 'max:255',
            'foto_pimpinan' => 'max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $lembaga = new Lembaga();
        $lembaga->nama = $request->nama;
        $lembaga->alias = $request->alias;
        $lembaga->nama_pimpinan = $request->nama_pimpinan;

        //Upload Foto
        if ($request->hasFile('foto_pimpinan')) {

            $allowedTipe = [
                'jpg', 'jpeg', 'png', 'gif'
            ];

            $validFile = in_array(strtolower(pathinfo($request->file('foto_pimpinan')->getClientOriginalName(), PATHINFO_EXTENSION)), $allowedTipe);

            if (!$validFile) {
                return redirect()->back()->with('errors', '<div class="alert alert-danger">Foto pimpinan harus berupa .png, .jpg, .jpeg, atau .gif</div>');
            }

            $fileName  = 'Foto_Pimpinan_' . str_random(4) . '.';
            $fileName .= strtolower(pathinfo($request->file('foto_pimpinan')->getClientOriginalName(), PATHINFO_EXTENSION));

            if(!$request->file('foto_pimpinan')->move(public_path() . '/img', $fileName)){
                return redirect()->back()->with('errors', '<div class="alert alert-danger">Gagal mengunggah foto pimpinan</div>');
            }

            $lembaga->foto_pimpinan = $fileName;
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
            'nama' => 'required|max:100',
            'alias' => 'max:50',
            'nama_pimpinan' => 'max:255',
            'foto_pimpinan' => 'max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $lembaga->nama = $request->nama;
        $lembaga->alias = $request->alias;
        $lembaga->nama_pimpinan = $request->nama_pimpinan;

        //Upload Foto
        if ($request->hasFile('foto_pimpinan')) {

            $allowedTipe = [
                'jpg', 'jpeg', 'png', 'gif'
            ];

            $validFile = in_array(strtolower(pathinfo($request->file('foto_pimpinan')->getClientOriginalName(), PATHINFO_EXTENSION)), $allowedTipe);

            if (!$validFile) {
                return redirect()->back()->with('errors', '<div class="alert alert-danger">Foto pimpinan harus berupa .png, .jpg, .jpeg, atau .gif</div>');
            }

            $fileName  = 'Foto_Pimpinan_' . str_random(4) . '.';
            $fileName .= strtolower(pathinfo($request->file('foto_pimpinan')->getClientOriginalName(), PATHINFO_EXTENSION));

            if(!$request->file('foto_pimpinan')->move(public_path() . '/img', $fileName)){
                return redirect()->back()->with('errors', '<div class="alert alert-danger">Gagal mengunggah foto pimpinan</div>');
            }

            if (strlen($lembaga->foto_pimpinan) > 0 AND file_exists(public_path() . '/img/' . $lembaga->foto_pimpinan)) {
                unlink(public_path() . '/img/' . $lembaga->foto_pimpinan);
            }

            $lembaga->foto_pimpinan = $fileName;
        }


        if ($lembaga->save()) {
            Session::flash('message', 'Berhasil memperbaharui lembaga');
            Session::flash('alert-class', 'alert-success');
        }

        return redirect('master/lembaga');
    }
}
