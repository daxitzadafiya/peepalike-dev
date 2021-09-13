<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Provider;
use App\PasswordReset;

class PasswordResetController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     *
     * Create by VDM
     */
    public function requestPasswordReset(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'user_type' => 'required'
        ]);
        $email = $request->email;
        $userType = $request->user_type;

        if ($userType == 'User') {
            $user = User::where('email', $email)->first();
            if ($user) {
                $otp = $this->otpGenerator();
                $passwordReset = new PasswordReset();
                $passwordReset->user_id = $user->id;
                $passwordReset->user_type = $userType;
                $passwordReset->otp = $otp;
                if ($passwordReset->save()) {
                    $body = 'Dear User, OTP for reset password is ' . $otp . '.';
                    $sendOtp = $this->sendSms($body, '+'.$user->phone);
                    if ($sendOtp) {
                        $data = [
                            'email' => $user->email,
                            'user_type' => $userType,
                            'otp' => $otp
                        ];
                        return $this->makeResponse('We have sent OTP to your registered mobile number.', $data);
                    } else {
                        $passwordReset->delete();
                        return $this->makeError('Some problem occurred, please try again.');
                    }
                } else {
                    return $this->makeError('Some problem occurred, please try again.');
                }
            } else {
                return $this->makeError('Please enter valid email.');
            }
        } else if ($userType == 'Provider') {
            $user = Provider::where('email', $email)->first();
            if ($user) {
                $otp = $this->otpGenerator();
                $passwordReset = new PasswordReset();
                $passwordReset->user_id = $user->id;
                $passwordReset->user_type = $userType;
                $passwordReset->otp = $otp;
                if ($passwordReset->save()) {
                    $body = 'Dear Provider, OTP for reset password is ' . $otp . '.';
                    $sendOtp = $this->sendSms($body, '+'.$user->phone);
                    if ($sendOtp) {
                        $data = [
                            'email' => $user->email,
                            'user_type' => $userType,
                            'otp' => $otp
                        ];
                        return $this->makeResponse('We have sent OTP to your registered mobile number.', $data);
                    } else {
                        $passwordReset->delete();
                        return $this->makeError('Some problem occurred, please try again.');
                    }
                } else {
                    return $this->makeError('Some problem occurred, please try again.');
                }
            } else {
                return $this->makeError('Please enter valid email.');
            }
        }
    }

    /**
     * @param Request $request
     * @return mixed
     *
     * Created by VDM
     */
    public function checkOtp(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'user_type' => 'required',
            'otp' => 'required'
        ]);

        $email = $request->email;
        $userType = $request->user_type;

        if ($userType == 'User') {
            $user = User::where('email', $email)->first();
            if ($user) {
                $checkOtp = PasswordReset::where('user_id', $user->id)->where('user_type', $userType)->where('otp', $request->otp)->first();
                if($checkOtp) {
                    $data = [
                        'email' => $user->email,
                        'user_type' => $userType
                    ];
                    return $this->makeResponse('Otp verification successful.', $data);
                } else {
                    return $this->makeError('Please enter valid Otp.');
                }
            } else {
                return $this->makeError('Verification failed.');
            }
        } else if ($userType == 'Provider') {
            $user = Provider::where('email', $email)->first();
            if ($user) {
                $checkOtp = PasswordReset::where('user_id', $user->id)->where('user_type', $userType)->where('otp', $request->otp)->first();
                if($checkOtp) {
                    $data = [
                        'email' => $user->email,
                        'user_type' => $userType
                    ];
                    return $this->makeResponse('Otp verification successful.', $data);
                } else {
                    return $this->makeError('Please enter valid Otp.');
                }
            } else {
                return $this->makeError('Verification failed.');
            }
        }
    }

    /**
     * @param Request $request
     * @return mixed
     *
     * Created by VDM
     */
    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'user_type' => 'required',
            'password' => 'required'
        ]);

        $email = $request->email;
        $userType = $request->user_type;

        if ($userType == 'User') {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->password = bcrypt($request->password);
                if ($user->save()) {
                    return $this->makeResponse('Password reseted successful.');
                } else {
                    return $this->makeError('Please try again.');
                }
            } else {
                return $this->makeError('Please try again.');
            }
        } else if ($userType == 'Provider') {
            $user = Provider::where('email', $email)->first();
            if ($user) {
                $user->password = bcrypt($request->password);
                if ($user->save()) {
                    return $this->makeResponse('Password reseted successful.');
                } else {
                    return $this->makeError('Please try again.');
                }
            } else {
                return $this->makeError('Please try again.');
            }
        }
    }
}
