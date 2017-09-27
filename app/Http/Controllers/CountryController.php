<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CountryRequest;
use App\Country;
use App\DataTables\CountryDataTable;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountryDataTable $dataTable, Country $model)
    {
        $dataTable->query($model);

        return $dataTable->render('country.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!$request->ajax()){
            return redirect('country');
        }

        return view("country.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        Country::create($request->input())->save();

        return redirect('country');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         /*$arrayInfo = json_decode(file_get_contents(asset('json_country.txt')), true);
        foreach ($arrayInfo as $key => $data) {
            $model = new Country();
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
            return redirect('country');
        }
        $model = Country::find($id);

        return view("country.edit", ['model' => $model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, $id)
    {
        $model = Country::find($id);
        $model->fill($request->input())->save();

        return redirect('country');
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
            return redirect('country');
        }
        $model = Country::find($id);

        return view("country.delete", ['model' => $model]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Country::destroy($id);

        return redirect('country');
    }
}
