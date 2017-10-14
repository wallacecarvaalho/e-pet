<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
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
    //protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo(){

    return \Auth::user()->role == User::ROLE_ADMIN ? '/admin/dashboard' : '/    ';
    
    }
        public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect($request->is('/admin/*') ? '/admin/login' : '/');
    }

    protected function credentials(Request $request){

        $data = $request->only($this->username(),'password');
        //$data['phone'] = $data['email'];
        $userNameKey = $this->userNameKey();
        if($userNameKey != $this->username()){
            $data[$this->userNameKey()] = $data[$this->username()];
            unset($data[$this->username()]);
        }
        
        return $data;
    }


    protected function userNameKey(){

        $email = \Request::get('email');
        $validator = \Validator::make([
            'email'=>$email
        ], ['email' => 'phone']);

            if(is_numeric($email)){
                return 'phone';
            }
            return 'email';

        }


}
