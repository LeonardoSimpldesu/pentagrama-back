<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Street;

class StreetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $street = Street::all();

        if($street === null){
            return response()->json(['message'=> 'Nenhuma rua encontrado!'], 404);
        }

        return response()->json($street, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $street = Street::create($request->all());
        
        return response()->json($street, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Street $street)
    {
        if($street === null){
            return response()->json(['message'=> 'Rua não encontrada!'], 404);
        }
        $street->fill($request->all());
        $street->save();

        return $street;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $street_id)
    {
        // $street_id = Street::whereId($street_id)->first();

        // if($street_id === null){
        //     return response()->json(['message'=> ' Bairro não encontrado!'], 404);
        // }
        
        Street::destroy($street_id);
        return response()->noContent();
    }
}
