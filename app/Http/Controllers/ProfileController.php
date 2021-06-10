<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function show()
    {
    	$user = auth()->user();

    	return view('profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
    	$request->validate([
    		'name' => 'required',
    		'email' => 'required'
    	]);

    	auth()->user()->update($request->only(['name', 'email']));

    	return redirect(route('profile'))->with('profile_update_message', __('Profile update successful'));
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

    	return redirect(route('profile'))->with('password_update_message', __('Password update successful'));
    }

    public function createNewAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => ['required', 'confirmed'],
        ]);

        AdminUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ]);

        return redirect(route('profile'))->with('create_admin_message', __('New admin created'));
    }
}
