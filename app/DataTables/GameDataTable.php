<?php

namespace App\DataTables;

use App\Game;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class GameDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'game.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Game $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Game $model)
    {
        $data = $_GET;
        $countryId = !empty($data['countryId']) ? $data['countryId'] : '';
        $sportId = !empty($data['sportId']) ? $data['sportId'] : '';
        $teamId = !empty($data['teamId']) ? $data['teamId'] : '';
        $tournamentId = !empty($data['tournamentId']) ? $data['tournamentId'] : '';
        //монстр
        $models_one = $model->newQuery()
                    ->select('games.*', 'sports.name as sport', 'm1.name as member1', 'm2.name as member2', 'countries.name as country', 'tournaments.name as tournament')
                    ->leftJoin('countries', 'countries.id', '=', 'games.country_id')
                    ->leftJoin('sports', 'sports.id', '=', 'games.sport_id')
                    ->leftJoin('tournaments', 'tournaments.id', '=', 'games.tournament_id')
                    ->Join('players as m1', function($join){
                        return $join->on('m1.id', '=', 'games.member_one')
                                    ->where('games.gameable_type', '=', 'players');
                    })
                    ->Join('players as m2', function($join){
                        return $join->on('m2.id', '=', 'games.member_two')
                                    ->where('games.gameable_type', '=', 'players');
                    })
                    ->when($sportId, function ($query) use ($sportId) {
                        return $query->where('games.sport_id', $sportId);
                    })
                    ->when($teamId, function ($query) use ($teamId) {
                        return $query->where('games.member_one', $teamId)->orWhere('games.member_two', $teamId);
                    })
                    ->when($countryId, function ($query) use ($countryId) {
                        return $query->where('games.country_id', $countryId);
                    });
        $models = $model->newQuery()
                    ->select('games.*', 'sports.name as sport', 'm1.name as member1', 'm2.name as member2', 'countries.name as country', 'tournaments.name as tournament')
                    ->leftJoin('countries', 'countries.id', '=', 'games.country_id')
                    ->leftJoin('sports', 'sports.id', '=', 'games.sport_id')
                    ->leftJoin('tournaments', 'tournaments.id', '=', 'games.tournament_id')
                    ->Join('teams as m1', function($join){
                        return $join->on('m1.id', '=', 'games.member_one')
                                    ->where('games.gameable_type', '=', 'teams');
                    })
                    ->Join('teams as m2', function($join){
                        return $join->on('m2.id', '=', 'games.member_two')
                                    ->where('games.gameable_type', '=', 'teams');
                    })
                    ->when($sportId, function ($query) use ($sportId) {
                        return $query->where('games.sport_id', $sportId);
                    })
                    ->when($teamId, function ($query) use ($teamId) {
                        return $query->where('games.member_one', $teamId)->orWhere('games.member_two', $teamId);
                    })
                    ->when($countryId, function ($query) use ($countryId) {
                        return $query->where('games.country_id', $countryId);
                    })
                    ->union($models_one);

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
                        "columnDefs" => [
                            ["width" => "30px", "targets" => 0],
                            ["width" => "20px", "targets" => 2],
                            ["width" => "20px", "targets" => 3]
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
            'member1' => ['name' => 'm1.name', "orderable" => false],
            'score_one' => ["orderable" => false],
            'score_two'=> ["orderable" => false],
            'member2' => ['name' => 'm2.name', "orderable" => false],
            'date',
            'tournament' => ['name' => 'tournaments.name', "orderable" => false],
            'sport' => ['name' => 'sports.name', "orderable" => false],
            'country' => ['name' => 'countries.name', "orderable" => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'gamedatatable_' . time();
    }
}
