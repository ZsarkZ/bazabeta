<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SportRequest;
use App\Sport;
use App\DataTables\SportDataTable;


class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SportDataTable $dataTable, Sport $model)
    {
        $dataTable->query($model);
        return $dataTable->render('sport.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!$request->ajax()){
            return redirect('sport');
        }

        return view("sport.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SportRequest $request)
    {
        Sport::create($request->input())->save();

        return redirect('sport');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            return redirect('sport');
        }
        $model = Sport::find($id);

        return view("sport.edit", ['model' => $model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SportRequest $request, $id)
    {
        $model = Sport::find($id);
        $model->fill($request->input())->save();

        return redirect('sport');
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
            return redirect('sport');
        }
        $model = Sport::find($id);

        return view("sport.delete", ['model' => $model]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sport::destroy($id);

        return redirect('sport');
    }
}
