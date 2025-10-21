<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProdutoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('login', [AuthController::class, 'login']);

Route::middleware('accept.json', 'auth:api')->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);

    // produtos
    Route::get('produtos', [ProdutoController::class, 'getAll']);
    Route::post('produtos', [ProdutoController::class, 'insert']);
    Route::get('produtos/{id}', [ProdutoController::class, 'get']);
    Route::put('produtos/{id}', [ProdutoController::class, 'update']);
    Route::delete('produtos/{id}', [ProdutoController::class, 'destroy']);

});

