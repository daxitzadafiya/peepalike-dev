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
        <div style="padding: 30px;">
            <div style="font-size: 20px;color: #242424;line-height: 30px;margin-bottom: 34px;">
                <p style="font-weight: bold;font-size: 20px;color: #242424;line-height: 24px;">
                    Dear {{ $data['first_name']. ' ' .$data['last_name'] }},
                </p>

                <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                    Welcome and thank you for registering at {{config('app.name')}}!
                </p>
            </div>

            <div style="font-size: 16px;color: #5E5E5E;line-height: 30px;margin-bottom: 20px !important;">
                Your account has now been created successfully and you can login using your email address and password credentials.
            </div>

            <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
                Thanks!
            </p>
        </div>
    </div>
@stop

