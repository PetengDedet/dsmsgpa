<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;
use Hashids;
use Auth;
use Session;
use App\DataTables\PersonaliaDataTable;

use App\Personalia;
use App\RiwayatPendidikan;
use App\RiwayatOrganisasi;
use App\Kontak;
use App\Alamat;

class PersonaliaController extends Controller
{
    //
    public function index(PersonaliaDataTable $dataTable)
    {
        return $dataTable->render('personalia.index');
    }

    public function create(Request $request)
    {
        return view('personalia.create');
    }

    public function kirimDataDiri(Request $request)
    {
        $resp = [
            'status'    => false,
            'data'      => [],
            'message'   => ''
        ];

        $validator = Validator::make($request->all(), [
            'nomor_induk'           => 'required|max:255',
            'nama'                  => 'required|max:255',
            'jk'                    => 'required|in:L,P',
            'tempat_lahir'          => 'required|max:255',
            'tanggal_lahir'         => 'required|max:255',
            'pendidikan_terakhir'   => 'required|in:sma_sederajat,diploma,s1,s2,s3,lainnya',
            'tmt'                   => 'required|max:5'
        ]);

        if ($validator->fails()) {
            $resp['message'] = $validator->errors();
            return response()->json($resp,200);
        }

        
        if (null != $request->edit) {
            $personalia = Personalia::findOrFail(Hashids::connection('personalia')->decode($request->edit)[0]);
        }else{
            //Cek Unikqueness of Nomor Induk
            if (Personalia::where('nomor', $request->nomor_induk)->count() > 0) {
               $resp['message'] = 'Personalia dengan nomor induk ' . $request->nomor_induk . ' sudah ada di database.';
                return response()->json($resp,200); 
            }
            
            $personalia = new Personalia;
        }

        $personalia->nomor = $request->nomor_induk;
        $personalia->nama = $request->nama;
        $personalia->alias = $request->alias;
        $personalia->jk = $request->jk;
        $personalia->tempat_lahir = $request->tempat_lahir;
        $personalia->tanggal_lahir = \App\Library\Datify::toDate($request->tanggal_lahir);
        $personalia->pendidikan_terakhir = $request->pendidikan_terakhir;
        $personalia->tmt = trim($request->tmt);

        if (!$personalia->save()) {
            $resp['message'] = 'Gagal menyimpan ke database';
            return response()->json($resp,200);
        }

        $resp = [
            'status' => true,
            'data' => $personalia,
            'message' => 'Berhasil menyimpan personalia baru'
        ];

        return response()->json($resp, 200);
    }

    public function kirimRiwayatPendidikan(Request $request)
    {
        $resp = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];
        
        $validator = Validator::make($request->all(), [
            'personalia_id' => 'required', 
            'nama_lembaga_pendidikan' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            $resp['message'] = $validator->errors();
            return response()->json($resp,200);
        }

        $personalia = Personalia::findOrFail(Hashids::connection('personalia')->decode($request->personalia_id)[0]);

        if (! $personalia) {
            $resp['message'] = 'Personalia tidak valid';
            return response()->json($resp,200);
        }

        $riwayatPendidikan = new RiwayatPendidikan;

        $riwayatPendidikan->personalia_id = $personalia->id;
        $riwayatPendidikan->jenis_pendidikan = $request->jenis_pendidikan;
        $riwayatPendidikan->nama_lembaga = $request->nama_lembaga_pendidikan;

        $riwayatPendidikan->sejak = (null != $request->masa_pendidikan_sejak) ? \App\Library\Datify::toDate($request->masa_pendidikan_sejak) : null;
        $riwayatPendidikan->hingga = (null != $request->masa_pendidikan_hingga) ? \App\Library\Datify::toDate($request->masa_pendidikan_hingga) : null;
        $riwayatPendidikan->gelar = $request->gelar_akademis;

        if ($request->hasFile('dokumen_pendukung')) {

            $fileName  = 'Dokumen_Pendidikan-';
            $fileName .= $personalia->hashid;
            $fileName .=  '.' . str_random(2) . '.';
            $fileName .= pathinfo($request->file('dokumen_pendukung')->getClientOriginalName(), PATHINFO_EXTENSION);

            if(!$request->file('upload')->move(storage_path() . '/file_pendukung/', $fileName)){
                return response()->json(['status' => false, 'data' => [], 'message' => 'Gagal mengupload']);
            }

            $riwayatPendidikan->dokumen = $fileName;
        }

        if (!$riwayatPendidikan->save()) {
            $resp['message'] = 'Gagal menyimpan ke database';
            return response()->json($resp,200);
        }

        $resp = [
            'status' => true,
            'data' => $riwayatPendidikan,
            'hashid' => $personalia->hashid,
            'message' => 'Berhasil menyimpan personalia baru'
        ];

        return response()->json($resp, 200);
    }

    public function hapusRiwayatPendidikan(Request $request)
    {
        $resp = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];
        $this->validate($request, [
            'hashid' => 'required'
        ]);

        $riwayatPendidikan = RiwayatPendidikan::findOrFail(Hashids::connection('riwayat_pendidikan')->decode($request->hashid)[0]);

        if (! $riwayatPendidikan) {
            $resp['message'] = 'Riwayat Pendidikan tidak valid';
            return response()->json($resp,200);
        }

        if ($riwayatPendidikan->delete()) {
            $resp['status'] = true;
            $resp['message'] = 'Berhasil menghapus riwayat pendidikan';
        }
         
        return response()->json($resp,200);
    }

    public function kirimKontak(Request $request)
    {
        $resp = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];
        
        $validator = Validator::make($request->all(), [
            'personalia_id' => 'required',
            'jenis_kontak' => 'required|in:telepon,email,facebook,lainnya,website',
            'kontak_value' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            $resp['message'] = $validator->errors();
            return response()->json($resp,200);
        }

        $personalia = Personalia::findOrFail(Hashids::connection('personalia')->decode($request->personalia_id)[0]);

        if (! $personalia) {
            $resp['message'] = 'Personalia tidak valid';
            return response()->json($resp,200);
        }

        $kontak = new Kontak;

        $kontak->personalia_id = $personalia->id;
        $kontak->jenis_kontak = $request->jenis_kontak;
        $kontak->identifier = $request->kontak_value;

        if (!$kontak->save()) {
            $resp['message'] = 'Gagal menyimpan ke database';
            return response()->json($resp,200);
        }

        $resp = [
            'status' => true,
            'data' => $kontak,
            'hashid' => $personalia->hashid,
            'message' => 'Berhasil menyimpan kontak baru'
        ];

        return response()->json($resp, 200);
    }

    public function hapusKontak(Request $request)
    {
        $resp = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];
        $this->validate($request, [
            'hashid' => 'required'
        ]);

        $kontak = Kontak::findOrFail(Hashids::connection('kontak')->decode($request->hashid)[0]);

        if (! $kontak) {
            $resp['message'] = 'Kontak tidak valid';
            return response()->json($resp, 200);
        }

        if ($kontak->delete()) {
            $resp['status'] = true;
            $resp['message'] = 'Berhasil menghapus kontak';
        }
         
        return response()->json($resp, 200);
    }

    public function kirimAlamat(Request $request)
    {
        $resp = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];
        
        $validator = Validator::make($request->all(), [
            'personalia_id' => 'required',
            'alamat' => 'required|max:1000'
        ]);

        if ($validator->fails()) {
            $resp['message'] = $validator->errors();
            return response()->json($resp,200);
        }

        $personalia = Personalia::findOrFail(Hashids::connection('personalia')->decode($request->personalia_id)[0]);

        if (! $personalia) {
            $resp['message'] = 'Personalia tidak valid';
            return response()->json($resp,200);
        }

        $alamat = new Alamat;

        $alamat->personalia_id = $personalia->id;
        $alamat->jalan = $request->alamat;

        if (!$alamat->save()) {
            $resp['message'] = 'Gagal menyimpan ke database';
            return response()->json($resp,200);
        }

        $resp = [
            'status' => true,
            'data' => $alamat,
            'hashid' => $personalia->hashid,
            'message' => 'Berhasil menyimpan alamat baru'
        ];

        return response()->json($resp, 200);
    }

    public function hapusAlamat(Request $request)
    {
        $resp = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];
        $this->validate($request, [
            'hashid' => 'required'
        ]);

        $alamat = Alamat::findOrFail(Hashids::connection('alamat')->decode($request->hashid)[0]);

        if (! $alamat) {
            $resp['message'] = 'Alamat tidak valid';
            return response()->json($resp,200);
        }

        if ($alamat->delete()) {
            $resp['status'] = true;
            $resp['message'] = 'Berhasil menghapus alamat';
        }
         
        return response()->json($resp,200);
    }

    public function kirimOrganisasi(Request $request)
    {
        $resp = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];
        
        $validator = Validator::make($request->all(), [
            'personalia_id' => 'required', 
            'jenis_organisasi' => 'required|in:profit,non_profit,pemerintahan',
            'peran' => 'required|max:255',
            'nama_organisasi' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            $resp['message'] = $validator->errors();
            return response()->json($resp,200);
        }

        $personalia = Personalia::findOrFail(Hashids::connection('personalia')->decode($request->personalia_id)[0]);

        if (! $personalia) {
            $resp['message'] = 'Personalia tidak valid';
            return response()->json($resp,200);
        }

        $organisasi = new RiwayatOrganisasi;

        $organisasi->personalia_id = $personalia->id;
        $organisasi->jenis_organisasi = $request->jenis_organisasi;
        $organisasi->nama_organisasi = $request->nama_organisasi;
        $organisasi->jabatan = $request->peran;

        $organisasi->sejak = (null != $request->masa_peran_sejak) ? \App\Library\Datify::toDate($request->masa_peran_sejak) : null;
        $organisasi->hingga = (null != $request->masa_peran_hingga) ? \App\Library\Datify::toDate($request->masa_peran_hingga) : null;

        if (!$organisasi->save()) {
            $resp['message'] = 'Gagal menyimpan ke database';
            return response()->json($resp,200);
        }

        $resp = [
            'status' => true,
            'data' => $organisasi,
            'hashid' => $personalia->hashid,
            'message' => 'Berhasil menyimpan riwayat organisasi'
        ];

        return response()->json($resp, 200);
    }

    public function hapusOrganisasi(Request $request)
    {
        $resp = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];
        $this->validate($request, [
            'hashid' => 'required'
        ]);

        $organisasi = RiwayatOrganisasi::findOrFail(Hashids::connection('riwayat_organisasi')->decode($request->hashid)[0]);

        if (! $organisasi) {
            $resp['message'] = 'Riwayat Organisasi tidak valid';
            return response()->json($resp,200);
        }

        if ($organisasi->delete()) {
            $resp['status'] = true;
            $resp['message'] = 'Berhasil menghapus riwayat organisasi';
        }
         
        return response()->json($resp,200);
    }

    public function show($hashid)
    {
        $resp = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];

        $personalia = Personalia::with('pelantikan.lembaga')
                    ->with('pelantikan.jabatan')
                    ->findOrFail(Hashids::connection('personalia')->decode($hashid)[0]);
        if (! $personalia) {
            $resp['message'] = 'Personalia tidak valid';
            return response()->json($resp,200);
        }

        return view('personalia.single', compact('personalia'));
    }

    public function editNama(Request $request)
    {
        // dd($request->request);
        $resp = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];
        
        $validator = Validator::make($request->all(), [
            'pk' => 'required',
            'value' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            $resp['message'] = $validator->errors();
            return response()->json($resp,200);
        }

        $personalia = Personalia::findOrFail(Hashids::connection('personalia')->decode($request->pk)[0]);

        if (! $personalia) {
            $resp['message'] = 'Personalia tidak valid';
            return response()->json($resp,200);
        }

        $personalia->nama = $request->value;

        if (!$personalia->save()) {
            $resp['message'] = 'Gagal Menyimpan';
            return response()->json($resp,200);
        }

        $resp['status'] = true;    
        $resp['message'] = 'Berhasil menyimpan';

        return response()->json($resp,200);
    }

    public function editAlias(Request $request)
    {
        // dd($request->request);
        $resp = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];
        
        $validator = Validator::make($request->all(), [
            'pk' => 'required',
            'value' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            $resp['message'] = $validator->errors();
            return response()->json($resp,200);
        }

        $personalia = Personalia::findOrFail(Hashids::connection('personalia')->decode($request->pk)[0]);

        if (! $personalia) {
            $resp['message'] = 'Personalia tidak valid';
            return response()->json($resp,200);
        }

        $personalia->alias = $request->value;

        if (!$personalia->save()) {
            $resp['message'] = 'Gagal Menyimpan';
            return response()->json($resp,200);
        }

        $resp['status'] = true;    
        $resp['message'] = 'Berhasil menyimpan';

        return response()->json($resp,200);
    }

    public function editJk(Request $request)
    {
        // dd($request->request);
        $resp = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];
        
        $validator = Validator::make($request->all(), [
            'pk' => 'required',
            'value' => 'required|in:L,P'
        ]);

        if ($validator->fails()) {
            $resp['message'] = $validator->errors();
            return response()->json($resp,200);
        }

        $personalia = Personalia::findOrFail(Hashids::connection('personalia')->decode($request->pk)[0]);

        if (! $personalia) {
            $resp['message'] = 'Personalia tidak valid';
            return response()->json($resp,200);
        }

        $personalia->jk = $request->value;

        if (!$personalia->save()) {
            $resp['message'] = 'Gagal Menyimpan';
            return response()->json($resp,200);
        }

        $resp['status'] = true;    
        $resp['message'] = 'Berhasil menyimpan';

        return response()->json($resp,200);
    }

    public function editTempatLahir(Request $request)
    {
        // dd($request->request);
        $resp = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];
        
        $validator = Validator::make($request->all(), [
            'pk' => 'required',
            'value' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            $resp['message'] = $validator->errors();
            return response()->json($resp,200);
        }

        $personalia = Personalia::findOrFail(Hashids::connection('personalia')->decode($request->pk)[0]);

        if (! $personalia) {
            $resp['message'] = 'Personalia tidak valid';
            return response()->json($resp,200);
        }

        $personalia->tempat_lahir = $request->value;

        if (!$personalia->save()) {
            $resp['message'] = 'Gagal Menyimpan';
            return response()->json($resp,200);
        }

        $resp['status'] = true;    
        $resp['message'] = 'Berhasil menyimpan';

        return response()->json($resp,200);
    }

    public function editTanggalLahir(Request $request)
    {
        // dd($request->request);
        $resp = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];
        
        $validator = Validator::make($request->all(), [
            'pk' => 'required',
            'value' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            $resp['message'] = $validator->errors();
            return response()->json($resp,200);
        }

        $personalia = Personalia::findOrFail(Hashids::connection('personalia')->decode($request->pk)[0]);

        if (! $personalia) {
            $resp['message'] = 'Personalia tidak valid';
            return response()->json($resp,200);
        }

        $personalia->tanggal_lahir = $request->value;

        if (!$personalia->save()) {
            $resp['message'] = 'Gagal Menyimpan';
            return response()->json($resp,200);
        }

        $resp['status'] = true;    
        $resp['message'] = 'Berhasil menyimpan';

        return response()->json($resp,200);
    }

    public function editPendidikanTerakhir(Request $request)
    {
        // dd($request->request);
        $resp = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];
        
        $validator = Validator::make($request->all(), [
            'pk' => 'required',
            'value' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            $resp['message'] = $validator->errors();
            return response()->json($resp,200);
        }

        $personalia = Personalia::findOrFail(Hashids::connection('personalia')->decode($request->pk)[0]);

        if (! $personalia) {
            $resp['message'] = 'Personalia tidak valid';
            return response()->json($resp,200);
        }

        $personalia->pendidikan_terakhir = $request->value;

        if (!$personalia->save()) {
            $resp['message'] = 'Gagal Menyimpan';
            return response()->json($resp,200);
        }

        $resp['status'] = true;    
        $resp['message'] = 'Berhasil menyimpan';

        return response()->json($resp,200);
    }

    public function editTmt(Request $request)
    {
        // dd($request->request);
        $resp = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];
        
        $validator = Validator::make($request->all(), [
            'pk' => 'required',
            'value' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            $resp['message'] = $validator->errors();
            return response()->json($resp,200);
        }

        $personalia = Personalia::findOrFail(Hashids::connection('personalia')->decode($request->pk)[0]);

        if (! $personalia) {
            $resp['message'] = 'Personalia tidak valid';
            return response()->json($resp,200);
        }

        $personalia->tmt = $request->value;

        if (!$personalia->save()) {
            $resp['message'] = 'Gagal Menyimpan';
            return response()->json($resp,200);
        }

        $resp['status'] = true;    
        $resp['message'] = 'Berhasil menyimpan';

        return response()->json($resp,200);
    }

    public function editNomor(Request $request)
    {
        // dd($request->request);
        $resp = [
            'status' => false,
            'data' => [],
            'message' => ''
        ];
        
        $validator = Validator::make($request->all(), [
            'pk' => 'required',
            'value' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            $resp['message'] = $validator->errors();
            return response()->json($resp,200);
        }

        $personalia = Personalia::findOrFail(Hashids::connection('personalia')->decode($request->pk)[0]);

        if (! $personalia) {
            $resp['message'] = 'Personalia tidak valid';
            return response()->json($resp,200);
        }

        $personalia->nomor = $request->value;

        if (!$personalia->save()) {
            $resp['message'] = 'Gagal Menyimpan';
            return response()->json($resp,200);
        }

        $resp['status'] = true;    
        $resp['message'] = 'Berhasil menyimpan';

        return response()->json($resp,200);
    }

    public function getJson(Request $r)
    {
        $resp = [
            'status' => false,
            'results' => [],
            'message' => ''
        ];

        if (!Auth::check()) {
            return response()->json($resp, 401);
        }

        if (null !== $r->q AND $r->q != '') {    
            $p = Personalia::where('nomor', 'LIKE', '%' . $r->q . '%')
                    ->orWhere('nama', 'LIKE', '%' . $r->q . '%')
                    ->orWhere('alias', 'LIKE', '%' . $r->q . '%')
                    ->take(5)
                    ->get();

            if (count($p) > 0) {
                $resp['status'] = true;
        
                foreach ($p as $k => $v) {
                    $alias = ($v->alias != null) ? ' (' . $v->alias . ')' : '';

                    $resp['results'][] = [
                        'id' => $v->hashid,
                        'text' => $v->nama . $alias . ' - ' . $v->nomor 
                    ];
                }
            }else{
                $resp['message'] = 'Personalia tidak ditemukan';
            }
        }

        return response()->json($resp, 200);
    }
}
