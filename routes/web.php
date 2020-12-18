<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/estudiante', 'EstudianteController@index');

Route::get('/get-all-estudiante', 'EstudianteController@getAllEstudiante');

Route::get('/import-form', 'EstudianteController@importForm');

Route::post('/import', 'EstudianteController@import')->name('import');

Route::get('/import-form-asignaturas', 'AsignaturasController@importFormAsignaturas');

Route::post('/importAsignaturas', 'AsignaturasController@importAsignaturas')->name('importAsignaturas');

Route::resource('sample', 'SampleController');

Route::resource('User', 'SampleControllerUser');

Route::post('sample/update', 'SampleController@update')->name('sample.update');

Route::get('sample/destroy/{id}', 'SampleController@destroy');

Route::resource('user', 'UserController');

Route::post('user/update', 'UserController@update')->name('user.update');

Route::get('user/destroy/{id}', 'UserController@destroy');

Route::get('situation-report', 'EstudianteController@index');

Route::post('/report', 'UserController@report')->name('report');

Route::get('attention-register', 'EstudianteController@attention');

Route::post('/registerAttention', 'AttentionController@register')->name('register');

Route::get('autocomplete', 'EstudianteController@autocomplete')->name('autocomplete');

Route::post('/situation-report/fetch', 'EstudianteController@fetch')->name('autocomplete.fetch');