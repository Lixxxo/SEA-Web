<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard/periods','App\Http\Controllers\PeriodController@show');
Route::post('/dashboard/enable_period', 'App\Http\Controllers\PeriodController@store');
Route::post('/dashboard/edit', 'App\Http\Controllers\PeriodController@edit');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
