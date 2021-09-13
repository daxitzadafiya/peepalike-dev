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
            <h2 class="header-page-sinu trip-detail">SIGN UP
            </h2>
            <p>Tell us a bit about yourself</p>
            <!-- trips detail page -->
            <form name="frmsignup" id="frmsignup" method="post"
                  action="{{ route('provider.signup') }}">
                {{ csrf_field() }}
                <div class="driver-signup-page">
                    <div class="create-account">
                        <h3>Create an Account</h3>
                        <span class="newrow">
               <strong id="emailCheck"><label>Email Id <span class="red">*</span> </label>
               <input type="text" Required placeholder="name@email.com" name="email" class="create-account-input "
                      id="vEmail_verify" value=""/></strong>
               <strong><label>Password <span class="red">*</span> </label>
               <input id="pass" type="password" name="password" placeholder="Password"
                      class="create-account-input create-account-input1 " required value=""/></strong>
               </span>
                        <span>
               </span>
                    </div>
                    <div class="create-account">
                        <h3 class="driver">Service Provider Information</h3>
                        <span class="driver newrow">
               <strong><label>First Name <span class="red">*</span> </label>
               <input name="first_name" type="text" class="create-account-input" placeholder="First Name"
                      id="vFirstName" value="" required/></strong>
               <strong><label>Last Name <span class="red">*</span> </label>
               <input name="last_name" type="text" class="create-account-input create-account-input1"
                      placeholder="Last Name" id="vLastName" value="" required/></strong>
               </span>
                        <span class="newrow">
               <strong><label>Address Line 1<span class="red">*</span> </label>
               <input name="address1" type="text" class="create-account-input" placeholder="Address line 1"
                      value="" required/></strong>
               <strong><label>Address Line 2<span class="red">*</span> </label>
               <input name="address2" type="text" class="create-account-input" placeholder="Address line 2"
                      value="" required/></strong>
               </span>
                        <span class="newrow">
               <strong><label>Zip Code<span class="red">*</span></label>
               <input name="zipcode" type="text" class="create-account-input create-account-input1" placeholder="Zip Code"
                      value="" required/></strong>
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
                        <span class="newrow">
               <strong><label>City *<span class="red">*</span></label>
               <input name="city" type="text" class="create-account-input create-account-input1" placeholder="City"
                      value="" required/></strong>
                            <strong><label>State *<span class="red">*</span></label>
               <input name="state" type="text" class="create-account-input create-account-input1" placeholder="State"
                      value="" required/></strong>
               </span>
                        <p>
                            <button type="submit" class="submit" name="SUBMIT">Submit</button>
                        </p>
                    </div>
                </div>
            </form>
            <div class="col-lg-12">
                <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                                </button>
                                <h4 class="modal-title" id="H2">Phone Verification</h4>
                            </div>
                            <div class="modal-body">
                                <form role="form" name="verification" id="verification">
                                    <p class="help-block">To complete the Service Provider registration process, you
                                        must have to enter the verification code sent to your registered phone
                                        number.
                                    </p>
                                    <div class="form-group">
                                        <label>Enter Verification code below</label>
                                        <input class="form-control" type="text" id="vCode1"/>
                                    </div>
                                    <p class="help-block" id="verification_error"></p>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onClick="check_verification('verify')">
                                    Verify
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- -->
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('frontend/assets/js/validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/assets/js/validation/additional-methods.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var refcode = $('#vRefCode').val();
            if (refcode != "") {
                validate_refercode(refcode);
            }
        });

        function show_company(user) {
            $("input[type=hidden][name=userType]").val(user);
            if (user == 'company') {
                $(".company").show();
                $(".driver").hide();
                /*$("#li_dob").hide();*/
                $("#vRefCode").hide();
                $('#div-phone').show();
            } else if (user == 'driver') {
                $(".company").hide();
                $(".driver").show();
                /* $("#li_dob").show();*/
                $("#vRefCode").show();
                $('#div-phone').hide();
            }
        }

        var errormessage;
        $('#frmsignup').validate({
            ignore: 'input[type=hidden]',
            errorClass: 'help-block error',
            onkeypress: true,
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
                vEmail: {
                    required: true, email: true,
                    remote: {
                        url: 'ajax_validate_email_new.php',
                        type: "post",
                        data: {
                            iDriverId: '',
                            usertype: function (e) {
                                return $('input[name=userType]').val();
                            }
                        },
                        dataFilter: function (response) {
                            //response = $.parseJSON(response);
                            if (response == 'deleted') {
                                errormessage = "Account associated with this email address is deleted. Please contact admin to active again.";
                                return false;
                            } else if (response == 'false') {
                                errormessage = "Email address is already exists.";
                                return false;
                            } else {
                                return true;
                            }
                        },
                    }
                },
                vPassword: {required: true, noSpace: true, minlength: 6, maxlength: 16},
                vPhone: {
                    required: true, minlength: 3, digits: true,
                    remote: {
                        url: 'ajax_driver_mobile_new.php',
                        type: "post",
                        data: {
                            iDriverId: '',
                            usertype: function (e) {
                                return $('input[name=userType]').val();
                            }
                        },
                    }
                },
                vCompany: {
                    required: function (e) {
                        return $('input[name=user_type]:checked').val() == 'company';
                    }, minlength: function (e) {
                        if ($('input[name=user_type]:checked').val() == 'company') {
                            return 2;
                        } else {
                            return false;
                        }
                    }, maxlength: function (e) {
                        if ($('input[name=user_type]:checked').val() == 'company') {
                            return 30;
                        } else {
                            return false;
                        }
                    }
                },
                vFirstName: {
                    required: function (e) {
                        return $('input[name=user_type]:checked').val() == 'driver';
                    }, minlength: function (e) {
                        if ($('input[name=user_type]:checked').val() == 'driver') {
                            return 2;
                        } else {
                            return false;
                        }
                    }, maxlength: function (e) {
                        if ($('input[name=user_type]:checked').val() == 'driver') {
                            return 30;
                        } else {
                            return false;
                        }
                    }
                },
                vLastName: {
                    required: function (e) {
                        return $('input[name=user_type]:checked').val() == 'driver';
                    }, minlength: function (e) {
                        if ($('input[name=user_type]:checked').val() == 'driver') {
                            return 2;
                        } else {
                            return false;
                        }
                    }, maxlength: function (e) {
                        if ($('input[name=user_type]:checked').val() == 'driver') {
                            return 30;
                        } else {
                            return false;
                        }
                    }
                },
                vCaddress: {required: true, minlength: 2},
                //vCity: {required: true},
                vZip: {required: true},
                // eGender: {required: true},
                POST_CAPTCHA: {
                    required: true, remote: {
                        url: 'ajax_captcha_new.php',
                        type: "post",
                        data: {iDriverId: ''},
                    }
                },
                'remember-me': {required: true},
            },
            messages: {
                vPassword: {maxlength: 'Please enter less than 16 characters.'},
                vEmail: {
                    remote: function () {
                        return errormessage;
                    }
                },
                'remember-me': {required: 'Please agree to the Terms & Conditions.'},
                vPhone: {
                    minlength: 'Please enter at least three Number.',
                    digits: 'Please enter proper mobile number.',
                    remote: 'Phone Number is already exists.'
                },
                vCompany: {
                    required: 'Company Name is required.',
                    minlength: 'Company Name at least 2 characters long.',
                    maxlength: 'Please enter less than 30 characters.'
                },
                vFirstName: {
                    required: 'First Name is required.',
                    minlength: 'First Name at least 2 characters long.',
                    maxlength: 'Please enter less than 30 characters.'
                },
                vLastName: {
                    required: 'Last Name is required.',
                    minlength: 'Last Name at least 2 characters long.',
                    maxlength: 'Please enter less than 30 characters.'
                },
                POST_CAPTCHA: {remote: 'Captcha did not match'}
            }
        });


        $('#verification').bind('keydown', function (e) {
            if (e.which == 13) {
                check_verification('verify');
                return false;
            }
        });


        function changeCode(id) {
            var request = $.ajax({
                type: "POST",
                url: 'change_code.php',
                data: 'id=' + id,
                success: function (data) {
                    document.getElementById("code").value = data;
                    //window.location = 'profile.php';
                }
            });
        }

        /*ajax for unique username*/

        $(document).ready(function () {
            jQuery.validator.addMethod("noSpace", function (value, element) {
                return value.indexOf(" ") < 0 && value != "";
            }, "Password should not contain whitespace");
            $("#company").hide();
            $("#radio_1").prop("checked", true)
            $("#company_name").removeClass("required");
            show_company('driver');

            var newUser = $("input[name=user_type]:checked").val();
            $("input[type=hidden][name=userType]").val(newUser);
            if (newUser == 'company') {
                $(".company").show();
                $(".driver").hide();
                /*$("#li_dob").hide();*/
                $("#vRefCode").hide();
                $('#div-phone').show();
            } else if (newUser == 'driver') {
                $(".company").hide();
                $(".driver").show();
                /*$("#li_dob").show();*/
                $("#vRefCode").show();
                $('#div-phone').hide();
            }

        });

        function validate_refercode(id) {

            if (id == "") {
                return true;
            } else {
                var request = $.ajax({
                    type: "POST",
                    url: 'ajax_validate_refercode.php',
                    data: 'refcode=' + id,
                    success: function (data) {
                        if (data == 0) {
                            $("#referCheck").remove();
                            $(".vRefCode_verify").addClass('required-active');
                            $('#refercodeCheck').append('<div class="required-label" id="referCheck" >* Refer code Not Found.</div>');
                            $('#vRefCode').attr("placeholder", "Referral Code (Optional)");
                            $('#vRefCode').val("");
                            return false;
                        } else {
                            var reponse = data.split('|');
                            $('#iRefUserId').val(reponse[0]);
                            $('#eRefType').val(reponse[1]);
                        }
                    }
                });

            }

        }

        function refreshCaptcha() {
            var img = document.images['captchaimg'];
            img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000;
        }

        function setState(id, selected) {
            changeCode(id);

            var fromMod = 'driver';
            var request = $.ajax({
                type: "POST",
                url: 'change_stateCity.php',
                data: {countryId: id, selected: selected, fromMod: fromMod},
                success: function (dataHtml) {
                    $("#vState").html(dataHtml);
                    if (selected == '')
                        setCity('', selected);
                }
            });
        }

        function setCity(id, selected) {
            var fromMod = 'driver';
            var request = $.ajax({
                type: "POST",
                url: 'change_stateCity.php',
                data: {stateId: id, selected: selected, fromMod: fromMod},
                success: function (dataHtml) {
                    $("#vCity").html(dataHtml);
                }
            });
        }
    </script>
@endsection