<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GameRequest;
use App\DataTables\GameDataTable;
use App\Country;
use App\Sport;
use App\Team;
use App\Player;
use App\Tournament;
use App\Game;

class GameController extends Controller
{
    public $selectCountryList;
    public $selectSportList;
    public $selectTeamList;
    public $selectPlayerList;
    public $selectTournamentList;

    public function __construct()
    {
        $this->selectCountryList = Country::pluck('name', 'id');
        $this->selectSportList = Sport::pluck('name', 'id');
        $this->selectTeamList = Team::pluck('name', 'id');
        $this->selectPlayerList = Player::pluck('name', 'id');
        $this->selectTournamentList = Tournament::pluck('name', 'id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GameDataTable $dataTable, Game $model)
    {
        $dataTable->query($model);

        return $dataTable->render('game.index');
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!$request->ajax()){
            return redirect('game');
        }

        return view("game.create", [
            'selectCountryList' => $this->selectCountryList,
            'selectSportList' => $this->selectSportList, 
            'selectTeamList' => $this->selectTeamList,
            'selectTournamentList' => $this->selectTournamentList,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GameRequest $request)
    {
        Game::create($request->input())->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo 'sark';exit;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        if(!$request->ajax()){
            return redirect('game');
        }

        $model = Game::find($id);

        return view("game.edit", [
            'selectCountryList' => $this->selectCountryList,
            'selectSportList' => $this->selectSportList,
            'selectTeamList' => $this->selectTeamList,
            'model' => $model
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, GameRequest $request)
    {
        $model = Game::find($id);
        $model->fill($request->input())->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id, Request $request)
    {
        if(!$request->ajax()){
            return redirect('game');
        }
        $model = Game::find($id);

        return view("game.delete", ['model' => $model]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Game::destroy($id);

        return redirect()->back();
    }
}
