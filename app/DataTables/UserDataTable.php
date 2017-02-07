<?php

namespace App\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $user = $this->query();
        return $this->datatables
            ->eloquent($user)
            ->editColumn('id', function($user)
            {
                return $user->hashid;
            })
            ->addColumn('action', function($user){
                return '<div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="fa fa-bars"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="' . url('master/user/lihat/' . $user->hashid) . '"><i class="fa fa-eye"></i> Lihat</a></li>
                                <li><a href="' . url('master/user/hapus/' . $user->hashid) . '" onclick="return confirm(\'Yakin akan menghapus user ini?\')"><i class="fa fa-trash-o"></i> Hapus</a></li>
                            </ul>
                        </div>';
            })
            ->editColumn('type', function($user)
            {
                if ($user->type == 'admin') {
                    return '<i class="fa fa-star" style="color:orange"></i> ADMIN';
                }

                return '<i class="fa fa-user"></i> USER';    
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
        $query = User::query();

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
            'username',
            'name',
            'type',
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
        return 'userdatatables_' . time();
    }
}
