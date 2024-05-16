<?php

namespace App\Http\Controllers\Web\Auth;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    // Define the guard that should be used during password reset
    protected function guard()
    {
        return auth()->guard('customers');
    }

    // Define the broker that should be used during password reset
    public function broker()
    {
        return Password::broker('customers');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm ()
    {
        if (Auth::guard('customers')->check()) {
            return redirect()->route('customer.profile');
        }
        return view('web.auth.forgot-password');
    }

    /**
     * Validate the request and Log in the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $checkEmail = Customer::whereEmail($request->email)->first();
        if ($checkEmail) {
            $response = Password::broker('customers')->sendResetLink(
                $request->only('email')
            );
            return $response == Password::RESET_LINK_SENT
            ? back()->with('success', __($response))
            : back()->with('error', __($response));
        }
        return redirect()->route('web.showForgotPasswordForm')->with('error', 'No account found with the provided email.');
    }
}
