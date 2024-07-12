<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Neighborhood;
use Illuminate\Http\Request;
use App\Models\Street;

class StreetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $street = City::with('neighborhood.street')->get();

        if ($street === null) {
            return response()->json(['message' => 'Nenhuma rua encontrado!'], 404);
        }

        return response()->json($street, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $neighborhood = Neighborhood::select('id', 'name')->get();

        return response()->json($neighborhood, 200);
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $street_id)
    {
        $street = Street::find($street_id);

        if ($street === null) {
            return response()->json(['message' => 'Rua não encontrada!'], 404);
        }

        return response()->json($street, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Street $street)
    {
        if ($street === null) {
            return response()->json(['message' => 'Rua não encontrada!'], 404);
        }
        $street->fill($request->all());
        $street->save();

        return $street;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $street_id)
    {
        $street = Street::find($street_id);

        if ($street === null) {
            return response()->json(['message' => 'Rua não encontrada!'], 404);
        }

        return response()->json($street, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $street_id)
    {
        $street = Street::whereId($street_id)->first();

        if ($street === null) {
            return response()->json(['message' => ' Rua não encontrada!'], 404);
        }

        Street::destroy($street_id);
        return response()->noContent();
    }
}
