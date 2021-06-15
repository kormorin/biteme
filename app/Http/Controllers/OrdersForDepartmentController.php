<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrdersForDepartmentController extends Controller
{
    public function daySelection()
    {
    	return view('guest.department_list_day_selection');
    }

    public function show($day)
    {
    	$department_id = auth()->user()->department_id;

    	$menu = Menu::where('served_at', $day)->first();
    	if(!$menu)
    	{
			$error = __('The menu for this day is not yet available.');
			return back()->withErrors([$error]);    		
    	}

    	$orders = Order::whereHas('menu_id', $menu->id)->where('department_id', $department_id)->get();

    	$department = Department::find(auth()->user()->department_id);
/*
    	$rows = [];
    	foreach($menu->dishes as $dish)
    	{
    		$row['dish_id'] = $dish->id;
    		$row['dish_name'] = $dish->nameText;
    		$row['count'] = OrderItem::where('dish_id', $dish->id)->count();

    		$row['sub_rows'] = [];
    		foreach($departments as $department)
    		{
    			$sub_row['department_name'] = $department->nameText;
    			$sub_row['count'] = 
    			DB::table('order_items')->join('orders', 'orders.id', '=', 'order_items.order_id')
    				->where('orders.department_id', $department->id)
    				->where('order_items.dish_id', $dish->id)
    				->count();

				if($sub_row['count'] > 0)
					$row['sub_rows'][] = $sub_row;
    		}

    		$rows[] = $row;
    	}
*/
    	return view('guest.department_list', compact('day', 'orders', 'department', 'menu'));
    }
}
