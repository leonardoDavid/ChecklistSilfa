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
    Route::get('/', function(){
        return View::make('dashboard');
    });
    Route::get('logout', 'AuthController@logOut');
});
