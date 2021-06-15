<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlaceOrderController extends Controller
{
    public function daySelection()
    {
    	return view('guest.place_order_day_selection');
    }

    public function chooseFromMenu($day)
    {
    	$menu = Menu::where('served_at', $day)->first();

    	if(!$menu)
    	{
			$error = __('The menu for this day is not yet available.');
			return redirectToRoute('menu')->withErrors([$error]);    		
    	}

    	$dishes = $menu->dishes()->listable()->with('type')->orderBy('type_id', 'asc')->get();

    	$dish_groups = $dishes->groupBy->typeName;
        $day = Carbon::parse($day)->format('Y. m. d.');

    	$order = Order::where('menu_id', $menu->id)
    		->where('user_id', auth()->user()->id)
    		->first();

    	return view('guest.place_order', compact('day', 'dish_groups', 'order'));

    }

    public function placeOrder(Request $request, $day)
    {
/*
        if(!auth()->user()->registrationCompleted)
        {
            $error = __('Looks like your registration is not yet complete. Please go to the "Profile" page and save your name and the department.');
            return back()->withErrors([$error]);
        }
*/
        if(!$request->has('dishes') || !is_array($request->dishes))
        {
            $error = __('Wait a minute, you haven\'t selected anything! Are you not hungry?');
            return back()->withErrors([$error]);
        }


    	$dishes = Dish::whereIn('id', $request->dishes)->listable()->get();
    	$menu = Menu::where('served_at', $day)->first();

//        dd($request->dishes);
		if($dishes->isEmpty())
		{
			$error = __('Wait a minute, you haven\'t selected anything! Are you not hungry?');
			return back()->withErrors([$error]);
		}
 
    	$counts_by_type = $dishes->groupBy('type_id')->map->count();

    	foreach($counts_by_type as $type_id => $count)
    	{
    		if($count > 1)
    		{
    			$error = __('You are only allowed to pick one of each categories of meals (main dish, dessert, etc.) Please modify your order accordingly');
    			return back()->withErrors([$error]);
    		}
    	}

    	$user = auth()->user();

    	$order = Order::where('menu_id', $menu->id)
    		->where('user_id', $user->id)
    		->first();

    	if($order)
    	{
    		$order->items()->delete();
    	}
    	else
    	{
	    	$order = Order::create([
	    		'user_id' => $user->id,
	    		'menu_id' => $menu->id,
	    		'department_id' => $user->department->id,
	    	]);
    	}

    	foreach($dishes as $dish)
    	{
	    	OrderItem::create([
	    		'order_id' => $order->id,
	    		'dish_id' => $dish->id,
	    	]);

    	}    		

    	return back()->with('success', __('Order saved.'));
    }
}
