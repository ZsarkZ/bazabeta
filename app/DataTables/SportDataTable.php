<?php

namespace App\DataTables;

use App\Sport;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class SportDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('teams', '<a href="{{ url("team") }}?sportId={{ $id }}">Команды</a>')
                         ->addColumn('players', '<a href="{{ url("player") }}?sportId={{ $id }}">Игроки</a>')
                         ->addColumn('tournaments', '<a href="{{ url("tournament") }}?sportId={{ $id }}">Турниры</a>')
                         ->addColumn('action', 'sport.action')
                         ->rawColumns(['teams','players', 'tournaments', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Sport $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Sport $model)
    {
        return $model->newQuery()->select(['id', 'name']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns(array_merge($this->getColumns()))
                    ->minifiedAjax()
                    ->addAction(['width' => '80px'])
                    ->parameters([
                        'dom'     => 'Bfrtip',
                        'order'   => [[0, 'asc']],
                        "pageLength" => 20,
                        "columnDefs" => [
                            ["width" => "30px", "targets" => 0]
                        ],
                        'buttons' => [
                            'create',
                            'export',
                            'print',
                            'reset',
                            'reload',
                        ],
                    ]);
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
            'name',
            'teams' => ["orderable" => false],
            'players' => ["orderable" => false],
            'tournaments' => ["orderable" => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'sportdatatable_' . time();
    }
}
