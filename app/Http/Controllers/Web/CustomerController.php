<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\{Customer,CustomerBillingInformation};

class CustomerController extends Controller
{
    /**
     * Show the profile page.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        return view('web.customer.profile');
    }

    /**
     * Validate the request and Log in the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        auth('customers')->user()->update($request->all());
        return redirect()->back()->with('success','Profile updated successfully!');
    }

    /**
     * Validate the request and Log in the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function billingInfo(Request $request)
    {
        CustomerBillingInformation::updateOrCreate(
            ['customer_id' => auth('customers')->user()->id],
            $request->all()
        );
        return redirect()->back()->with('success','Billing info updated successfully!');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::guard('customers')->logout();
        return redirect()->route('web.showLoginForm');
    }
}
