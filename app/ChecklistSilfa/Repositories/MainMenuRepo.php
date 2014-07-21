<?php namespace ChecklistSilfa\Repositories;

use ChecklistSilfa\Entities\MainMenu;

class MainMenuRepo{
	
	public static function users(){
		return MainMenu::users();
	}

}