<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
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
    protected $redirectTo = '/dashboard'; // always redirect here when logging in
    protected $loginPath = '/login'; // default for customers
    protected $guard = 'users'; // only available in laraval 5.2.8
    protected $loginView = 'Auth.login'; // login template


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    public function showLoginForm(){
        return view('Auth.login');
    }
     /**
    * Login
    *
    *
    */
    public function login(){

        //attempt to login
        $valid = Auth::guard('users')->attempt(['email' => Input::get('email'), 'password' => Input::get('password')]);

        //check if successfully login
        if (!$valid) {
            return redirect()->back()->withErrors(['error' => "Invalid username and password"]);
        }
         //return intended url
         return redirect()->intended('/dashboard');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
