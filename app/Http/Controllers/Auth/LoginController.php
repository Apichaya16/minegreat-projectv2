<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return abort(404);
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $remember_me = $request->has('remember_me') ? true : false;

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials, $remember_me)) {
            if (auth()->user()->hasAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('customer.home');
        }
        return back()->withErrors(['username'=>'Username or password incorrect'])->withInput();
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('customer.home');
    }
}
