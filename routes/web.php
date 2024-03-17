<?php

use App\Http\Controllers\ChartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chart', fn() => view('chart'));
Route::get('/grid', fn() => view('grid'));
