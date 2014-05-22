<?php

/*
|--------------------------------------------------------------------------
| Rutas de Generale de Sitio
|--------------------------------------------------------------------------
|
| Rutas generales, todas con filtro de autenticacion, y otras generales 
| que piden filtros de autorizacion de contenido
|
*/
Route::get('login', 'AuthController@showLogin');
Route::post('login', array('before' => 'csrf', 'uses' => 'AuthController@postLogin'));

//Solo accesibles con login previo
Route::group(array('before' => 'auth'), function(){
	/**
	* Previas a un filtro de acceso por usuario
	*/
    Route::get('/', 'SiteController@getDashboard');
    Route::get('ingresar', 'SiteController@getSelectForm');
    Route::post('ingresar', 'SiteController@loadChecklist');

    /**
    * Rutas que son response de algun AJAX , tambien deben pasar por el filtro de acceso de usuario
    */
    Route::post('ingresar/tienda', 'SiteController@ajaxSucursales');
    Route::post('ingresar/save-checklist', array('before' => 'csrf', 'uses' => 'SiteController@saveChecklist') );
    Route::post('send-bug','SiteController@notifyBug');

    /**
    * Rutas sin filtro de usuario, solo login
    */    
    Route::get('perfil','ProfileController@getProfile');

    //Ruta para Cerrar la Sesion del user
    Route::get('logout', 'AuthController@logOut');

});

/*
|--------------------------------------------------------------------------
| Rutas con filtros de Acceso
|--------------------------------------------------------------------------
|
| Estas rutas se verifica primero que el usuario quien se logeo tenga
| prmisos para poder ver la ruta que esta solictando
|
*/
Route::when('/','access');
Route::when('ingresar','access:/ingresar');
Route::when('ingresar/*','access:/ingresar');
