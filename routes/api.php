<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\VideoPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::apiResource('news', NewsController::class);
Route::apiResource('videos', VideoPostController::class);
