<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\UserController;
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


// adm 001
Route::resource('/dashboard/users', UserController::class)
->middleware('role');

// adm 002
Route::get('/dashboard/periods','App\Http\Controllers\PeriodController@show')
->middleware('role');
Route::post('/dashboard/enable_period', 'App\Http\Controllers\PeriodController@store')->name('dashboard_store')
->middleware('role');
Route::post('/dashboard/edit', 'App\Http\Controllers\PeriodController@update')->name('dashboard_edit')
->middleware('role');


// eaa 001
Route::get('dashboard/import_data', 'App\Http\Controllers\ImportDataController@indexUsers')
->middleware('role');
Route::post('dashboard/import_data/import', 'App\Http\Controllers\ImportDataController@import')
->middleware('role');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
