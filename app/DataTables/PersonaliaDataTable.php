<?php

namespace App\DataTables;

use App\Personalia;
use Carbon\Carbon;
use Yajra\Datatables\Services\DataTable;

class PersonaliaDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $personalia = $this->query();
        return $this->datatables
            ->eloquent($personalia)
            ->editColumn('jk', function($personalia)
            {
                return (($personalia->jk == 'L') ? '<i class="fa fa-male"></i> ' : '<i class="fa fa-female" style="color:red;"></i> ' ) . Carbon::parse($personalia->tanggal_lahir)->age . 'Th';
            })
            ->addColumn('action', function($personalia){
                return '<div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="fa fa-bars"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="' . url('personalia/lihat/' . $personalia->hashid) . '"><i class="fa fa-eye"></i> Lihat</a></li>
                                <li><a href="' . url('personalia/sunting/' . $personalia->hashid) . '"><i class="fa fa-pencil"></i> Sunting</a></li>
                                <li><a href="' . url('personalia/hapus/' . $personalia->hashid) . '" onclick="return confirm(\'Yakin akan menghapus user ini?\')"><i class="fa fa-trash-o"></i> Hapus</a></li>
                                <li><a href="' . url('personalia/cetak/' . $personalia->hashid) . '"><i class="fa fa-print"></i> Cetak</a></li>
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
        $query = Personalia::latest();

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
            'nomor',
            'nama',
            'jk',
            'tmt',

            // add your columns
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'personaliadatatables_' . time();
    }
}
