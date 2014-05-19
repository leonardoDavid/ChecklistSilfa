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
Route::post('login', 'AuthController@postLogin');

//Solo accesibles con login previo
Route::group(array('before' => 'auth'), function(){
	/**
	* Previas a un filtro de acceso por usuario
	*/
    Route::get('/', 'SiteController@getDashboard');
    Route::get('ingresar', 'SiteController@getSelectForm');
    Route::post('ingresar', 'SiteController@loadChecklist');

    /**
    * Rutas que son response de algun AJAX
    */
    Route::post('ingresar/tienda', 'SiteController@ajaxSucursales');
    Route::post('save-checklist', 'SiteController@saveChecklist');

    //Ruta para Cerrar la Sesion del user
    Route::get('logout', 'AuthController@logOut');

});
