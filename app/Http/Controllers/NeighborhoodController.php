<?php

namespace App\Http\Controllers;

use App\Http\Requests\NeighborhoodRequest;
use App\Models\City;
use App\Models\Neighborhood;
use Illuminate\Http\Request;

class NeighborhoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $neighborhood = City::with('neighborhood')->get();

        if($neighborhood === null){
            return response()->json(['message'=> 'Nenhum bairro encontrado!'], 404);
        }

        return response()->json($neighborhood, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::select('id', 'name')->get();

        return response()->json($cities,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $neighborhood = Neighborhood::create($request->all());
        
        return response()->json($neighborhood, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $neighborhood_id)
    {
        $neighborhood = Neighborhood::with('street')->find($neighborhood_id);

        if($neighborhood === null){
            return response()->json(['message'=> 'Bairro não encontrado!'], 404);
        }

        return response()->json($neighborhood, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $neighborhood_id)
    {
        $neighborhood = Neighborhood::find($neighborhood_id);

        if($neighborhood === null){
            return response()->json(['message'=> 'Bairro não encontrado!'], 404);
        }

        $city_id = $neighborhood->city_id;

        $city = City::find($city_id);

        $neighborhoodArray = $neighborhood->toArray();
        $neighborhoodArray['cityName'] = $city->name;

        return response()->json($neighborhoodArray, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NeighborhoodRequest $request, Neighborhood $neighborhood)
    {
        if($neighborhood === null){
            return response()->json(['message'=> 'Bairro não encontrado!'], 404);
        }
        $neighborhood->fill($request->all());
        $neighborhood->save();

        return $neighborhood;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $neighborhood_id)
    {
        $neighborhood = Neighborhood::whereId($neighborhood_id)->first();

        if($neighborhood === null){
            return response()->json(['message'=> ' Bairro não encontrado!'], 404);
        }
        
        Neighborhood::destroy($neighborhood_id);
        return response()->noContent();
    }
}
