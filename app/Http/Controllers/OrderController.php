<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show()
    {
    	$orders = [
    		'name' => 'Eperleves',
    		''
    	];
    	return view('orders');
    }
}
