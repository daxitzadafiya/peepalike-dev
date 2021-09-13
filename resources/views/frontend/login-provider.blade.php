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
            <h2 class="header-page" id="label-id">
                LOG IN
            </h2>
            <!-- login in page -->
            <div class="login-form">
                <div class="login-err">
                    <p id="errmsg" style="display:none;" class="text-muted btn-block btn btn-danger btn-rect error-login-v"></p>
                    <p style="display:none;" class="btn-block btn btn-rect btn-success error-login-v" id="success" ></p>
                </div>
                <div class="login-form-left">
                    <form action="{{ route('providers.login') }}" class="form-signin" method = "post" id="login_box" >
                        <b>
                            <input type="hidden" name="type_usr" value="Driver"/>
                            <label>Email</label>
                            <input name="email" type="text" placeholder="Enter Email Id" class="login-input" id="vEmail" required /></b>
                        <b>
                            <label>Password</label>
                            <input name="password" type="password" placeholder="Password" class="login-input" id="vPassword" required />
                        </b>
                        <b>
                            <input type="submit" class="submit-but" value="LOG IN" />
                            <a onClick="change_heading('forgot')">Forgot password?</a>
                        </b>
                    </form>
                    <form action="#" method="post" class="form-signin" id="frmforget"
                          style="display: none;">
                        <b>
                            <label>Email</label>
                            <input name="femail" type="email" placeholder="Email" class="login-input" id="femail"
                                   value="" required/>
                        </b>
                        <b>
                            <input type="button" class="submit-but" onclick="sendOtp()" value="Recover Password"/>
                            <a onClick="change_heading('login')">Login</a>
                        </b>
                    </form>
                </div>
                <div class="login-form-right login-form-right1">
                    <div class="login-form-right1-inner">
                        <h3>Don't have an account?</h3>
                        <span><a  class="company" href="{{ route('provider.register') }}">SIGN UP</a></span>
                    </div>
                    <div class="login-form-right1-inner">
                        <h3>Register with one click:</h3>
                        <span class="login-socials">
                       <a href="https://www.facebook.com/v2.2/dialog/oauth?client_id=846023075572551&amp;redirect_uri=http%3A%2F%2Fufxforall4.bbcsproducts.com%2Ffb-login%2Ffbconfig.php&amp;state=35d62ef1be32958dc2607b8709a986bb&amp;sdk=php-sdk-4.0.15&amp;scope=email" class="fa fa-facebook"></a>
                       <a href="https://accounts.google.com/o/oauth2/auth?response_type=code&amp;redirect_uri=http%3A%2F%2Fcubetaxiplus.bbcsproducts.com%2Fgpconnect.php&amp;client_id=1087504517272-k068ann7ni2ipg1kseto68d0727mqdr1.apps.googleusercontent.com&amp;scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fplus.login+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fplus.me&amp;access_type=offline&amp;approval_prompt=auto" class="fa fa-google"></a>
               </span>
                    </div>
                </div>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="H2">Phone Verification</h4>
                </div>
                <div class="modal-body">
                    <form role="form" name="verification" id="verification">
                        <div class="form-group">
                            <label>Enter Verification code below</label>
                            <input class="form-control" type="text" id="otp"/>
                            <input class="form-control" type="hidden" id="fid"/>
                        </div>
                        <p class="help-block" id="verification_error"></p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onClick="verifyOtp()">Verify</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function change_heading(type)
        {
            $('.error-login-v').hide();
            if(type=='forgot'){

                $('#frmforget').show();
                $('#login_box').hide();
                $('#label-id').text("Forgot Password");
            }
            else{
                $('#frmforget').hide();
                $('#login_box').show();
                $('#label-id').text("LOG IN");
            }
        }
        function chkValid(login_type)
        {
            var id = document.getElementById("vEmail").value;
            var pass = document.getElementById("vPassword").value;
            if(id == '' || pass == '')
            {
                document.getElementById("errmsg").innerHTML = 'Please enter Email Id and/or password.';
                document.getElementById("errmsg").style.display = '';
                return false;
            }
            else
            {
                var request = $.ajax({
                    type: "POST",
                    url: 'ajax_login_action.php',
                    data: $("#login_box").serialize(),

                    success: function(data)
                    {
                        if(data == 1){
                            document.getElementById("errmsg").innerHTML = 'Your account seems to be deleted. Please contact administrator.';
                            document.getElementById("errmsg").style.display = '';
                            return false;
                        }
                        else if(data == 2){
                            document.getElementById("errmsg").style.display = 'none';
                            departType = '';
                            if(login_type == 'rider' && departType == 'mobi')
                                window.location = "http://cubetaxiplusbeta.bbcsproducts.com/Page-Not-Found";
                            else if(login_type == 'rider')
                                window.location = "sign-in-2.html";
                            else if(login_type == 'driver')
                                window.location = "sign-in-2.html";

                            return true; // success registration
                        }
                        else if(data == 3) {
                            document.getElementById("errmsg").innerHTML = 'Invalid Email/Mobile or Password';
                            document.getElementById("errmsg").style.display = '';
                            return false;

                        }else if(data == 4) {
                            document.getElementById("errmsg").innerHTML = 'You are not active. Please contact administrator to activate your account.';
                            document.getElementById("errmsg").style.display = '';
                            return false;

                        }
                        else {
                            document.getElementById("errmsg").innerHTML = 'Invalid Email/Mobile or Password';
                            document.getElementById("errmsg").style.display = '';
                            //setTimeout(function() {document.getElementById('errmsg1').style.display='none';},2000);
                            return false;
                        }
                    }
                });

                request.fail(function(jqXHR, textStatus) {
                    alert( "Request failed: " + textStatus );
                    return false;
                });
                return false;
            }
        }
        function forgotPass()
        {
            $('.error-login-v').hide();
            var site_type='Demo';
            var id = document.getElementById("femail").value;
            if(id == '')
            {
                document.getElementById("errmsg").style.display = '';
                document.getElementById("errmsg").innerHTML = 'Please enter correct email address.';
            }
            else {
                var request = $.ajax({
                    type: "POST",
                    url: 'ajax_fpass_action.php',
                    data: $("#frmforget").serialize(),
                    dataType: 'json',
                    beforeSend:function()
                    {
                        //alert(id);
                    },
                    success: function(data)
                    {

                        if(data.status == 1)
                        {
                            change_heading('login');
                            document.getElementById("success").innerHTML = data.msg;
                            document.getElementById("success").style.display = '';

                        }
                        else
                        {
                            document.getElementById("errmsg").innerHTML = data.msg;
                            document.getElementById("errmsg").style.display = '';
                        }

                    }
                });

                request.fail(function(jqXHR, textStatus) {
                    alert( "Request failed: " + textStatus );
                });


            }
            return false;
        }

        function fbconnect()
        {
            javscript:window.location='fbconnect.html';
        }

        $(document).ready(function(){
            var err_msg = '';
            // alert(err_msg);
            if(err_msg != ""){
                document.getElementById("errmsg").innerHTML = err_msg;
                document.getElementById("errmsg").style.display = '';
                return false;
            }
        });


        function sendOtp() {
            var email = $('#femail').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('forget-password') }}",
                method: 'post',
                data: {
                    email: email,
                    type: 'provider'
                },
                success: function (result) {
                    alert(result.message)
                    console.log(result);
                },
                error: function (err) {
                    alert("Provide valid email!")
                }
            });
        }

        function verifyOtp() {
            var otp = $('#otp').val();
            var fid = $('#fid').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('forgot.verify-otp') }}",
                method: 'post',
                data: {
                    otp: otp,
                    id: fid
                },
                success: function (result) {
                    if (result.success) {
                        var url = "{{ url('password-reset/') }}";
                        window.location.href = url + '/'+ result.data.slug;
                        // alert(result.message)
                    } else {
                        alert(result.message)
                    }
                    console.log(result);
                }
            });
        }
    </script>
@endsection