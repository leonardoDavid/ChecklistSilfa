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

Route::group(array('before' => 'auth'), function(){
    Route::get('/', 'SiteController@getDashboard');
    Route::get('logout', 'AuthController@logOut');
    
    Route::get('ingresar', 'ChecklistController@getSelectForm');
    Route::post('ingresar', 'ChecklistController@loadChecklist');
    Route::post('ingresar/tienda', 'ChecklistController@getSelectSucusales');
    Route::post('ingresar/save-checklist', array('before' => 'csrf', 'uses' => 'ChecklistController@saveChecklist') );

    Route::any('reportes', 'ReportesController@getSelectReport');
    Route::get('reportes/{id}', 'ReportesController@getReport');
    Route::post('reportes/exportar/{action}/{id?}', 'ReportesController@exportReport');

    Route::get('admin', 'AdminController@getDashboard');
    Route::post('admin/adduser', array('before' => 'csrf','uses' => 'AdminController@addUser'));

    Route::get('lista-reportes','ReportesController@showListReport');

    Route::post('send-bug','SiteController@notifyBug');

    Route::get('perfil','ProfileController@getProfile');
    Route::post('perfil',array('before' => 'csrf' ,'uses'=> 'ProfileController@saveProfile'));

    Route::get('assets/{resource}/{typeOrName?}/{name?}','ResourceController@getResource');

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
Route::when('reportes','access:/reportes');
Route::when('reportes/*','access:/reportes');
Route::when('admin','access:/admin');
Route::when('admin/*','access:/admin');
Route::when('lista-reportes','access:/lista-reportes');
Route::when('lista-reportes/*','access:/lista-reportes');
