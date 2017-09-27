<?php

namespace App\DataTables;

use App\Player;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class PlayerDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'player.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Player $model)
    {
        $data = $_GET;
        $sportId = !empty($data['sportId']) ? $data['sportId'] : '';
        $teamId = !empty($data['teamId']) ? $data['teamId'] : '';
        $countryId = !empty($data['countryId']) ? $data['countryId'] : '';
        $models = $model->newQuery()
                    ->select('players.*', 'sports.name as sport', 'teams.name as team', 'countries.name as country')
                    ->leftJoin('sports', 'sports.id', '=', 'players.sport_id')
                    ->leftJoin('teams', 'teams.id', '=', 'players.team_id')
                    ->leftJoin('countries', 'countries.id', '=', 'players.country_id')
                    ->when($sportId, function ($query) use ($sportId) {
                        return $query->where('players.sport_id', $sportId);
                    })
                    ->when($teamId, function ($query) use ($teamId) {
                        return $query->where('players.team_id', $teamId);
                    })
                    ->when($countryId, function ($query) use ($countryId) {
                        return $query->where('players.country_id', $countryId);
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
            'team' => ['name' => 'teams.name'],
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
        return 'playerdatatable_' . time();
    }
}
