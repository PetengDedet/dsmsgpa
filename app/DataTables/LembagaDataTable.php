<?php

namespace App\DataTables;

use App\Lembaga;
use Hashids;
use Yajra\Datatables\Services\DataTable;

class LembagaDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $lembaga = $this->query();
        return $this->datatables
            ->eloquent($lembaga)
            ->editColumn('id', function($lembaga)
            {
                return $lembaga->hashid;
            })
            ->addColumn('action', function($lembaga){
                return '<div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="fa fa-bars"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="' . url('master/lembaga/lihat/' . $lembaga->hashid) . '"><i class="fa fa-eye"></i> Lihat</a></li>
                                <li><a href="' . url('master/lembaga/sunting/' . $lembaga->hashid) . '"><i class="fa fa-pencil"></i> Sunting</a></li>
                                <li><a href="' . url('master/lembaga/hapus/' . $lembaga->hashid) . '" onclick="return confirm(\'Yakin akan menghapus lembaga ini?\')"><i class="fa fa-trash-o"></i> Hapus</a></li>
                            </ul>
                        </div>';
            })
            ->editColumn('jenis_lembaga', function($lembaga)
            {
                return strtoupper(str_replace('_', ' ', $lembaga->jenis_lembaga));
            })
            ->editColumn('induk_langsung', function($lembaga)
            {
                if ($lembaga->naungan != null) {
                    return $naungan = $lembaga->naungan->alias;
                }
                return '-';
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
        $query = Lembaga::query();

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
            'alias',
            'nama_lembaga',
            'jenis_lembaga',
            'induk_langsung'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'lembagadatatables_' . time();
    }
}
