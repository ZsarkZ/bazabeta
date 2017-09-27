<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TeamRequest;
use App\DataTables\TeamDataTable;
use App\Country;
use App\Sport;
use App\Team;

class TeamController extends Controller
{

    public $selectSportList;
    public $selectCountryList;

    public function __construct()
    {
        $this->selectSportList = Sport::pluck('name', 'id');
        $this->selectCountryList = Country::pluck('name', 'id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TeamDataTable $dataTable, Team $model)
    {
        $dataTable->query($model);

        return $dataTable->render('team.index');
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!$request->ajax()){
            return redirect('team');
        }

        return view("team.create", [
            'selectSportList' => $this->selectSportList,
            'selectCountryList' => $this->selectCountryList
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
    {
        Team::create($request->input())->save();

        return redirect('team');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'NOT FOUND';
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
            return redirect('team');
        }

        $model = Team::find($id);

        return view("team.edit", [
            'selectSportList' => $this->selectSportList,
            'selectCountryList' => $this->selectCountryList,
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
    public function update(TeamRequest $request, $id)
    {
        $model = Team::find($id);
        $model->fill($request->input())->save();

        return redirect('team');
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
            return redirect('team');
        }
        $model = Team::find($id);

        return view("team.delete", ['model' => $model]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Team::destroy($id);

        return redirect('team');
    }
}
