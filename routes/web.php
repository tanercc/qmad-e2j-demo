<?php

use App\Http\Controllers\ChartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chart', [ChartController::class, 'index']);
