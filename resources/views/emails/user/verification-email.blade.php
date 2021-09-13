@extends('emails.layouts.master')

    @section('header')
        <div style="text-align: center;">
            <a href="{{ config('app.url') }}">
                <h1>{{config('app.name')}}</h1>
            </a>
        </div>
    @stop

@section('slot')
    <div>
        <div  style="font-size:16px; color:#242424; font-weight:600; margin-top: 60px; margin-bottom: 15px">
            {{ config('app.name') }} - Email Verification
        </div>

        <div style="font-size: 16px;color: #5E5E5E;line-height: 30px;margin-bottom: 20px !important;">
            This is the mail to verify that the email address you entered is yours.
            Kindly click the Verify Your Account button below to verify your account.
        </div>

        <div  style="margin-top: 40px; text-align: center">
            <a href="{{ $data['route'] }}" style="font-size: 16px;
            color: #FFFFFF; text-align: center; background: #0031F0; padding: 10px 100px;text-decoration: none;">
                Verify Your Account
            </a>
        </div>
    </div>
@stop
