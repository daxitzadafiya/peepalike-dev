@extends('frontend.layout.app')

@section('content')
    <div class="page-contant">
        <div class="page-contant-inner">
            <h2 class="header-page">SIGN IN</h2>
            <!-- login in page -->
            <div class="sign-in">
                <div class="sign-in-driver">
                    <h3>Company</h3>
                    <p>Manage your Service Providers,payment options, review job history, and more.</p>
                    <span><a href="{{ route('provider.login') }}">COMPANY SIGN IN<img src="{{ asset('frontend/assets/img/arrow-white-right.png') }}"
                                                                           alt=""/></a></span>
                </div>
                <div class="sign-in-driver">
                    <h3>Service Provider</h3>
                    <p>Find everything you need to track your success on the road.</p>
                    <span><a href="{{ route('provider.login') }}">Service Provider Sign In<img
                                    src="{{ asset('frontend/assets/img/arrow-white-right.png') }}" alt=""/></a></span>
                </div>

                <div class="sign-in-rider">
                    <h3>User</h3>
                    <p>Manage your payment options, job , and more.</p>
                    <span><a href="{{ route('user.login') }}">User sign in<img src="{{ asset('frontend/assets/img/arrow-white-right.png') }}"
                                                                      alt=""/></a></span>
                </div>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
@endsection