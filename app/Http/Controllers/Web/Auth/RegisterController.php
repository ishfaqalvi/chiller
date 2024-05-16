<?php

namespace App\Http\Controllers\Web\Auth;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
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
     * Validate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkEmail(Request $request)
    {
        $query = Customer::query();
        if ($request->id) {
            $query->where('id','!=',$request->id);
        }
        $user = $query->whereEmail($request->email)->first();
        if($user){ echo "false"; }else{ echo "true";}
    }
}
