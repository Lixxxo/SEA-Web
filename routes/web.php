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
->middleware(['auth','Administrador']);
Route::post('/dashboard/users/reset_password', 'App\Http\Controllers\UserController@reset_password')
->name('reset_password')
->middleware(['auth', 'Administrador']);

// adm 002
Route::get('/dashboard/periods','App\Http\Controllers\PeriodController@show')
->middleware(['auth', 'Encargado Docente']);
Route::post('/dashboard/enable_period', 'App\Http\Controllers\PeriodController@store')
->name('dashboard_store')
->middleware(['auth', 'Encargado Docente']);
Route::post('/dashboard/edit', 'App\Http\Controllers\PeriodController@update')
->name('dashboard_edit')
->middleware(['auth', 'Encargado Docente']);


// adm 003
Route::get('/password_change', function(){
    return view('User_Stories/adm003/password_change', 
    ['message' => '']);
})
->name('password_change')
->middleware('auth');
Route::post('/password_confirm', 'App\Http\Controllers\UserController@change_password')
->name('password_confirm')
->middleware('auth');
// adm 003
Route::get('/password_request', 'App\Http\Controllers\UserController@password_request')
->name('password_request');
Route::get('/disabled', function (){
    return view('User_stories.adm003.disabled');
})
->name('disabled');


// eaa 001
Route::get('dashboard/import_data', 'App\Http\Controllers\ImportDataController@indexUsers')
->middleware(['auth', 'Encargado Docente']);
Route::post('dashboard/import_data/import', 'App\Http\Controllers\ImportDataController@import')
->middleware(['auth', 'Encargado Docente']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
