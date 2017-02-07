<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;
use Hashids;
use Session;
use App\DataTables\UserDataTable;

use App\User;

class UserController extends Controller
{
    //
    public function index(UserDataTable $dataTable)
    {
    	return $dataTable->render('master.user');
    }

    public function create(Request $request)
    {
    	return view('master.user-create');
    }

    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'username' => 'required|max:255|unique:users',
            'password' => 'required|max:255',
            'type' => 'required|in:admin,user'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->username;
        $user->password = Hash::make($request->password);
        $user->type = $request->type;

        if ($user->save()) {
    		Session::flash('message', 'Berhasil menambah user');
        	Session::flash('alert-class', 'alert-success');
    	}

    	return redirect('master/user');
    }

    public function show($id)
    {
        $id = Hashids::connection('user')->decode($id);
        if (count($id) == 0) {
            abort(404);
        }

        $user = User::findOrFail($id[0]);

        return view('master.user-detail', compact('user'));
    }

    public function destroy($id)
    {
        $id = Hashids::connection('user')->decode($id);
        if (count($id) == 0) {
            abort(404);
        }

        $user = User::findOrFail($id[0]);
        if ($user->delete()) {
            Session::flash('message', 'Berhasil menhapus user');
            Session::flash('alert-class', 'alert-success');
            return redirect('master/user');
        }

        abort(404);
    }
}
