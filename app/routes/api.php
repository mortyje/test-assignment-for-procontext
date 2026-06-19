<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

Route::post('/links', [LinkController::class, 'store']);
Route::get('/links/{code}/stats', [LinkController::class, 'stats']);
