<?php

use ChecklistSilfa\Entities\MainMenu;

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
            'nombre' => "Lista de Reportes",
            'url' => "/lista-reportes",
            'icon' => "icon-book",
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