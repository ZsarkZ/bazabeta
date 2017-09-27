<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PlayerRequest;
use App\DataTables\PlayerDataTable;
use App\Team;
use App\Sport;
use App\Player;
use App\Country;

class PlayerController extends Controller
{
    public $selectSportList;
    public $selectTeamList;

    public function __construct()
    {
        $this->selectCountryList = Country::pluck('name', 'id');
        $this->selectSportList = Sport::pluck('name', 'id');
        $this->selectTeamList = Team::pluck('name', 'id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PlayerDataTable $dataTable, Player $model)
    {
        $dataTable->query($model);

        return $dataTable->render('player.index');
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!$request->ajax()){
            return redirect('player');
        }
        

        return view("player.create", [
            'selectCountryList' => $this->selectCountryList,
            'selectSportList' => $this->selectSportList, 
            'selectTeamList' => $this->selectTeamList,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlayerRequest $request)
    {
        Player::create($request->input())->save();

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
            return redirect('player');
        }

        $model = Player::find($id);

        return view("player.edit", [
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
    public function update($id, PlayerRequest $request)
    {
        $model = Player::find($id);
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
            return redirect('player');
        }
        $model = Player::find($id);

        return view("player.delete", ['model' => $model]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Player::destroy($id);

        return redirect()->back();
    }
}
