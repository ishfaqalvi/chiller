<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Customer;

class AuthController extends Controller
{
    /**
     * Show the application's register form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegisterForm()
    {
        if (Auth::guard('customers')->check()) {
            return redirect()->route('customer.profile');
        }
        return view('web.auth.register');
    }

    /**
     * Validate the request and register the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        Customer::create($request->all());
        return redirect()->route('web.login')->with('success', 'Your account created successfully!');
    }

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
            redirect()->route('customer.profile');
        }

        return redirect()->route('web.login')->with('error', 'The provided credentials do not match our records.');
    }

    /**
     * Validate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkEmail(Request $request)
    {
        if ($request->id) {
            $user = Customer::where('id','!=',$request->id)->where('email', $request->email)->first();
        }else{
            $user = Customer::where('email', $request->email)->first();
        }
        if($user){ echo "false"; }else{ echo "true";}
    }
}