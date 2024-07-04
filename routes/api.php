<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\NeighborhoodController;
use App\Http\Controllers\StreetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/city/{city_id}/neighborhood', [CityController::class, 'neighborhood']);
Route::get('/city/{city_id}/neighborhood/{neighborhood_id}/street', [CityController::class, 'street']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/teste', function () {
        return 'Teste';
    });
    
    Route::resource('/city', CityController::class);
    Route::resource('/neighborhood', NeighborhoodController::class);
    Route::resource('/street', StreetController::class);


    // Route::resource('/city/{city_id}/neighborhood', NeighborhoodController::class);
    // Route::resource('/city/{city_id}/neighborhood/{neighborhood_id}/street', StreetController::class);

});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get( '/unauthenticated', [AuthController::class, 'unauthenticated'])->name('login');

/* 
GET INDEX '/city' -> Retornar todas as cidades e seus dados
POST STORE '/city' -> Criar uma cidade com seus dados
GET EDIT '/city/{city_id}' -> Retorna os dados desta cidade, para editar.
PUT|PATCH UPDATE '/city/{city_id}' -> Atualiza os dados desta cidade.

GET SHOW(city) or INDEX(neighborhood) '/city/{city_id}' or '/city/{city_id}/neighborhood' -> Retorna todos os bairros desta cidade

GET INDEX '/neighborhood' -> Retorna todos os bairros

GET INDEX '/stret' -> Retorna todos as ruas

*/