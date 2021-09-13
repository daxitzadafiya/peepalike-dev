@extends('frontend.layout.app')
@section('style')

@endsection
@section('content')
    <div class="page-contant">
        <div class="page-contant-inner">
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <strong>
                        {{ Session::get('error')}}
                    </strong>
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <button class="close" data-close="alert"></button>
                    <strong>
                        {{ Session::get('success')}}
                    </strong>
                </div>
            @endif
                @if(count($errors))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <h2 class="header-page" id="label-id">
                Reset password
            </h2>
            <!-- login in page -->
            <div class="login-form">
                <div class="login-err">
                    <p id="errmsg" style="display:none;" class="text-muted btn-block btn btn-danger btn-rect error-login-v"></p>
                    <p style="display:none;" class="btn-block btn btn-rect btn-success error-login-v" id="success" ></p>
                </div>
                <div class="login-form-left">
                    <form action="{{ route('reset-password-save') }}" class="form-signin" method = "post" id="login_box" >
                        <input type="hidden" name="token" id="id" value="{{ $data['token'] }}">
                        <input type="hidden" name="type" id="id" value="{{ $data['type'] }}">
                        {{ csrf_field() }}
                        <b>
                            <label>Password</label>
                            <input name="password" id="otp" type="password" placeholder="Password" class="login-input" value="" required />
                        </b>
                        <b>
                            <label>Confirm Password</label>
                            <input name="password_confirmation" id="otp" type="password" placeholder="Confirm Password" class="login-input" value="" required />
                        </b>
                        <b>
                            <input type="submit" class="submit-but" value="Reset password" />
                            {{--                            <a href="{{ route('resend-otp') }}">Resend OTP ?</a>--}}
                        </b>
                    </form>
                    {{--                    <form action="#" method="post" class="form-signin" id="frmforget" style="display: none;">--}}
                    {{--                        <input type="hidden" name="id" id="id" value="{{ $id }}">--}}
                    {{--                        <input type="hidden" name="type" id="action" value="{{ $type }}">--}}
                    {{--                        <b>--}}
                    {{--                            <label>Verification code</label>--}}
                    {{--                            <input name="otp" type="number" placeholder="Email" class="login-input" value="" required />--}}
                    {{--                        </b>--}}
                    {{--                        <b>--}}
                    {{--                            <button>Verify</button>--}}
                    {{--                        </b>--}}
                    {{--                    </form>--}}
                </div>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        {{--function verifyOtp() {--}}
        {{--    var otp = $('#otp').val();--}}
        {{--    $.ajaxSetup({--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')--}}
        {{--        }--}}
        {{--    });--}}
        {{--    $.ajax({--}}
        {{--        url: "{{ route('verify.otp') }}",--}}
        {{--        method: 'post',--}}
        {{--        data: {--}}
        {{--            otp: otp,--}}
        {{--            type: "{{ $type }}",--}}
        {{--            id: "{{ $uid }}"--}}
        {{--        },--}}
        {{--        success: function (result) {--}}
        {{--            if (result.success) {--}}
        {{--                if ($('#type').val() == 'user') {--}}
        {{--                    window.location.href = "{{ route('user.login') }}";--}}
        {{--                    // location.href('/login-user');--}}
        {{--                } else {--}}
        {{--                    window.location.href = "{{ route('provider.login') }}";--}}
        {{--                }--}}
        {{--            } else {--}}
        {{--                alert(result.message)--}}
        {{--            }--}}
        {{--            console.log(result);--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}
    </script>
@endsection