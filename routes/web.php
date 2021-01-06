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

Route::get('welcome',function () {
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

Route::get('situation-report', 'SituationController@index');

Route::post('/report', 'SituationController@report')->name('report');

Route::get('attention-register', 'AttentionController@index');

Route::post('/registerAttention', 'AttentionController@registerAttention')->name('registerAttention');

Route::get('autocomplete', 'EstudianteController@autocomplete')->name('autocomplete');

Route::post('/situation-report/fetch', 'EstudianteController@fetch')->name('autocomplete.fetch');

Route::resource('/notification', 'NotificationController');

Route::resource('/situation', 'SituationController');

Route::resource('/atention', 'AttentionController');

Route::post('/notification/cantidad', 'NotificationController@cantidad')->name('notificacion.cantidad');
Route::post('/notification/marcarLeidos', 'NotificationController@marcarLeidos')->name('notificacion.marcarLeidos');

Route::get('/ficha-estudiantes', 'EstudianteController@fichaEstudiantes');
Route::post('/generar-ficha', 'EstudianteController@generarFicha')->name('generarFicha');

Route::get('/consulta-profesor', 'UserController@consultarProfesor');
Route::post('/consulta', 'UserController@consulta')->name('consulta');
Route::get('autocomplete1', 'UserController@autocomplete1')->name('autocomplete1');
Route::post('/consulta-profesor/fetch', 'UserController@fetch')->name('autocomplete1.fetch');

Route::get('/consulta-asignatura', 'AsignaturasController@consultarAsignatura');
Route::post('/consultaAsignatura', 'AsignaturasController@consultaAsignatura')->name('consultaAsignatura');
Route::get('autocomplete2', 'AsignaturasController@autocomplete2')->name('autocomplete2');
Route::post('/consulta-asignatura/fetch', 'AsignaturasController@fetch')->name('autocomplete2.fetch');