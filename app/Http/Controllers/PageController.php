<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;
use Hashids;
use Session;

use App\User;
use App\Lembaga;
use App\Anggaran;
use App\Agenda;
use App\Task;
use App\Audit;
use App\Rdk;
use App\TjKeuangan;
use App\Disposisi;

class PageController extends Controller
{
    public function dashboard(Request $r)
    {
        $lembaga = Lembaga::all();
        $audit = Audit::where('tahun', date('Y'))->get();
        $rdk = Rdk::where('tahun', date('Y'))->where('bulan', date('n'))->get();
        $disposisi = Disposisi::where('tahun', date('Y'))->where('bulan', date('n'))->get();

        return view('dashboard', compact('lembaga', 'audit', 'rdk', 'disposisi'));
    }

    public function anggaranIndex(Request $r)
    {
        $lembaga = Lembaga::all();
        $anggaran = Anggaran::orderBy('lembaga_id', 'ASC')
                    ->orderBy('tahun', 'DESC')
                    ->paginate(20);

        return view('anggaran', compact('lembaga', 'anggaran'));
    }

    public function agendaIndex(Request $r)
    {
        $lembaga = Lembaga::all();
        $agenda = Agenda::orderBy('lembaga_id', 'ASC')
                    ->orderBy('tahun', 'DESC')
                    ->orderBy('bulan', 'DESC')
                    ->paginate(20);

        return view('agenda', compact('lembaga', 'agenda'));
    }

    public function simpanAnggaran(Request $r)
    {
        $validation = Validator::make($r->All(), [
            'lembaga' => 'required',
            'tahun' => 'required',
            'pagu' => 'required',
            'realisasi' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->with($validation->errors);
        }

        $anggaran = Anggaran::updateOrCreate(
            [
                'lembaga_id' => $r->lembaga,
                'tahun' => $r->tahun
            ],
            [
                'pagu' => $r->pagu,
                'realisasi' => $r->realisasi
            ]
        );

        return redirect()->back()->with('msg', 'Berhasil menyimpan');
    }

    public function simpanAgenda(Request $r)
    {
        $validation = Validator::make($r->All(), [
            'lembaga' => 'required',
            'tahun' => 'required',
            'bulan' => 'required',
            'agenda' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->with($validation->errors);
        }

        $anggaran = Agenda::updateOrCreate(
            [
                'lembaga_id' => $r->lembaga
            ],
            [
                'tahun' => $r->tahun,
                'bulan' => $r->bulan,
                'agenda' => $r->agenda
            ]
        );

        return redirect()->back()->with('msg', 'Berhasil menyimpan');
    }

    public function hapusAgenda(Request $r)
    {
        $validation = Validator::make($r->All(), [
            'id' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->with('errors', $validation->errors());
        }

        $id = Hashids::connection('agenda')->decode($r->id);
        if (count($id) != 1) {
            return redirect()->back()->with('errors', $validation->errors());
        }
     
        Agenda::findOrFail($id[0])->delete();

        return redirect()->back()->with('msg', 'Berhasil menghapus agenda');
    }

    public function taskIndex(Request $r)
    {
        $lembaga = Lembaga::all();
        $tasks = Task::orderBy('lembaga_id', 'ASC')
                    ->orderBy('tahun', 'DESC')
                    ->orderBy('bulan', 'ASC')
                    ->paginate(20);

        return view('task', compact('lembaga', 'tasks'));
    }

    public function simpanTask(Request $r)
    {
        //dd($r);
        $validation = Validator::make($r->All(), [
            'lembaga' => 'required',
            'tahun' => 'required',
            'bulan' => 'required',
            'tugas' => 'required',
            'terlaksana' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->with($validation->errors);
        }

        $task = Task::updateOrCreate(
            [
                'lembaga_id' => $r->lembaga,
                'tahun' => $r->tahun,
                'bulan' => $r->bulan
            ],
            [
                'tugas' => $r->tugas,
                'terlaksana' => $r->terlaksana
            ]
        );

        return redirect()->back()->with('msg', 'Berhasil menyimpan');
    }

    public function auditIndex(Request $r)
    {
        $audit = Audit::orderBy('tahun', 'DESC')
                    ->orderBy('triwulan', 'ASC')
                    ->paginate(20);

        return view('audit', compact('lembaga', 'audit'));
    }

    public function simpanAudit(Request $r)
    {
        //dd($r);
        $validation = Validator::make($r->All(), [
            'tahun' => 'required',
            'triwulan' => 'required|in:1,2,3,4',
            'pending' => 'required',
            'selesai' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->with($validation->errors);
        }

        $audit = Audit::updateOrCreate(
            [
                'tahun' => $r->tahun,
                'triwulan' => $r->triwulan
            ],
            [
                'pending' => $r->pending,
                'selesai' => $r->selesai
            ]
        );

        return redirect()->back()->with('msg', 'Berhasil menyimpan');
    }

    public function rdkIndex(Request $r)
    {
        $rdk = Rdk::orderBy('tahun', 'DESC')
                    ->orderBy('bulan', 'ASC')
                    ->paginate(20);

        return view('rdk', compact('rdk'));
    }

    public function simpanRdk(Request $r)
    {
        //dd($r);
        $validation = Validator::make($r->All(), [
            'tahun' => 'required',
            'bulan' => 'required',
            'pending' => 'required',
            'selesai' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->with($validation->errors);
        }

        $rdk = Rdk::updateOrCreate(
            [
                'tahun' => $r->tahun,
                'bulan' => $r->bulan
            ],
            [
                'pending' => $r->pending,
                'selesai' => $r->selesai
            ]
        );

        return redirect()->back()->with('msg', 'Berhasil menyimpan');
    }

    public function keuanganIndex(Request $r)
    {
        $lembaga = Lembaga::all();
        $tj_keuangan = TjKeuangan::orderBy('lembaga_id', 'ASC')
                    ->orderBy('tahun', 'DESC')
                    ->orderBy('bulan', 'ASC')
                    ->paginate(20);
        return view('tj_keuangan', compact('lembaga', 'tj_keuangan'));
    }

    public function simpanKeuangan(Request $r)
    {
        //dd($r);
        $validation = Validator::make($r->All(), [
            'lembaga' => 'required',
            'tahun' => 'required',
            'bulan' => 'required',
            'nilai' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->with($validation->errors);
        }

        $tj_keuangan = TjKeuangan::updateOrCreate(
            [
                'lembaga_id' => $r->lembaga,
                'tahun' => $r->tahun,
                'bulan' => $r->bulan
            ],
            [
                'nilai' => $r->nilai
            ]
        );

        return redirect()->back()->with('msg', 'Berhasil menyimpan');
    }

    public function disposisiIndex(Request $r)
    {
        $lembaga = Lembaga::all();
        $disposisi = Disposisi::orderBy('lembaga_id', 'ASC')
                    ->orderBy('tahun', 'DESC')
                    ->orderBy('bulan', 'ASC')
                    ->paginate(20);
        return view('disposisi', compact('lembaga', 'disposisi'));
    }

    public function simpanDisposisi(Request $r)
    {
        //dd($r);
        $validation = Validator::make($r->All(), [
            'lembaga' => 'required',
            'tahun' => 'required',
            'bulan' => 'required',
            'nilai' => 'required'
        ]);

        if ($validation->fails()) {
            return redirect()->back()->with($validation->errors);
        }

        $disposisi = Disposisi::updateOrCreate(
            [
                'lembaga_id' => $r->lembaga,
                'tahun' => $r->tahun,
                'bulan' => $r->bulan
            ],
            [
                'nilai' => $r->nilai
            ]
        );

        return redirect()->back()->with('msg', 'Berhasil menyimpan');
    }

}