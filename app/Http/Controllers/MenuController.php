<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Menu;
use App\Models\OrderItem;
use Carbon\Carbon;
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

        $day = Carbon::parse($day)->format('Y. m. d.');

    	return view('menu_creation', compact('day', 'menu'));
    }

    public function destroy(Request $request)
    {
        $menu = Menu::find($request->menu_id);

        $order_ids = $menu->orders->map->id->toArray();
        OrderItem::whereIn('order_id', $order_ids)->delete();
        
        foreach($menu->dishes as $dish)
        {
            $dish->tags()->sync([]);
        }

        $menu->orders()->delete();
        $menu->dishes()->delete();
        $menu->delete();

        return redirect('');
    }
}
