<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
     * Login username to be used by the controller.
     *
     * @var string
     */
    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }

    public function findUsername()
    {
        $login = request()->input('login');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }

    public function username()
    {
        return $this->username;
    }

//    public function login(Request $request)
//    {
//        $inputVal = $request->all();
//
//        $this->validate($request, [
//            'email' => 'required|email',
//            'password' => 'required',
//        ]);
//
//        if(auth()->attempt(array('email' => $inputVal['email'], 'password' => $inputVal['password']))){
//            if (auth()->user()->position == 'manager') {
//                return redirect()->route('manager.route');
//            }else if(auth()->user()->position == 'officer'){
//                return redirect()->route('officer.route');
//            }else{
//                return redirect()->route('home');
//            }
//        }else{
//            return redirect()->route('login')
//                ->with('error','Email & Password are incorrect.');
//        }
//    }

}