<?php

namespace App\DataTables;

use App\Tournament;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class TournamentDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'tournament.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Tournament $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Tournament $model)
    {
        $data = $_GET;
        $sportId = !empty($data['sportId']) ? $data['sportId'] : '';
        $countryId = !empty($data['countryId']) ? $data['countryId'] : '';
        $models = $model->newQuery()
                    ->select('tournaments.*', 'sports.name as sport', 'countries.name as country')
                    ->leftJoin('sports', 'sports.id', '=', 'tournaments.sport_id')
                    ->leftJoin('countries', 'countries.id', '=', 'tournaments.country_id')
                    ->when($sportId, function ($query) use ($sportId) {
                        return $query->where('tournaments.sport_id', $sportId);
                    })
                     ->when($countryId, function ($query) use ($countryId) {
                        return $query->where('tournaments.country_id', $countryId);
                    });

        return $models;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
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
            'keywords',
            'sport' => ['name' => 'sports.name'],
            'country' => ['name' => 'countries.name'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'tournamentdatatable_' . time();
    }
}
