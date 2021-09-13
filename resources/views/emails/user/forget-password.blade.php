@extends('emails.layouts.master')
    @section('header')
        <div style="text-align: center;">
            <a href="{{ config('app.url') }}">
                <h1>{{config('app.name')}}</h1>
            </a>
        </div>
    @stop

    @section('slot')
        <div style="padding: 30px;">
            <div style="font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 34px;">
                <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                    Dear {{ $data['first_name']. ' ' .$data['last_name'] }},
                </p>

                <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                    You are receiving this email because we received a password reset request for your account
                </p>

                <p style="text-align: center;padding: 20px 0;">
                    <a href="{{ $data['route'] }}" style="padding: 10px 20px;background: #0041FF;color: #ffffff;text-transform: uppercase;text-decoration: none; font-size: 16px">
                        Reset Password
                    </a>
                </p>

                <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                    If you did not request a password reset, no further action is required
                </p>

                <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                    Thanks!
                </p>

            </div>
        </div>
    @stop
