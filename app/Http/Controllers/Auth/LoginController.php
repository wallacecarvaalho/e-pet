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

    public function loginSocial(Request $request){
            $this->validate($request,[
                'social_type'=>'required|in:google,facebook'
            ]);
            $socialType = $request->get('social_type');
            \Session::put('social_type',$socialType);
            return \Socialite::driver($socialType)->redirect();

    }

    public function loginCallBack(){

        $socialType = \Session::pull('social_type');
        $userSocial = \Socialite::driver($socialType)->user();

        $user = User::where('email',$userSocial->email)->first();
            if(!$user){
               $user = User::create([
                    'name'=> $userSocial->name,
                    'email'=>$userSocial->email,
                    //'password'=>bcrypt(str_random(8))
                    'password'=>bcrypt('123456'),
                    'role'=>User::ROLE_USER,
                    'phone' => '12345678910',
                ]);
            }
            \Auth::login($user);
            return redirect()->intended($this->redirectPath());

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
