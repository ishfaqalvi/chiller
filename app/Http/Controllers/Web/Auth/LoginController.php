<?php

namespace App\Http\Controllers\Web\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        if (Auth::guard('customers')->check()) {
            return redirect()->route('customer.profile');
        }
        return view('web.auth.login');
    }

    /**
     * Validate the request and Log in the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customers')->attempt($credentials)) {
            return redirect()->route('customer.profile');
        }

        return redirect()->route('web.login')->with('error', 'The provided credentials do not match our records.');
    }
}
