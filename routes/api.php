<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\VideoPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('news', NewsController::class);
Route::apiResource('videos', VideoPostController::class);

Route::post('comments', [CommentController::class, 'store']);
Route::put('comments/{comment}', [CommentController::class, 'update']);
Route::delete('comments/{comment}', [CommentController::class, 'destroy']);
