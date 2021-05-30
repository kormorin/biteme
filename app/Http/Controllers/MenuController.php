<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function daySelection()
    {
    	return view('menu_day_selection');	
    }

    public function menuCreation($day)
    {
    	$menu = Menu::where('served_at', $day)->first();

    	if(!$menu)
    	{
    		$menu = Menu::factory()
    			->has(Dish::factory()->appetizer()->count(1), 'dishes')
    			->has(Dish::factory()->soup()->count(2), 'dishes')
    			->has(Dish::factory()->main()->count(3), 'dishes')
    			->create(['served_at' => $day]);
    	}

    	return view('menu_creation', compact('day', 'menu'));
    }
}
