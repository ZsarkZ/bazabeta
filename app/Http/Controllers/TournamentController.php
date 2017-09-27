<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TournamentRequest;
use App\DataTables\TournamentDataTable;
use App\Sport;
use App\Tournament;

class TournamentController extends Controller
{
    public $selectSportList;

    public function __construct()
    {
        $this->selectSportList = Sport::pluck('name', 'id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TournamentDataTable $dataTable, Tournament $model)
    {
        $dataTable->query($model);

        return $dataTable->render('tournament.index');
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!$request->ajax()){
            return redirect('tournament');
        }
        

        return view("tournament.create", ['selectSportList' => $this->selectSportList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TournamentRequest $request)
    {
        Tournament::create($request->input())->save();

        return redirect('tournament');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*$arrayInfo = json_decode(file_get_contents(asset('json_tornament.txt')), true);
        foreach ($arrayInfo as $key => $data) {
            $model = new Tournament();
            $model->sport_id = 2;
            $model->name = $data['name'];
            $model->keywords = $data['keywords'];
            $model->save();
        }*/
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
            return redirect('tournament');
        }

        $model = Tournament::find($id);

        return view("tournament.edit", ['selectSportList' => $this->selectSportList, 'model' => $model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TournamentRequest $request, $id)
    {
        $model = Tournament::find($id);
        $model->fill($request->input())->save();

        return redirect('tournament');
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
            return redirect('tournament');
        }
        $model = Tournament::find($id);

        return view("tournament.delete", ['model' => $model]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tournament::destroy($id);

        return redirect('tournament');
    }
}
