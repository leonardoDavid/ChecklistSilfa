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
	//Retorna un menu de estadisticas del sistema
    Route::get('/', 'SiteController@getDashboard');
    //Ruta para Cerrar la Sesion del user
    Route::get('logout', 'AuthController@logOut');

    //Rutas para un checklist
    Route::get('ingresar', 'SiteController@getSelectForm');
    Route::post('ingresar', 'SiteController@loadChecklist');
    Route::post('ingresar/tienda', 'SiteController@ajaxSucursales');

});
