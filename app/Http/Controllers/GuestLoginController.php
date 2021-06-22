<?php

namespace App\Http\Controllers;

use App\Models\GuestUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestLoginController extends Controller
{

	public function show()
	{
		return view('auth.guest_login');
	}

    public function authenticate(Request $request)
    {
    	$remember_me = $request->remember === 'on';

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if($request->password === GuestUser::first_password)
        {
	        $user_exists = GuestUser::where('email', $request->email)->exists();

	        if(!$user_exists)
	        {
	        	$new_user = GuestUser::create([
	        		'name' => '',
	        		'email' => $request->email,
	        		'password' => bcrypt(GuestUser::first_password),
	        		'department_id' => null,
	        	]);

	        	auth('guest_users')->login($new_user);

	        	return redirect(route('guest.profile'));
	        }
        }

        if (Auth::guard('guest_users')->attempt($credentials, $remember_me)) {
            $request->session()->regenerate();

            return redirect()->intended('place_order');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('guest_users')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }
}
