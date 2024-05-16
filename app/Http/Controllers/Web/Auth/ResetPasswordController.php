<?php

namespace App\Http\Controllers\Web\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    // Show form to enter new password
    public function showResetForm(Request $request, $token = null)
    {
        if (Auth::guard('customers')->check()) {
            return redirect()->route('customer.profile');
        }
        return view('web.auth.reset-password', compact('token'));
    }

    // Show form to enter new password
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::broker('customers')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));
                $user->save();
            }
        );
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('web.showLoginForm')->with('success', __($status))
                    : back()->with('error', __($status));
    }
}
