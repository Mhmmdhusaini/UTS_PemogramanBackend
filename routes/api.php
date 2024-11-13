<?php

use App\Http\Controllers\DigitalMediaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

 {
Route::get('/news', [DigitalMediaController::class, 'index']);
Route::post('/news', [DigitalMediaController::class, 'store']);
Route::put('/news/{id}', [DigitalMediaController::class, 'update']);
Route::delete('/news/{id}', [DigitalMediaController::class, 'destroy']);
Route::get('/news/{id}', [DigitalMediaController::class, 'show']);
Route::get('/news/search', [DigitalMediaController::class, 'search']);
Route::get('/news/category/sport', [DigitalMediaController::class, 'getSportResource']);

}
    

