<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

    public function login(Request $request)
    {
        // Validate the input (farmer_number and password)
        $validator = Validator::make($request->all(), [
            'farmer_number' => 'required|string',
            'password' => 'required',
        ], [
            'farmer_number.required' => 'किसान नम्बर आवश्यक छ।',
            'farmer_number.string' => 'किसान नम्बर केवल अङ्क र अक्षर हुनुपर्छ।',
            'password.required' => 'पासवर्ड आवश्यक छ।',
        ]);
        

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Attempt to log in using farmer_number and password
        if (Auth::attempt(['farmer_number' => $request->farmer_number, 'password' => $request->password], $request->remember)) {
            return redirect()->route('admin.home');  // Redirect to the dashboard or any other route after successful login
        } else {
            return redirect()->back()->with('error', 'कृपया सही किसान नम्बर वा पासवर्ड प्रविष्ट गर्नुहोस्।');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
