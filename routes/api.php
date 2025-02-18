<?php

use App\Http\Controllers\EngineController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/tests', [TestController::class, 'list'])->name('test.list');

Route::resource('engine', EngineController::class)->except(['create', 'edit']);
Route::get('engine/filter/{filter}', [EngineController::class, 'filter'])->name('engine.filter');
