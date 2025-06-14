<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/customer', [CustomerController::class, 'get']);
Route::post('/customer', [CustomerController::class, 'create']);
Route::get('/customer/{id}', [CustomerController::class, 'find']);
Route::patch('/customer/{id}', [CustomerController::class, 'update']);
Route::delete('/customer/{id}', [CustomerController::class, 'delete']);

Route::post('/address', [AddressController::class, 'create']);
Route::patch('/address/{id}', [AddressController::class, 'update']);
Route::delete('/address/{id}', [AddressController::class, 'delete']);
