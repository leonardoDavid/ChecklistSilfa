<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request){
	//
});


App::after(function($request, $response){
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function(){
	if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function(){
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function(){
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/
Route::filter('csrf', function() {
   	$token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
   	if (Session::token() != $token) {
      	if(Request::ajax()){
      		return array(
      			'status' => false,
      			'motivo' => "Error del Token",
      			'codigo' => 504
      		);
      	}
      	else if(Request::path() == 'login'){
      		return Redirect::to('/login')->with('error_login', 'El token ha cambiado');
      	}
      	else{
      		return Redirect::to(Request::path())->with('error_url', 'El token ha cambiado');
      	}
   	}
});

/*
|--------------------------------------------------------------------------
| Filtro de Acceso a Rutas
|--------------------------------------------------------------------------
|
| Este filtro permite determinar si un usuario logeado tiene acceso parcial
| a la url que esta solicitando, se verifica si tiene permisos de acceso 
| a traves de los valores asignados de la tabla menu
|
*/
use ChecklistSilfa\Entities\MainMenu;
use ChecklistSilfa\Entities\Permisos;

Route::filter('access',function($route,$request,$url = '/'){
	if(Auth::guest()){
		return Redirect::to('/login');
	}
	else{
		$tmp = MainMenu::where('url','=',$url)->get()->take(1)->toArray();
		if($tmp[0]['id'] >= 0){
			$permiss = Permisos::where('permisos_id','=',$tmp[0]['id'])->where('user_id','=',Auth::user()->id)->get()->toArray();
			if(count($permiss) == 0){
				return Redirect::to('/perfil')->with('error_url', 'No tienes acceso a '.$tmp[0]['nombre']);
			}
		}
		else
			return Redirect::to('/perfil')->with('error_url', 'No tienes acceso a '.$tmp[0]['nombre']);
	}
});