<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lembaga;
use App\Jabatan;
use App\Personalia;
use App\Pelantikan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lembaga = Lembaga::count();
        $personalia = Personalia::count();
        $jabatan = Jabatan::count();
        $pelantikan = Pelantikan::count();

        return view('dashboard', compact('lembaga', 'personalia', 'jabatan', 'pelantikan'));
    }
}
