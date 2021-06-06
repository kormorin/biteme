<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function show()
    {
    }

    public function userCompletion()
    {
    	$user = auth()->guard('guest_users')->user();
    	return view('guest.user_completion', compact('user'));
    }
}
