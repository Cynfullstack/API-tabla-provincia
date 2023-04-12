<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\PersonaController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('insertProvincias',[ProvinciaController::class, 'store']);
Route::post('insertPersona',[PersonaController::class,'store']);
Route::get('personas',[PersonaController::class,'index']);
Route::get('persona/{id}',[PersonaController::class,'show']);
Route::put('persona/{id}',[PersonaController::class,'update']);

Route::delete('personas/{id}',[PersonaController::class,'destroy']);