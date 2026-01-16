<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\VideoPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('news', NewsController::class)->only('index','store','show');
    Route::apiResource('videos', VideoPostController::class)->only('index','store','show');
    Route::apiResource('comments', CommentController::class)->only('index','store','show','destroy');
});
