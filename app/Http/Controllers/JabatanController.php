<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Hash;
use Hashids;
use Session;

use App\DataTables\JabatanDataTable;
use App\Jabatan;

class JabatanController extends Controller
{
    //
    public function index(JabatanDataTable $dataTable)
    {
    	return $dataTable->render('master.jabatan');
    }

    public function create(Request $request)
    {
    	return view('master.jabatan-create');
    }

    public function show($id)
    {
        $id = Hashids::connection('jabatan')->decode($id);
        if (count($id) == 0) {
            abort(404);
        }

        $jabatan = Jabatan::findOrFail($id[0]);

        return view('master.jabatan-detail', compact('jabatan'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_jabatan' => 'required|in:pendidik,tenaga_kependidikan,strategis,profesional,lainnya',
            'nama_jabatan' => 'required|max:255',
            'alias' => 'max:255',
            'tugas_jabatan' => 'max:255',
            'keterangan' => 'max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $jabatan = new Jabatan();
        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->jenis_jabatan = $request->jenis_jabatan;
        $jabatan->alias_jabatan = $request->alias;
        $jabatan->tugas_jabatan = $request->tugas_jabatan;
        $jabatan->keterangan = $request->keterangan;

        if ($jabatan->save()) {
            Session::flash('message', 'Berhasil menambah jabatan');
            Session::flash('alert-class', 'alert-success');
        }

        return redirect('master/jabatan');
    }

    public function sunting($id)
    {
        $id = Hashids::connection('jabatan')->decode($id);
        if (count($id) > 0) {
            $jabatan = Jabatan::findOrFail($id[0]);
        }

        return view('master.Jabatan-sunting', compact('jabatan'));
    }

    public function update($id, Request $request)
    {
        $id = Hashids::connection('jabatan')->decode($id);
        if (count($id) == 0) {
            abort(404);
        }

        $jabatan = Jabatan::findOrFail($id[0]);

        $validator = Validator::make($request->all(), [
            'jenis_jabatan' => 'required|in:pendidik,tenaga_kependidikan,strategis,profesional,lainnya',
            'nama_jabatan' => 'required|max:255',
            'alias' => 'max:255',
            'tugas_jabatan' => 'max:255',
            'keterangan' => 'max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->jenis_jabatan = $request->jenis_jabatan;
        $jabatan->alias_jabatan = $request->alias;
        $jabatan->tugas_jabatan = $request->tugas_jabatan;
        $jabatan->keterangan = $request->keterangan;

        if ($jabatan->save()) {
            Session::flash('message', 'Berhasil menambah jabatan');
            Session::flash('alert-class', 'alert-success');
        }

        return redirect('master/jabatan');
    }
}
