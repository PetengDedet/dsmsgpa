<?php

namespace App\DataTables;

use App\Jabatan;
use Hashids;
use Yajra\Datatables\Services\DataTable;

class JabatanDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $jabatan = $this->query();
        return $this->datatables
            ->eloquent($jabatan)
            ->editColumn('id', function($jabatan)
            {
                return $jabatan->hashid;
            })
            ->addColumn('action', function($jabatan){
                return '<div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="fa fa-bars"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="' . url('master/jabatan/lihat/' . $jabatan->hashid) . '"><i class="fa fa-eye"></i> Lihat</a></li>
                                <li><a href="' . url('master/jabatan/sunting/' . $jabatan->hashid) . '"><i class="fa fa-pencil"></i> Sunting</a></li>
                                <li><a href="' . url('master/jabatan/hapus/' . $jabatan->hashid) . '" onclick="return confirm(\'Yakin akan menghapus jabatan ini?\')"><i class="fa fa-trash-o"></i> Hapus</a></li>
                            </ul>
                        </div>';
            })
            ->editColumn('jenis_jabatan', function($jabatan)
            {
                return strtoupper(str_replace('_', ' ', $jabatan->jenis_jabatan));
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
        $query = Jabatan::query();

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
            'id',
            'nama_jabatan',
            'alias_jabatan',
            'jenis_jabatan',
            'tugas_jabatan'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'jabatandatatables_' . time();
    }
}
