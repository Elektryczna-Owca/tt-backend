<?php

use App\Http\Controllers\Topic\GetTopicsController;
use App\Http\Controllers\Topic\ShowTopicController;
use App\Http\Controllers\Topic\StoreTopicController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/api')->group(function () {
    Route::get('/topics/{topic}', ShowTopicController::class);
    Route::post('/topics', StoreTopicController::class);
    Route::get('/topics', GetTopicsController::class);
});
