<?php

use App\Http\Controllers\Topic\StoreTopicController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/api')->group(function () {
    Route::post('/topics', StoreTopicController::class);
});
