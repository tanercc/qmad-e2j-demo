<?php

use App\Http\Controllers\ChartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //return view('welcome');
    return view('chart');
});

Route::get('/chart', fn() => view('chart'));
Route::get('/grid', fn() => view('grid'));
Route::get('/grid-vue', fn() => view('grid-vue'));
Route::get('/chart-vue', fn() => view('chart-vue'));
