<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\UserController;

use App\Http\Controllers\CourseController;

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
Route::get('/dashboard/periods','App\Http\Controllers\PeriodController@index')
->middleware(['auth', 'Encargado Docente']);
Route::post('/periods/enable_period', 'App\Http\Controllers\PeriodController@store')
->name('periods_store')
->middleware(['auth', 'Encargado Docente']);
Route::post('/dashboard/periods/edit', 'App\Http\Controllers\PeriodController@update')
->name('periods_edit')
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


// EAA-001
Route::get('dashboard/import_data', 'App\Http\Controllers\ImportDataController@indexStudents')
->middleware(['auth', 'Encargado Docente']);
Route::post('dashboard/import_data/importStudents', 'App\Http\Controllers\ImportDataController@importStudents')
->middleware(['auth', 'Encargado Docente']);

// EAA-002
Route::get('dashboard/import_data_courses', 'App\Http\Controllers\ImportDataController@indexCourses')
->middleware(['auth', 'Encargado Docente']);
Route::post('dashboard/import_data_courses/importCourses', 'App\Http\Controllers\ImportDataController@importCourses')
->middleware(['auth', 'Encargado Docente']);

// EAA-004
Route::get('dashboard/import_data_assistants', 'App\Http\Controllers\ImportDataController@indexAssistants')
->middleware(['auth', 'Encargado Docente']);
Route::post('dashboard/import_data_assistants/importAssistants', 'App\Http\Controllers\ImportDataController@importAssistants')
->middleware(['auth', 'Encargado Docente']);

//enc 001
Route::get('/dashboard/surveys', 'App\Http\Controllers\SurveyController@index')
->middleware(['auth', 'Encargado Docente']);
Route::post('/dashboard/surveys/create', 'App\Http\Controllers\SurveyController@createSurvey')
->middleware(['auth', 'Encargado Docente'])
->name("createSurvey");
Route::get('/dashboard/surveys/{id}', 'App\Http\Controllers\SurveyController@editSurvey')
->where('id', '(.*)')
->middleware(['auth', 'Encargado Docente'])
->name("editSurvey");
Route::post('/dashboard/surveys/updateSurvey', 'App\Http\Controllers\SurveyController@updateSurvey')
->middleware(['auth', 'Encargado Docente'])
->name("updateSurvey");
Route::post('/dashboard/surveys/createQuestion', 'App\Http\Controllers\SurveyController@createQuestion')
->middleware(['auth', 'Encargado Docente'])
->name("createQuestion");
Route::post('/dashboard/surveys/updateQuestion', 'App\Http\Controllers\SurveyController@updateQuestion')
->middleware(['auth', 'Encargado Docente'])
->name("updateQuestion");
Route::post('/dashboard/surveys/deleteQuestion', 'App\Http\Controllers\SurveyController@deleteQuestion')
->middleware(['auth', 'Encargado Docente'])
->name("deleteQuestion");

// eaa 003
Route::resource('/dashboard/courses', CourseController::class)
->middleware(['auth','Encargado Docente']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
