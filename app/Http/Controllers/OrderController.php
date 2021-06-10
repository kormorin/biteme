<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Menu;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function daySelection()
    {
    	return view('order_day_selection');
    }

    public function reviewOrders($day)
    {
    	$menu = Menu::where('served_at', $day)->first();

    	if(!$menu)
    		return back()->withErrors([__('There is no menu for this day.')]);

    	if(!$menu->orders)
    		return back()->withErrors([__('There are no orders for this day\'s menu.')]);

    	$departments = Department::all();

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
    	return view('review_orders', compact('day', 'rows'));
    }

}
