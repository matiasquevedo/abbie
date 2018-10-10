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


Route::group(['prefix'=>'admin','middleware'=>['auth','admin']], function(){

	Route::get('/',function(){
		return view('admin.index');
	})->name('admin.inicio');

	Route::resource('users','UsersController');
	Route::get('users/{id}/destroy',[
		'uses'=>'UsersController@destroy',
		'as'=>'users.destroy'
	]);

	Route::get('users/conectados',[
		'uses'=>'UsersController@kk',
		'as'=>'users.conectados'
	]);

	Route::resource('categories','CategoriesController');
	Route::get('categories/{id}/destroy',[
		'uses'=>'CategoriesController@destroy',
		'as'=>'categories.destroy'
	]);
	//Articulos
	Route::resource('actividades','ActividadesController');
	Route::get('actividades/{id}/destroy',[
		'uses'=>'ActividadesController@destroy',
		'as'=>'actividades.destroy'
	]);
	Route::get('actividades/destroy/varios',[
		'uses'=>'ActividadesController@eliminarVarios',
		'as'=>'actividades.varios'
	]);
	Route::get('actividades/{id}/post',[
		'uses'=>'ActividadesController@post',
		'as'=>'actividades.post'
	]);
	Route::get('actividades/{id}/undpost',[
		'uses'=>'ActividadesController@undpost',
		'as'=>'actividades.undpost'
	]);

	Route::post('actividades/image/update',[ 
		'uses'=>'ActividadesController@ImagesUpdate',
		'as'=>'images.update'
	]);
	

	

	Route::get('eventos',[
		'uses'=>'EventosController@index',
		'as'=>'admin.eventos.index'
	]);

	Route::get('eventos/create',[
		'uses'=>'EventosController@AdminCreate',
		'as'=>'admin.eventos.create'
	]);

	Route::post('eventos',[
		'uses'=>'EventosController@AdminStore',
		'as'=>'admin.eventos.store'
	]);


	
	
	Route::get('eventos/{id}/destroy',[
		'uses'=>'EventosController@AdminDestroy',
		'as'=>'admin.eventos.destroy'
	]);

	Route::get('eventos/{id}/show',[
		'uses'=>'EventosController@AdminShow',
		'as'=>'admin.eventos.show'
	]);

	Route::get('eventos/{id}/edit',[
		'uses'=>'EventosController@AdminEdit',
		'as'=>'admin.eventos.edit'
	]);

	Route::put('eventos/{id}/update',[
		'uses'=>'EventosController@AdminUpdate',
		'as'=>'admin.eventos.update'
	]);

	Route::get('evento/{id}/post',[
		'uses'=>'EventosController@post',
		'as'=>'evento.post'
	]);
	Route::get('evento/{id}/undpost',[
		'uses'=>'EventosController@undpost',
		'as'=>'evento.undpost'
	]);

	Route::get('user/{id}/articles',[
		'uses'=>'UsersController@ArticlesForUser',
		'as'=>'user.articles'
	]);

	Route::resource('paquetes','PaqueteController');
	Route::get('paquetes/{id}/destroy',[
		'uses'=>'PaqueteController@destroy',
		'as'=>'paquetes.destroy'
	]);

	Route::get('paquetes/{id}/post',[
		'uses'=>'PaqueteController@post',
		'as'=>'paquetes.post'
	]);
	Route::get('paquetes/{id}/undpost',[
		'uses'=>'PaqueteController@undpost',
		'as'=>'paquetes.undpost'
	]);

	Route::resource('informacion','InformacionController');
	Route::get('informacion/{id}/destroy',[
		'uses'=>'InformacionController@destroy',
		'as'=>'informacion.destroy'
	]);
	Route::get('informacion/{id}/post',[
		'uses'=>'InformacionController@post',
		'as'=>'informacion.post'
	]);
	Route::get('informacion/{id}/undpost',[
		'uses'=>'InformacionController@undpost',
		'as'=>'informacion.undpost'
	]);

	Route::resource('proveedores','ProveedoresController');
	Route::get('proveedores/{id}/destroy',[
		'uses'=>'ProveedoresController@destroy',
		'as'=>'proveedores.destroy'
	]);

	Route::resource('proyectos','ProyectosController');
	Route::get('proyectos/{id}/destroy',[
		'uses'=>'ProyectosController@destroy',
		'as'=>'proyectos.destroy'
	]);

	Route::resource('tareas','TareasController');
	Route::get('tareas/{id}/destroy',[
		'uses'=>'TareasController@destroy',
		'as'=>'tareas.destroy'
	]);
	Route::get('tarea/{proyecto}/create',[
		'uses'=>'TareasController@create',
		'as'=>'tarea.create'
	]);

	Route::resource('horas','HorasController');
	Route::get('horas/{id}/destroy',[
		'uses'=>'HorasController@destroy',
		'as'=>'horas.destroy'
	]);

	Route::get('hora/{proyecto}/create',[
		'uses'=>'HorasController@create',
		'as'=>'hora.create'
	]);

	Route::resource('albumes','AlbumesController');
	Route::get('albumnes/{id}/destroy',[
		'uses'=>'AlbumesController@destroy',
		'as'=>'albumes.destroy'
	]);

	Route::resource('fotos','FotosController');
	Route::get('fotos/{id}/destroy',[
		'uses'=>'FotosController@destroy',
		'as'=>'fotos.destroy'
	]);



	

});

Route::group(['prefix'=>'editor','middleware'=>['auth','editor']], function(){

	Route::get('/',function(){
		return view('editor.index');
	})->name('editor.inicio');
/*
	Route::resource('users','UsersController');
	Route::get('users/{id}/destroy',[
		'uses'=>'UsersController@destroy',
		'as'=>'users.destroy'
	]);

	Route::resource('categories','CategoriesController');
	Route::get('categories/{id}/destroy',[
		'uses'=>'CategoriesController@destroy',
		'as'=>'categories.destroy'
	]);

	//tags
	Route::resource('tags','TagsController');
	Route::get('tags/{id}/destroy',[
		'uses'=>'TagsController@destroy',
		'as'=>'tags.destroy'
	]);
*/
	//Articulos

	Route::get('actividades',[
		'uses'=>'ActividadesController@EditorIndex',
		'as'=>'editor.actividades.index'
	]);

	Route::post('actividades',[
		'uses'=>'ActividadesController@EditorStore',
		'as'=>'editor.actividades.store'
	]);

	Route::get('actividades/create',[
		'uses'=>'ActividadesController@EditorArticleCreate',
		'as'=>'editor.actividades.create'
	]);
	Route::get('actividades/{id}/show',[
		'uses'=>'ActividadesController@EditorArticleShow',
		'as'=>'editor.actividades.show'
	]);
	Route::get('actividades/{id}/edit',[
		'uses'=>'ActividadesController@EditorArticleEdit',
		'as'=>'editor.actividades.edit'
	]);
	Route::put('actividades/{id}/update',[
		'uses'=>'ActividadesController@EditorArticleUpdate',
		'as'=>'editor.actividades.update'
	]);
	Route::get('actividades/{id}/destroy',[
		'uses'=>'ActividadesController@EditorArticleDestroy',
		'as'=>'editor.actividades.destroy'
	]);

	Route::get('documentacion',[
		'uses'=>'ActividadesController@EditorDocumentacion',
		'as'=>'editor.documentacion'
	]);


	
	/*
	Route::get('articles/{id}/post',[
		'uses'=>'ArticlesController@post',
		'as'=>'articles.post'
	]);
	Route::get('articles/{id}/undpost',[
		'uses'=>'ArticlesController@undpost',
		'as'=>'articles.undpost'
	]);*/


});



Route::group(['prefix'=>'nuevo','middleware'=>['auth','nova']], function(){

	Route::get('/',function(){
		return view('nova.index');
	})->name('nuevo.inicio');
		

});

Route::group(['prefix'=>'ventas','middleware'=>['auth','ventas']], function(){

	Route::get('/',function(){
		return view('vendedor.index');
	})->name('vendedor.inicio');

	

});


Auth::routes();
#
Route::get('/', 'HomeController@inicio');
Route::get('/inicio', [
	'uses'=>'PrincipalController@index',
	'as'=>'principal'
]);

Route::get('actividad/{actividad}',[
	'uses'=>'PrincipalController@actividadPublic',
	'as'=>'actividad.public'
]);


Route::get('evento/{id}/',[
		'uses'=>'EventosController@PublicShow',
		'as'=>'evento.public'
]);

Route::get('pagar',[
	'uses'=>'PaymentController@payWithpaypal',
	'as'=>'pagar.paypal'
]);

Route::get('pagar/status',[
	'uses'=>'PaymentController@paymentStatus',
	'as'=>'pagar.status'
]);

//////////////Carrito
Route::get('cart/show',[
	'uses'=>'CartController@show',
	'as'=>'cart.show'
]);

Route::get('cart/add/{actividad}',[
	'uses'=>'CartController@add',
	'as'=>'cart.add'
]);

Route::post('cart',[
	'uses'=>'CartController@store',
	'as'=>'add.cart'
]);

Route::get('cart/destroy/{actividad}',[
	'uses'=>'CartController@destroy',
	'as'=>'cart.destroy'
]);

Route::get('cart/trash',[
	'uses'=>'CartController@trash',
	'as'=>'cart.trash'
]);

////////////////////////////////////////////
////////////////////////////////////////////
/////////////////PAGOS//////////////////////
////////////////////////////////////////////
////////////////////////////////////////////

Route::get('pago/',[
	'uses'=>'TodoPagoController@generarPago',
	'as'=>'pago'
]);

Route::post('pagar/',[
	'uses'=>'TodoPagoController@pagar',
	'as'=>'efectuar.pago'
]);


