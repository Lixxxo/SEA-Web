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
Route::resource('/dashboard/users', UserController::class);

// eaa 001
Route::get('/import_data', 'App\Http\Controllers\ImportDataController@indexUsers');
Route::post('/import_data/import', 'App\Http\Controllers\ImportDataController@import');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
