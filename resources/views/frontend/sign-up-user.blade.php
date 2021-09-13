@extends('frontend.layout.app')

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
            <h2 class="header-page-rd trip-detail">REGISTER
            </h2>
            <form name="frmsignup" id="frmsignup" method="post"
                  action="{{ route('user.signup') }}">
                {{ csrf_field() }}
                <div class="driver-signup-page">
                    <div class="create-account line-dro">
                        <h3>Create an Account</h3>
                        <span class="newrow">
                           <strong id="emailCheck"><label>Email Id<span class="red">*</span></label>
                           <input type="email" required placeholder="Your Email ID" name="email" id="vEmail_verify"
                                  class="create-account-input"/></strong>
                           <strong><label>Password<span class="red">*</span></label>
                           <input id="REGISTERpass" type="password" required name="password" placeholder="Password"
                                  class="create-account-input create-account-input1"/></strong>
                        </span>
                        <span class="newrow">
                         <strong><label>First Name<span class="red">*</span></label>
                         <input name="first_name" required type="text" class="create-account-input"
                                placeholder="First Name"
                                id="vName"/></strong>
                         <strong><label>Last Name<span class="red">*</span></label>
                         <input name="last_name" type="text" class="create-account-input create-account-input1"
                                placeholder="Last Name" required id="vLastName"/></strong>
                       </span>
                        <span class="newrow">
                            <strong><label>Phone Number<span class="red">*</span></label>

                            <strong class="ph_no newrow" id="mobileCheck">
                                <input required type="number" id="mobile"
                                       value="" placeholder="Phone Number"
                                       class="create-account-input create-account-input1 vPhone_verify"
                                       name="mobile"/></strong>
                            <strong class="c_code">
                                <input type="number" name="code"
                                       class="create-account-input " value=""
                                       id="code" placeholder="Code" required/></strong></strong>
{{--                        <strong><label>Phone Number<span class="red">*</span></label></strong>--}}
                            {{--                        <input type="text" id="vPhone" placeholder="Phone Number"--}}
                            {{--                               class="create-account-input create-account-input1" name="mobile"/>--}}
                     </span>
                    </div>
                    <div class="create-account">
                        <p>
                            <button type="submit" class="submit" name="SUBMIT">Submit</button>
                        </p>
                    </div>
                </div>
            </form>
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
                        <p class="help-block">To complete the User registration process, you must have to
                            enter the verification code sent to your registered phone number.</p>
                        <div class="form-group">
                            <label>Enter Verification code below</label>
                            <input class="form-control" type="text" id="otp"/>
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
    <script type="text/javascript" src="{{ asset('frontend/assets/js/validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/assets/js/validation/additional-methods.js') }}"></script>
    <script>
        var errormessage;
        $('#frmsignup').validate({
            ignore: 'input[type=hidden]',
            errorClass: 'help-block error',
            errorElement: 'span',
            errorPlacement: function (error, e) {
                e.parents('.newrow > strong').append(error);
            },
            highlight: function (e) {
                $(e).closest('.newrow').removeClass('has-success has-error').addClass('has-error');
                $(e).closest('.newrow strong input').addClass('has-shadow-error');
                $(e).closest('.help-block').remove();
            },
            success: function (e) {
                e.prev('input').removeClass('has-shadow-error');
                e.closest('.newrow').removeClass('has-success has-error');
                e.closest('.help-block').remove();
                e.closest('.help-inline').remove();
            },
            rules: {
                email: {
                    required: true, email: true
                },
                password: {required: true, noSpace: true, minlength: 6, maxlength: 16},
                phone: {
                    required: true, minlength: 10, digits: true
                },
                first_name: {required: true, minlength: 2, maxlength: 30},
                last_name: {required: true, minlength: 2, maxlength: 30}
            },
            messages: {
                password: {maxlength: 'Please enter less than 16 characters.'},
                'remember-me': {required: 'Please agree to the Terms & Conditions.'},
                phone: {
                    minlength: 'Please enter at least three Number.',
                    digits: 'Please enter proper mobile number.'
                }
            }
        });

        function sendOtp() {
            var number = $('#code').val() + $('#mobile').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('register.send-otp') }}",
                method: 'post',
                data: {
                    number: number
                },
                success: function (result) {
                    if (result.success) {
                        $('#formModal').modal('show');
                    } else {
                        alert(result.message)
                    }
                    console.log(result);
                }
            });
        }

        function verifyOtp() {
            var otp = $('#otp').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('register.verify-otp') }}",
                method: 'post',
                data: {
                    otp: otp
                },
                success: function (result) {
                    if (result.success) {
                        $('#frmsignup').submit();
                    } else {
                        alert(result.message)
                    }
                    console.log(result);
                }
            });
        }

        // $('#verification').bind('keydown', function (e) {
        //     if (e.which == 13) {
        //         check_verification('verify');
        //         return false;
        //     }
        // });
        //
        // function check_verification(request_type) {
        //     if (request_type == 'send') {
        //         code = $("#code").val();
        //     } else {
        //         code = $("#vCode1").val();
        //         if (code == '') {
        //             $("#verification_error").html('<i class="icon icon-remove alert" style="display:inline-block;color:red;padding:0px;">Please enter verification code.</i>');
        //             return false;
        //         }
        //     }
        //     phone = $("#vPhone").val();
        //     email = $("#vEmail").val();
        //     name = $("#vFirstName").val();
        //     name += ' ' + $("#vLastName").val();
        //     //alert(request_type);
        //     var request = $.ajax({
        //         type: "POST",
        //         url: 'ajax_driver_verification.php',
        //         dataType: "json",
        //         data: {
        //             'vPhone': phone,
        //             'vCode': code,
        //             'type': request_type,
        //             'name': name,
        //             'vEmail': email
        //         },
        //         success: function (data) {
        //             console.log(data['code']);
        //             console.log(data['action']);
        //             if (data['type'] == 'send') {
        //                 if (data['action'] == 0) {
        //                     $("#mobileCheck").html('<i class="icon icon-remove alert-danger alert">This mobile number is already registered.</i>');
        //                     $("#mobileCheck").show();
        //                     $('input[type="submit"]').attr('disabled', 'disabled');
        //                     return false;
        //                 } else {
        //                     return true;
        //                 }
        //             } else if (data['type'] == 'verify') {
        //                 if (data['0'] == 1) {
        //                     $("#verification_error").html('');
        //                     document.frmsignup.submit();
        //                 } else if (data['0'] == 0) {
        //                     $("#verification_error").html('');
        //                     $("#verification_error").html('<i class="icon icon-remove alert" style="display:inline-block;color:red;" >Invalid Verification code, please try again.</i>');
        //                 } else {
        //                     $("#verification_error").html('');
        //                     $("#verification_error").html('<i class="icon icon-remove alert" style="display:inline-block;color:red;">Error in verification. please try again.</i>');
        //                 }
        //             }
        //         }
        //     });
        // }
    </script>
    {{--    <script type="text/javascript">--}}
    {{--        $(document).ready(function () {--}}
    {{--            var refcode = $('#vRefCode').val();--}}
    {{--            if (refcode != "") {--}}
    {{--                validate_refercode(refcode);--}}
    {{--            }--}}
    {{--        });--}}

    {{--        function changeCode(id) {--}}
    {{--            var request = $.ajax({--}}
    {{--                type: "POST",--}}
    {{--                url: 'change_code.php',--}}
    {{--                data: 'id=' + id,--}}
    {{--                success: function (data) {--}}
    {{--                    document.getElementById("code").value = data;--}}
    {{--                    //window.location = 'profile.php';--}}
    {{--                }--}}
    {{--            });--}}
    {{--        }--}}

    {{--        function fbconnect() {--}}
    {{--            javscript:window.location = 'fbconnect.html';--}}
    {{--        }--}}


    {{--        function validate_refercode(id) {--}}
    {{--            if (id == "") {--}}
    {{--                return true;--}}
    {{--            } else {--}}
    {{--                var request = $.ajax({--}}
    {{--                    type: "POST",--}}
    {{--                    url: 'ajax_validate_refercode.php',--}}
    {{--                    data: 'refcode=' + id,--}}
    {{--                    success: function (data) {--}}

    {{--                        if (data == 0) {--}}
    {{--                            $("#referCheck").remove();--}}
    {{--                            $(".vRefCode_verify").addClass('required-active');--}}
    {{--                            $('#refercodeCheck').append('<div class="required-label" id="referCheck" >*Refer code Not Found.</div>');--}}
    {{--                            $('#vRefCode').attr("placeholder", "Referral Code (Optional)");--}}
    {{--                            $('#vRefCode').val("");--}}
    {{--                            return false;--}}
    {{--                        } else {--}}
    {{--                            var reponse = data.split('|');--}}
    {{--                            $('#iRefUserId').val(reponse[0]);--}}
    {{--                            $('#eRefType').val(reponse[1]);--}}
    {{--                        }--}}

    {{--                    }--}}
    {{--                });--}}
    {{--            }--}}
    {{--        }--}}

    {{--        function refreshCaptcha() {--}}
    {{--            var img = document.images['captchaimg'];--}}
    {{--            img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000;--}}
    {{--        }--}}

    {{--    </script>--}}
@endsection