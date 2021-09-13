@extends('frontend.layout.app')

@section('content')
    <div class="page-contant">
        <div class="page-contant-inner">
            <h2 class="header-page-ab">Contact Us
            </h2>

            <p class="head-p">Welcome to CubeServePlus, the easiest to get around at the tap of a button.</p>
            <!-- contact page -->
            <div style="clear:both;"></div>
            <div style="clear:both;"></div>
            <form name="frmsignup" id="frmsignup" method="post" action="#">
                <div class="contact-form">

                    <b>
                        <span class="newrow"><strong><input type="text" name="vName" placeholder="First Name"
                                                            class="contact-input " value=""/></strong></span>
                        <span class="newrow"><strong><input type="text" name="vLastName" placeholder="Last Name"
                                                            class="contact-input " value=""/></strong></span>
                        <span class="newrow"><strong><input type="text" placeholder="Email" name="vEmail" value=""
                                                            autocomplete="off" class="contact-input "/></strong></span>
                        <span class="newrow"><strong><input type="text" placeholder="Phone Number" name="vPhone"
                                                            class="contact-input "/></strong></span>
                    </b>
                    <b>
                        <span class="newrow"><strong><input type="text" name="vSubject" placeholder="Enter subject here"
                                                            class="contact-input "/></strong></span>
                        <span class="newrow"><strong><textarea cols="61" rows="5" placeholder="Please enter details"
                                                               name="vDetail"
                                                               class="contact-textarea "></textarea></strong></span>
                    </b>
                    <b>
                        <input type="submit" class="submit-but" value="Submit" name="SUBMIT"/>
                    </b>
                </div>
            </form>
            <div style="clear:both;"></div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('frontend/assets/js/validation/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/assets/js/validation/additional-methods.js') }}"></script>
    <script type="text/javascript">

        $('#frmsignup').validate({
            ignore: 'input[type=hidden]',
            errorClass: 'help-block',
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
                vName: {required: true},
                vLastName: {required: true},
                vSubject: {required: true},
                vDetail: {required: true},
                vEmail: {required: true, email: true},
                vPassword: {required: true, minlength: 6},
                vPhone: {required: true, phonevalidate: true}
            },
            messages: {
                vPhone: {phonevalidate: 'Please enter a valid phone number.'}
            }
        });

    </script>
    <script>
        function submit_form() {
            if (validatrix()) {
                //alert("Submit Form");
                document.frmsignup.submit();
            } else {
                console.log("Some fields are required");
                return false;
            }
            return false; //Prevent form submition
        }
    </script>
    <script type="text/javascript">
        function validate_email(id) {
            var eml = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            result = eml.test(id);
            if (result == true) {
                $('#emailCheck').html('<i class="icon icon-ok alert-success alert"> Valid</i>');
                $('input[type="submit"]').removeAttr('disabled');
            } else {
                $('#emailCheck').html('<i class="icon icon-remove alert-danger alert"> Enter Proper Email</i>');
                $('input[type="submit"]').attr('disabled', 'disabled');
                return false;
            }
        }

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

        function validate_mobile(mobile) {
            var eml = /^[0-9]+$/;
            result = eml.test(mobile);
            if (result == true) {
                $('#mobileCheck').html('<i class="icon icon-ok alert-success alert"> Valid</i>');
                $('input[type="submit"]').removeAttr('disabled');
            } else {
                $('#mobileCheck').html('<i class="icon icon-remove alert-danger alert"> Enter Proper Mobile No</i>');
                $('input[type="submit"]').attr('disabled', 'disabled');
                return false;
            }
        }
    </script>
@endsection