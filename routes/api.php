<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['prefix'=>'/v1','middleware' => 'cors'], function(){

	Route::get('/actividades',[
		'uses'=>'ActividadesController@ApiIndex'
	]);

	Route::get('/actividad/{id}/show',[
		'as'=>'actividad.show',
		'uses'=>'ActividadesController@ApiShow'
	]);

	Route::get('/categories',[
		'as'=>'categories',
		'uses'=>'ActividadesController@ApiCategories'
	]);

	Route::get('/categories/{id}/actividades',[
		'as'=>'actividades.category',
		'uses'=>'ActividadesController@ApiActividadesByCategory'
	]);

	Route::get('/eventos',[
		'uses'=>'EventosController@ApiIndex'
	]);

	Route::get('/evento/{id}/show',[
		'as'=>'eventos.show',
		'uses'=>'EventosController@ApiShow'
	]);

	Route::get('/informacion',[
		'uses'=>'InformacionController@ApiIndex'
	]);

	Route::get('/informacion/{id}/show',[
		'as'=>'eventos.show',
		'uses'=>'InformacionController@ApiShow'
	]);

	Route::get('/paquetes',[
		'uses'=>'PaqueteController@ApiIndex'
	]);

	Route::get('/paquete/{id}/show',[
		'as'=>'paquetes.show',
		'uses'=>'PaqueteController@ApiShow'
	]);




});
