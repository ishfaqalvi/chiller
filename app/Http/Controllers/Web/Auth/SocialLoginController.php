<?php

namespace App\Http\Controllers\Web\Auth;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    /**
     * Redirect to facebook provider.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * After varification authenticate user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function handleProviderFacebookCallback()
    {
        try {
            $socialUser = Socialite::driver('facebook')->user();
            $customer = Customer::whereEmail($socialUser->getEmail())->first();
            if (!$customer) {
                $names = explode(' ', $socialUser->getName());
                $customer = Customer::create([
                    'first_name' => $names[0],
                    'last_name' => count($names) > 1 ? end($names) : '',
                    'email' => $socialUser->getEmail()
                ]);
            }
            if (Auth::guard('customers')->login($customer, true)) {
                return redirect()->route('customer.profile');
            }
            return redirect()->route('web.showLoginForm')->with('error', 'Unable to create user account.');
        } catch (\Exception $e) {
            return redirect()->route('web.showLoginForm')->with('error', 'Something went wrong!');
        }
    }

    /**
     * Redirect to google provider.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * After varification authenticate user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function handleProviderGoogleCallback()
    {
        try {
            $socialUser = Socialite::driver('google')->user();
            $customer = Customer::whereEmail($socialUser->getEmail())->first();
            if (!$customer) {
                $names = explode(' ', $socialUser->getName());
                $customer = Customer::create([
                    'first_name' => $names[0],
                    'last_name' => count($names) > 1 ? end($names) : '',
                    'email' => $socialUser->getEmail()
                ]);
            }
            if (Auth::guard('customers')->login($customer, true)) {
                return redirect()->route('customer.profile');
            }
            return redirect()->route('web.showLoginForm')->with('error', 'Unable to create user account.');
        } catch (\Exception $e) {
            return redirect()->route('web.showLoginForm')->with('error', 'Something went wrong!');
        }
    }
}
