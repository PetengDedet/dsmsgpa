<?php

namespace App\DataTables;

use App\Pelantikan;
use Yajra\Datatables\Services\DataTable;

class PelantikanDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $pelantikan = $this->query();
        return $this->datatables
            ->eloquent($pelantikan)
            ->editColumn('id', function($pelantikan){
                return $pelantikan->hashid;
            })
            ->editColumn('personalia.nama', function($pelantikan)
            {
                return $pelantikan->personalia->nama . '<br><small>' . $pelantikan->personalia->nomor . '</small>';
            })
            ->editColumn('jabatan.nama_jabatan', function($pelantikan){
                $r = $pelantikan->jabatan->nama_jabatan;
                if($pelantikan->jabatan->alias_jabatan != null) {
                    $r .= ' (' . $pelantikan->jabatan->alias_jabatan . ')';
                }

                $r .= '<br><label class="label label-default">' . ucwords(str_replace('_', ' ', $pelantikan->jabatan->jenis_jabatan)) . '</label>';

                return $r;
            })
            ->editColumn('lembaga.nama_lembaga', function($pelantikan){
                $r = $pelantikan->lembaga->nama_lembaga;
                if($pelantikan->lembaga->alias != null) {
                    $r .= ' (' . $pelantikan->lembaga->alias . ')';
                }

                $r .= '<br><label class="label label-default">' . ucwords(str_replace('_', ' ', $pelantikan->lembaga->jenis_lembaga)) . '</label>';

                return $r;
            })
            ->addColumn('periode', function($pelantikan) {
                return $pelantikan->period['formatSejak'] . ' <strong>sd/</strong> ' . $pelantikan->period['formatHingga'] . '<br>' . $pelantikan->period['duration'] . ' hari';
            })
            ->addColumn('status', function($pelantikan) {
                return 'Aktif';
            })
            ->addColumn('action', function($pelantikan){
                return '<div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="fa fa-bars"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="' . url('pelantikan/lihat/' . $pelantikan->hashid) . '"><i class="fa fa-eye"></i> Lihat</a></li>
                                <li><a href="' . url('pelantikan/sunting/' . $pelantikan->hashid) . '"><i class="fa fa-pencil"></i> Sunting</a></li>
                            </ul>
                        </div>';
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Pelantikan::with('personalia')->with('jabatan')->with('lembaga')
                    // ->orderBy('personalia.nama', 'ASC')
                    // ->orderBy('lembaga.nama_lembaga', 'ASC' )
                    ->latest();

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // add your columns
            [
                'name' => 'id',
                'title' => 'Hashid', 
                'data' => 'id',
                'orderable' => false,
                'searchable' => false
            ],
            [
                'name' => 'personalia.nama', 
                'title' => 'Personalia',
                'data' => 'personalia.nama',
                'orderable' => false,
                'searchable' => true
            ],
            [
                'name' => 'jabatan.nama_jabatan',    
                'title' => 'Jabatan',
                'data' => 'jabatan.nama_jabatan',
                'orderable' => false,
                'searchable' => true
            ],
            [
                'name' => 'lembaga.nama_lembaga',    
                'title' => 'Lembaga',
                'data' => 'lembaga.nama_lembaga',
                'orderable' => false,
                'searchable' => true
            ],
            'periode' => [
                'name' => 'periode',       
                'title' => 'Periode',
                'orderable' => false,
                'searchable' => false
            ],
            'status' => [
                'name' => 'status',
                'orderable' => false,
                'searchable' => false
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'pelantikandatatables_' . time();
    }
}
