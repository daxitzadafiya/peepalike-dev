<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Provider;
use App\TempUser;
use App\TempProvider;
use App\ProviderCategory;
use App\WebResetPassword;
use Illuminate\Support\Facades\Mail;
use Session;
use Auth;
use App\Mail\VerificationEmail;
use App\Mail\RegistrationEmail;
use App\Mail\ResetPasswordEmail;

class FrontendAuthController extends Controller
{
    public function userLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('user_web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
            if (Auth::guard('user_web')->user()->status == 'active') {
                return redirect()->route('users.dashboard');
            } else if (Auth::guard('user_web')->user()->status == 'verified')  {
                Session::flash('error', 'Your account is not active, please contact support!');
            } else {
                Session::flash('error', 'Your email is not verified!');
            }
            Auth::guard('user_web')->logout();
            return redirect()->back();
        } else {
            Session::flash('error', 'Incorrect email or password.');
            return redirect()->back();
        }
    }

    public function providerLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('provider_web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
            if (Auth::guard('provider_web')->user()->status == 'active') {
                return redirect()->route('providers.dashboard');
            } else if (Auth::guard('provider_web')->user()->status == 'verified') {
                Session::flash('error', 'Your account is not active, please contact support!');
            } else {
                Session::flash('error', 'Your email is not verified!');
            }
            Auth::guard('provider_web')->logout();
            return redirect()->back();
        } else {
            Session::flash('error', 'Incorrect email or password.');
            return redirect()->back();
        }
    }

    public function userSignup(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'mobile' => 'required|unique:users'
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->country_code = $request->code;
        $user->image = '';
        $user->login_type = 'Manual';
        $user->token = md5(uniqid(rand(), true));
        if ($user->save()) {
            $verificationData['email'] = $user->email;
            $verificationData['route'] = route('verify-account', ['user', $user->token]);

            try {
                Mail::to($user->email)->send((new VerificationEmail($verificationData)));
                Session::flash('success', 'We have sent verification link to you email.');
                return redirect()->route('user.login');
            } catch (\Exception $e) {
                Session::flash('error', 'Unable to register!');
                return redirect()->route('user.login');
            }
        } else {
            Session::flash('error', 'Registration failed.');
            return redirect()->back();
        }
    }

    public function providerSignup(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:provider',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'mobile' => 'required|unique:provider',
            'address1' => 'required',
            'address2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required'
        ]);

        $provider = new Provider();
        $provider->first_name = $request->first_name;
        $provider->last_name = $request->last_name;
        $provider->password = bcrypt($request->password);
        $provider->email = $request->email;
        $provider->mobile = $request->mobile;
        $provider->addressline1 = $request->address1;
        $provider->addressline2 = $request->address2;
        $provider->city = $request->city;
        $provider->state = $request->state;
        $provider->zipcode = $request->zipcode;
        $provider->country_code = $request->code;
        $provider->token = md5(uniqid(rand(), true));

        if ($provider->save()) {

            $verificationData['email'] = $provider->email;
            $verificationData['route'] = route('verify-account', ['provider', $provider->token]);

            try {
                Mail::to($provider->email)->send((new VerificationEmail($verificationData)));
                Session::flash('success', 'We have sent verification link to you email.');
                return redirect()->route('user.login');
            } catch (\Exception $e) {
                Session::flash('error', 'Unable to register!');
                return redirect()->route('user.login');
            }
        } else {
            Session::flash('error', 'Registration failed.');
            return redirect()->back();
        }
    }

    public function verifyAccount($type, $token)
    {
        if ($type == 'user') {
            $user = User::where('token', $token)->first();
            $route = 'user.login';
        } else if ($type == 'provider') {
            $user = Provider::where('token', $token)->first();
            $route = 'provider.login';
        } else {
            abort(404);
        }

        if (!$user) {
            abort(404);
        }
        $user->status = 'verified';
        $user->token = null;
        $user->save();

        $data['first_name'] = $user->first_name;
        $data['last_name'] = $user->last_name;
        $data['email'] = $user->email;

        try {
            Mail::to($user->email)->send((new RegistrationEmail($data)));
        } catch (\Exception $e) {
        }

        Session::flash('success', 'Account verified successfully.');
        return redirect()->route($route);
    }

    public function forgetPassword(Request $request)
    {
        if ($request->type == 'user') {
            $user = User::where('email', $request->email)->first();
        } else if ($request->type == 'provider') {
            $user = Provider::where('email', $request->email)->first();
        } else {
            return $this->makeError('Enter valid email.', []);
        }

        if (!$user) {
            return $this->makeError('Enter valid email.', []);
        }

        $user->token = md5(uniqid(rand(), true));
        $user->save();

        $data['first_name'] = $user->first_name;
        $data['last_name'] = $user->last_name;
        $data['email'] = $user->email;
        $data['route'] = route('reset-password', [$request->type, $user->token]);

        try {
            Mail::to($user->email)->send((new ResetPasswordEmail($data)));
        } catch (\Exception $e) {
            return $this->makeError('Something went wrong.', []);
        }

        return $this->makeResponse('We have sent reset password link to you email.');
    }

    public function resetPasswordForm($type, $token)
    {
        if ($type == 'user') {
            $user = User::where('token', $token)->first();
            $route = 'user.login';
        } else if ($type == 'provider') {
            $user = Provider::where('token', $token)->first();
            $route = 'provider.login';
        } else {
            abort(404);
        }

        if (!$user) {
            abort(404);
        }

        $data = [
            'type' => $type,
            'token' => $token
        ];

        return view('frontend.reset-password-form', compact('data'));
    }

    public function resetPasswordSave(Request $request)
    {
        $this->validate($request, [
            'password' => 'confirmed|min:6',
        ]);
        if ($request->type == 'user') {
            $user = User::where('token', $request->token)->first();
            $route = 'user.login';
        } else if ($request->type == 'provider') {
            $user = Provider::where('token', $request->token)->first();
            $route = 'provider.login';
        } else {
            abort(404);
        }

        if (!$user) {
            abort(404);
        }

        $user->password = bcrypt($request->password);
        $user->token = '';
        if ($user->save()) {
            Session::flash('success', 'Password changed successfully.');
        } else {
            Session::flash('error', 'Password reset failed.');
        }
        return redirect()->route($route);
    }

    public function verifyOtp(Request $request)
    {
        $id = $request->id;
        if ($request->type == 'user') {
            $tmpUser = TempUser::find($id);
            if ($tmpUser->otp == $request->otp) {
                $user = new User();
                $user->first_name = $tmpUser->first_name;
                $user->last_name = $tmpUser->last_name;
                $user->password = $tmpUser->password;
                $user->email = $tmpUser->email;
                $user->mobile = $tmpUser->mobile;
                $user->country_code = $tmpUser->country_code;
                $user->image = '';
                $user->login_type = 'Manual';

                if ($user->save()) {
                    $tmpUser->delete();
                    return $this->makeResponse('Registration successful.', []);
//                    Session::flash('success', 'Registration successful.');
//                    return redirect()->route('user.login');
                } else {
                    return $this->makeError('Registration failed.', []);
//                    Session::flash('error', 'Registration failed.');
//                    return redirect()->back();
                }
            } else {
                return $this->makeError('Enter valid otp.', []);
            }
        } else {
            $tmpProvider = TempProvider::find($id);
            if ($tmpProvider->otp == $request->otp) {
                $provider = new Provider();
                $provider->first_name = $tmpProvider->first_name;
                $provider->last_name = $tmpProvider->last_name;
                $provider->password = $tmpProvider->password;
                $provider->email = $tmpProvider->email;
                $provider->mobile = $tmpProvider->mobile;
                $provider->addressline1 = $tmpProvider->address1;
                $provider->addressline2 = $tmpProvider->address2;
                $provider->city = $tmpProvider->city;
                $provider->state = $tmpProvider->state;
                $provider->zipcode = $tmpProvider->zipcode;
                $provider->country_code = $tmpProvider->country_code;

                if ($provider->save()) {
                    $tmpProvider->delete();
                    return $this->makeResponse('Registration successful.', []);
//                    Session::flash('success', 'Registration successful.');
//                    return redirect()->route('user.login');
                } else {
                    return $this->makeError('Registration failed.', []);
//                    Session::flash('error', 'Registration failed.');
//                    return redirect()->back();
                }
            } else {
                return $this->makeError('Enter valid otp.', []);
            }
        }
    }

    public function sendOtp($user, $type)
    {
        $otp = $this->otpGenerator();
        if ($type == 'user') {
            $tmpU = TempUser::find($user->id);
            $tmpU->otp = $otp;
            $tmpU->save();
            $msgOTP = $tmpU->otp;
        } else {
            $tmpP = TempProvider::find($user->id);
            $tmpP->otp = $otp;
            $tmpP->save();
            $msgOTP = $tmpP->otp;
        }
//        echo '<pre>'; print_r($user);exit;
        $body = 'Dear ' . $type . ', OTP for verify your number is ' . $msgOTP . '.';
        $sendOtp = $this->sendSms($body, '+' . $user->country_code . $user->mobile);
        $uid = $user->id;
        if ($sendOtp) {
            return view('frontend.otp-verification', compact('type', 'uid'));
        } else {
            Session::flash('error', 'Registration failed.');
            return redirect()->back();
        }
    }

    public function sendForgotOtp(Request $request)
    {
        if ($request->type == 'user') {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $otp = $this->otpGenerator();
                $reset = new  WebResetPassword();
                $reset->otp = $otp;
                $reset->mobile = $user->mobile;
                $reset->type = 0;
                $reset->slug = $this->slugGenerator();
                $reset->save();
                $type = 'User';
                $msgOTP = $reset->otp;
                $rId = $reset->id;
            } else {
                return $this->makeError('Enter valid email.', []);
            }
        } else {
            $user = Provider::where('email', $request->email)->first();
            if ($user) {
                $otp = $this->otpGenerator();
                $reset = new  WebResetPassword();
                $reset->otp = $otp;
                $reset->mobile = $user->mobile;
                $reset->type = 1;
                $reset->slug = $this->slugGenerator();
                $reset->save();
                $type = 'Provider';
                $msgOTP = $reset->otp;
                $rId = $reset->id;
            } else {
                return $this->makeError('Enter valid email.', []);
            }
        }

        $body = 'Dear ' . $type . ', OTP for reset password is ' . $msgOTP . '.';
        $sendOtp = $this->sendSms($body, '+' . $user->country_code . $user->mobile);

        if ($sendOtp) {
            return $this->makeResponse('OTP sent to your registered mobile number.', ['id' => $rId]);
        } else {
            return $this->makeError('Something went wrong.', []);
        }
    }

    public function verifyResetOtp(Request $request)
    {
        $reset = WebResetPassword::find($request->id);
        if ($reset->otp == $request->otp) {
            return $this->makeResponse('', ['slug' => $reset->slug]);
        } else {
            return $this->makeError('Enter valid OTP.', []);
        }
    }

    public function resetForm($slug)
    {
        $reset = WebResetPassword::where('slug', $slug)->first();
        $rId = $reset->id;
        if ($reset) {
            return view('frontend.reset-password-form', compact('rId'));
        } else {
            abort(404);
        }
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'confirmed|min:6',
        ]);
        $reset = WebResetPassword::find($request->id);
        if ($reset->type) {
            $user = Provider::where('mobile', $reset->mobile)->first();
            $user->password = bcrypt($request->password);
            if ($user->save()) {
                Session::flash('success', 'Password reseted.');
                return redirect('login-provider');
            } else {
                Session::flash('error', 'Password reset failed.');
                return redirect()->back();
            }
        } else {
            $user = User::where('mobile', $reset->mobile)->first();
            $user->password = bcrypt($request->password);
            if ($user->save()) {
                Session::flash('success', 'Password reseted.');
                return redirect('login-user');
            } else {
                Session::flash('error', 'Password reset failed.');
                return redirect()->back();
            }
        }
    }

    public function slugGenerator()
    {
        $n = 15;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }
}
