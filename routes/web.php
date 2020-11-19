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

Route::resource('sample', 'SampleController');

Route::post('sample/update', 'SampleController@update')->name('sample.update');

Route::get('sample/destroy/{id}', 'SampleController@destroy');

Route::resource('user', 'UserController');

Route::post('user/update', 'UserController@update')->name('user.update');

Route::get('user/destroy/{id}', 'UserController@destroy');
