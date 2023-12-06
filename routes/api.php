<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactInformationController;

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

Route::get('/list-contacts', [ContactInformationController::class, 'index']);
Route::post('/store-contacts', [ContactInformationController::class, 'store']);
Route::post('/update-contacts/{id}', [ContactInformationController::class, 'update']);
Route::delete('/delete-contacts/{id}', [ContactInformationController::class, 'destroy']);
