<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hashids;
use Session;
use Carbon\Carbon;

use App\Pelantikan;
use App\Lembaga;
use App\Jabatan;
use App\Personalia;
use App\DataTables\PelantikanDataTable;

class PelantikanController extends Controller
{
    //
    public function index(PelantikanDataTable $dataTable){
        return $dataTable->render('pelantikan.index');
    }

    public function create(Request $r) {
        
        $lembaga = Lembaga::orderBy('jenis_lembaga', 'ASC')->get();
        $jabatan = Jabatan::orderBy('jenis_jabatan', 'ASC')->get();

        return view('pelantikan.new', compact('lembaga', 'jabatan'));
    }

    public function store(Request $r) {
        $validator = Validator::make($r->all(), [
            'personalia'        => 'required',
            'lembaga'           => 'required',
            'jabatan'           => 'required',
            'sejak'             => 'required',
            'hingga'            => 'required',
            'dokumen_pendukung' => 'sometimes|mimes:jpg,jpeg,png,pdf|max:' . env('MAX_FILE_UPLOAD', '20480')
        ]);

        $personalia = Personalia::find(Hashids::connection('personalia')->decode($r->personalia)[0]);
        if (! $personalia) {
            Session::flash('error', 'Personalia tidak ditemukan');
            return redirect()->back()->withInput();
        }

        if ($validator->fails()) {
            Session::flash('personalia', $personalia);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        //Cek Lembaga
        $lembaga = Lembaga::find(Hashids::connection('lembaga')->decode($r->lembaga)[0]);
        if (!$lembaga) {
            Session::flash('error', 'Lembaga Tidak Ditemukan');
            Session::flash('personalia', $personalia);
            return redirect()->back()->withInput();
        }

        //Cek Jabatan
        $jabatan = Jabatan::find(Hashids::connection('jabatan')->decode($r->jabatan)[0]);
        if (!$jabatan) {
            Session::flash('error', 'Jabatan Tidak Ditemukan');
            Session::flash('personalia', $personalia);
            return redirect()->back()->withInput();
        }

        //TODO: Cek existing pelantikan
        $currentDate = Carbon::now();
        $existingPelantikan = Pelantikan::where('personalia_id', $personalia->id)
                            ->where('lembaga_id', $lembaga->id)
                            ->where('jabatan_id', $jabatan->id)
                            // ->where(function($q) use ($r){
                            //     $q->whereBetween('sejak', [\App\Library\Datify::toDate($r->sejak) . ' 00-00-00', \App\Library\Datify::toDate($r->hingga) . ' 00-00-00'])
                            //         ->orWhere(function($h) use ($r){
                            //             $h->whereBetween('hingga', [\App\Library\Datify::toDate($r->sejak) . ' 00-00-00', \App\Library\Datify::toDate($r->hingga) . ' 00-00-00']);
                            //         })
                            //         ;
                            // })
                            ->get();
        // dd($existingPelantikan);
        if (count($existingPelantikan) > 0) {
            foreach ($existingPelantikan as $k => $v) {
                $min = Carbon::parse($v->sejak);
                $max = Carbon::parse($v->hingga);
                $reqSejak = Carbon::parse(\App\Library\Datify::toDate($r->sejak));
                $reqHingga = Carbon::parse(\App\Library\Datify::toDate($r->hingga));
                
                if ($reqSejak->between($min, $max) OR $reqHingga->between($min, $max)) {
                    Session::flash('error', $personalia->nama . ' masih menjabat sebagai ' . $jabatan->nama_jabatan . ' di ' . $lembaga->nama_lembaga . ' hingga ' . $v->period['formatHingga']);            
                } elseif($reqSejak < $min AND $reqHingga > $max) {
                    Session::flash('error', $personalia->nama . ' masih menjabat sebagai ' . $jabatan->nama_jabatan . ' di ' . $lembaga->nama_lembaga . ' hingga ' . $v->period['formatHingga']);
                }
            }
            Session::flash('personalia', $personalia);
            return redirect()->back()->withInput();
        }

        $pelantikan = new Pelantikan();
        $pelantikan->lembaga_id = $lembaga->id;
        $pelantikan->jabatan_id = $jabatan->id;
        $pelantikan->personalia_id = $personalia->id;
        $pelantikan->sejak = \App\Library\Datify::toDate($r->sejak);
        $pelantikan->hingga = \App\Library\Datify::toDate($r->hingga);
        $pelantikan->keterangan = $r->keterangan;
        $pelantikan->dasar_keputusan = $r->dasar_keputusan;

        if ($r->hasFile('dokumen_pendukung')) {
            $fileName  = 'SK-';
            $fileName .= $lembaga->hashid . '-';
            $fileName .= $jabatan->hashid . '-';
            $fileName .= str_random(2) . '.';
            $fileName .= pathinfo($r->file('dokumen_pendukung')->getClientOriginalName(), PATHINFO_EXTENSION);

            if(!$r->file('dokumen_pendukung')->move(storage_path() . '/uploads/sk/', $fileName)){
                // return response()->json(['status' => false, 'data' => [], 'message' => 'Gagal mengupload']);
                Session::flash('error', 'Gagal mengupload SK');
                Session::flash('personalia', $personalia);
                return redirect()->back()->withInput();
            }

            $pelantikan->dokumen_sk = $fileName;
        }

        $pelantikan->save();
        
        Session::flash('message', 'Berhasil melantik ' . $personalia->nama . ' sebagai ' . $jabatan->nama_jabatan . ' di ' . $lembaga->nama_lembaga . ' periode ' . $pelantikan->period['formatSejak'] . ' s/d ' . $pelantikan->period['formatHingga'] );
        return redirect(url('pelantikan'));
    }
}
