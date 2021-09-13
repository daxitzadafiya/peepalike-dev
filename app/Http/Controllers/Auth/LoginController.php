<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest', ['except' => 'logout']);
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $this->_registerOrLoginUser($user,'facebook');

        return redirect()->route('user.dashboard');

    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $this->_registerOrLoginUser($user,'google');

        return redirect()->route('user.dashboard');
    }

    protected function _registerOrLoginUser($data,$login_type)
    {
        $user = User::where('email',$data->email)->first();

        if(!$user){
            $name = explode(" ",$data->name);
            $user = new User();
            $user->first_name = $name[0];
            $user->last_name = $name[1];
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->image = $data->avatar;
            if($login_type == "google"){
                $user->google_token = $data->token;
            } else if($login_type == "facebook") {
                $user->facebook_token = $data->token;
            }
            $user->login_type = $login_type;
            $user->is_avatar = '1';
            $user->save();
        }
        Auth::guard('user_web')->login($user);
    }
}
