<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GuestProfileController extends Controller
{
    public function index()
    {
    	$user = auth()->guard('guest_users')->user();
    	return view('guest.staff_profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
    	$request->validate([
    		'name' => 'required',
    		'email' => 'required',
    		'department' => 'required'
    	]);

    	$fields = $request->only(['name', 'email']);
    	$fields['department_id'] = $request->department;

    	auth()->user()->update($fields);

    	return redirect(route('guest.profile'))->with('profile_update_message', __('Profile update successful'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed'],
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ]);

    	return redirect(route('guest.profile'))->with('password_update_message', __('Password update successful'));
    }
}
