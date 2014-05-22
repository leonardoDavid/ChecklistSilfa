<?php

/**
* Agregamos los menus que tambien sirven como acciones/permisos
*/
class MenuTableSeeder extends Seeder{
    public function run(){
        MainMenu::create(array(
            'nombre' => "Dashboard",
            'url' => "/",
            'icon' => "icon-home",
            'estado' => 1
        ));
        MainMenu::create(array(
            'nombre' => "Ingresar Checklist",
            'url' => "/ingresar",
            'icon' => "icon-check",
			'estado' => 1
        ));
        MainMenu::create(array(
            'nombre' => "Reportes",
            'url' => "/reportes",
            'icon' => "icon-excel",
			'estado' => 1
        ));
        MainMenu::create(array(
            'nombre' => "Administración",
            'url' => "/admin",
            'icon' => "icon-gear",
			'estado' => 1
        ));
    }
}