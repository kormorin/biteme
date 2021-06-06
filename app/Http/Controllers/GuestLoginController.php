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

	        	return redirect(route('guest_user_completion'));
	        }
        }

//    	dd($credentials);
        if (Auth::guard('guest_users')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('guest_dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
