<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\Neighborhood;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return City::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        $city = City::create($request->all());
        
        return response()->json($city, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $city_id)
    {
        $city = City::find($city_id);

        if($city === null){
            return response()->json(['message'=> 'Cidade não encontrada!'], 404);
        }

        return response()->json($city, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $city_id)
    {
        $city = City::find($city_id);

        if($city === null){
            return response()->json(['message'=> 'Cidade não encontrada!'], 404);
        }

        return response()->json($city, 200);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(City $city, CityRequest $request )
    {
        
        if($city === null){
            return response()->json(['message'=> 'Cidade não encontrada!'], 404);
        }
        $city->fill($request->all());
        $city->save();

        return $city;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $city_id)
    {
        $city = City::whereId($city_id)->first();

        if($city === null){
            return response()->json(['message'=> 'Cidade não encontrada!'], 404);
        }
        
        City::destroy($city_id);
        return response()->noContent();
    }
}
