<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- Mirrored from ufxforall4.bbcsproducts.com/company-login by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 03 Mar 2019 17:23:12 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!--   <title>CubeServePlus | Login Page</title>-->
    <title></title>
    <!-- Default Top Script and css -->
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <!--<meta content="" name="" />
<meta content="" name="" />-->
    <meta content="" name="author"/>
    <link rel="icon" href="http://cubetaxiplusbeta.bbcsproducts.com/Page-Not-Found" type="image/x-icon">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <!-- PAGE LEVEL STYLES -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/plugins/bootstrap/css/bootstrap.css') }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/sign-up.css') }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/assets/plugins/magic/magic.css') }}"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- Front Css-->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-front.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/plugins/Font-Awesome/css/font-awesome.css') }}"/>

    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js" type="text/javascript"></script> -->
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}" type="text/javascript"></script>

    <!-- <link rel="stylesheet" href="assets/css/design.css">
    <link rel="stylesheet" href="assets/css/style.css">  -->

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/design_v5.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style_v5.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/ufxforall/style_v5_color.css') }}">
    <!--
        <link rel="stylesheet" href="assets/css/style_v5_color-red.css">
     -->
    <!-- <link rel="stylesheet" href="assets/css/style-dd.css">-->

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/fa-icon.css') }}">
    <link href="{{ asset('frontend/assets/css/initcarousel.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/media.css') }}">
    <!--<link rel="stylesheet" href="assets/css/style_theme.css">-->
    <!-- Font CSS-->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,700,300,500,900,800,600,200,100' rel='stylesheet'
          type='text/css'>


    <link rel="stylesheet" href="http://cubetaxiplusbeta.bbcsproducts.com/Page-Not-Found">

    <!-- Default js-->


    <script>
        var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        document.cookie = "vUserDeviceTimeZone=" + timezone;
    </script>
    <!-- End: Default Top Script and css-->
</head>

<body>
<!-- home page -->
<div id="main-uber-page">
    <!-- Left Menu -->
    <span id="shadowbox" onClick="menuClose()"></span>
    <nav>
        <button id="navBtnShow" onClick="menuOpen()">
            <div></div>
            <div></div>
            <div></div>
        </button>
        <ul id="listMenu">
				<span class="desktop">
					<div class="menu-logo">
						<section id="navBtn" class="navBtnNew navOpen" onClick="menuClose()">
							<div></div>
							<div></div>
							<div></div>
						</section>
						<a href="#" class="logo-left signin"><img
                                    style="width: 55%" src="{{ asset('frontend/assets/css/ufxforall/menu-logo.png') }}"
                                    alt=""></a>

					</div>
					<div class="menu-left-new">
						<li><a href="{{ route('providers.dashboard') }}" class="active"><b><img alt=""
                                                                     src="{{ asset('frontend/assets/img/my-profile-icon.png') }}"></b><span>My Profile</span></a></li>
{{--						<li><a href="add_services.php" class=""><b><img alt=""--}}
{{--                                                                        src="{{ asset('frontend/assets/img/my-profile-icon.png') }}"></b><span>My Services</span></a></li>--}}
{{--                        <li><a href="add_availability.php" class=""><b><img alt=""--}}
{{--                                                                            src="{{ asset('frontend/assets/img/my-profile-icon.png') }}"></b><span>My Availability</span></a></li>--}}
{{--						<li><a href="driver-trip" class=""><b><img alt=""--}}
{{--                                                                   src="{{ asset('frontend/assets/img/my-trips.png') }}"></b><span>My Jobs</span></a></li>--}}
{{--						<li><a href="payment-request" class=""><b><img alt=""--}}
{{--                                                                       src="{{ asset('frontend/assets/img/myearnings.png') }}"></b><span>My Earnings</span></a></li>--}}
{{--						<li><a href="driver_wallet" class=""><b><img alt=""--}}
{{--                                                                     src="{{ asset('frontend/assets/img/my-wallet.png') }}"></b><span>My Wallet</span></a></li>--}}
						<li class="logout"><a href="{{ route('providers.logout') }}"><b><img alt=""
                                                                                             src="{{ asset('frontend/assets/img/sign-out.png') }}"></b><span>Logout</span></a></li>
						<div style="clear:both;"></div>
					 </div>
				</span>
            <span class="mobile">
					<div class="menu-logo">
						<section id="navBtn" class="navBtnNew navOpen" onClick="menuClose()">
							<div></div>
							<div></div>
							<div></div>
						</section>
						<img style="width: 55%" src="{{ asset('frontend/assets/img/menu-logo.png') }}" alt="">
					</div>
                <!-- Top Menu Mobile -->
					<div class="menu-left-new">
						<li><a href="{{ route('providers.dashboard') }}" class="active">My Profile</a></li>
{{--						<li><a href="vehicle" class="">Services</a></li>--}}
{{--						<li><a href="driver-trip" class="">My Jobs</a></li>--}}
{{--						<li><a href="payment-request" class="">Payment</a></li>--}}
{{--                        <!-- End Top Menu Mobile -->--}}
{{--						<li><a href="index.php" class="">Home</a></li>--}}
{{--						<li><a href="about-us" class="">About Us</a></li>--}}
{{--						<li><a href="help-center" class="">Help Center</a></li>--}}
{{--						<li><a href="contact-us" class="">Contact Us</a></li>--}}
						<li><a href="{{ route('providers.logout') }}">Logout</a></li>
						<div style="clear:both;"></div>
					 </div>
				</span>
        </ul>
    </nav> <!-- End: Left Menu-->
    <!-- Top Menu -->
    <div id="top-part" class="top-inner-color">
        <div class="top-part-inner">
            <div class="logo">
                <a href="{{ route('providers.dashboard') }}"><img style="width: 45%" src="{{ asset('frontend/assets/css/ufxforall/logo.png') }}" alt=""></a>
                <span class="top-logo-link"><a href="{{ route('providers.dashboard') }}" class="active">My Profile</a><a
                            href="{{ route('providers.logout') }}">Logout</a></span>
            </div>
            <div class="top-link-login-new">
                <div class="user-part-login">
                    <b><img src = "{{ (Auth::guard('provider_web')->user()->image != '') ? Auth::guard('provider_web')->user()->image : 'http://ufxforall4.bbcsproducts.com/webimages/upload/Driver/375/2_1531891800_76874.jpg' }}" style="height:100px;"/></b>
                    <div class="top-link-login">
                        <label><img src="{{ asset('frontend/assets/img/arrow-menu.png') }}" alt=""></label>
                        <ul>
                            <li><a href="{{ route('providers.dashboard') }}" class="active"><i class="fa fa-user" aria-hidden="true"></i>My
                                    Profile</a></li>
                            <li><a href="{{ route('providers.logout') }}"><i class="fa fa-power-off"
                                                                             aria-hidden="true"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- -->
            <div style="clear:both;"></div>
        </div>
    </div>
    <!-- End: Top Menu-->
    <!-- contact page-->
    <div class="page-contant">
        <div class="page-contant-inner">
            @if(count($errors))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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
            <h2 class="header-page-p">Profile</h2>
        {{--            <div class="demo-warning">--}}
        {{--                <p>Thanks for registering as an individual Service Provider.</p>--}}
        {{--                <p>Since this is a Demo Version, Uploading of document is not required. You just have to go online and be available on App to accept a job. Kindly login in the App and become online.</p>--}}
        {{--                <p>However in real system, a Service Provider will need to uplaod documents and get the account validated in-order to be visible on the App as an available Service Provider.</p>--}}
        {{--            </div>--}}
        <!-- profile page -->
            <div class="driver-profile-page">
                <div class="driver-profile-top-part" id="hide-profile-div">
                    <div class="driver-profile-img">
                        <span>
                            <img src = "{{ (Auth::guard('provider_web')->user()->image != '') ? Auth::guard('provider_web')->user()->image : 'http://ufxforall4.bbcsproducts.com/webimages/upload/Driver/375/2_1531891800_76874.jpg' }}" style="height:100px;"/>
{{--                        <img src="http://ufxforall4.bbcsproducts.com/webimages/upload/Driver/375/2_1531891800_76874.jpg"--}}
{{--                             style="height:150px;"/>--}}
                        </span>
                        <b>
                            <a data-toggle="modal" data-target="#uiModal_4"><i class="fa fa-pencil"
                                                                               aria-hidden="true"></i></a>
                        </b>
                    </div>
                    <div class="driver-profile-info">
                        <h3>{{ Auth::guard('provider_web')->user()->first_name }} {{ Auth::guard('provider_web')->user()->last_name }}</h3>
                        <p>{{ Auth::guard('provider_web')->user()->email }}</p>
                        <p>{{ Auth::guard('provider_web')->user()->mobile }}</p>
                        <span><a id="show-edit-profile-div"><i class="fa fa-pencil"
                                                               aria-hidden="true"></i>Edit</a></span>
                    </div>
                </div>
                <!-- form -->
                <div class="edit-profile-detail-form" id="show-edit-profile" style="display: none;">
                    <form id="frm1" method="post" action="{{ route('providers.update') }}">
                        {{ csrf_field() }}
                        <input type="hidden" class="edit" name="action" value="login">
                        <div class="show-edit-profile-part">
                           <span>
                              <label>Enter Your Email Id <span class="red">*</span></label>
                              <input type="email" id="in_email" class="edit-profile-detail-form-input"
                                     placeholder="Enter Your Email Id" value="provider@demo.com" name="email" readonly required>
                               <!--onChange="validate_email(this.value,'')"-->
                              <div class="required-label" id="emailCheck"></div>
                           </span>
                            <span>
                           <label>First Name<span class="red">*</span></label>
                           <input type="text" class="edit-profile-detail-form-input" placeholder="First Name"
                                  value="{{ Auth::guard('provider_web')->user()->first_name }}" name="first_name"
                                  required>
                           </span>
                            <span>
                           <label>Last Name<span class="red">*</span></label>
                           <input type="text" class="edit-profile-detail-form-input" placeholder="Last Name"
                                  value="{{ Auth::guard('provider_web')->user()->last_name }}" name="last_name"
                                  required>
                           </span>
                            <span>
                               <label>Birthday</label>
                               <input type="date" class="edit-profile-detail-form-input"
                                      value="{{ Auth::guard('provider_web')->user()->dob }}" name="dob"
                               >
                               </span>
                            <span>
                              <label>Phone Number<span class="red">*</span></label>
{{--                              <input type="text" class="input-phNumber1" id="code" name="vCode" value="966" readonly >--}}
                              <input name="phone" type="text" value="987654321000"
                                     class="edit-profile-detail-form-input" placeholder="Phone Number"
                                     value="{{ Auth::guard('provider_web')->user()->mobile }}"
                                     title="Please enter proper phone number." readonly required/>
                                <!-- pattern="[0-9]{1,}" -->
                           </span>
                            <span>
                               <label>Work experience</label>
                               <input type="text" class="edit-profile-detail-form-input"
                                      value="{{ Auth::guard('provider_web')->user()->workexperience }}"
                                      name="workexperience"
                               >
                               </span>
                            <span>
                               <label>About</label>
                               <input type="text" class="edit-profile-detail-form-input"
                                      value="{{ Auth::guard('provider_web')->user()->about }}"
                                      name="about"
                               >
                               </span>
                            <span>
                            <p class="save-button11">
                                <input name="save" id="validate_submit" type="submit" value="Save" class="save-but">
                                <!-- onClick="return validate_email_submit('login')" -->
                                <input name="" id="hide-edit-profile-div" type="button" value="Cancel"
                                       class="cancel-but">
                            </p>
                            <div style="clear:both;"></div>
                        </div>
                    </form>
                </div>
                <!-- from -->
                <div class="detail-driver driver-profile-mid-part">
                    <ul>
                        <li class='driver-profile-mid-part-details'>
                            <div class="driver-profile-mid-inner">
                                <div class="profile-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                <h3>Address</h3>
{{--                                <p>Demo</p>--}}
                                <span><a id="show-edit-address-div" class="hide-address-div hidev"><i
                                                class="fa fa-pencil" aria-hidden="true"></i>Edit</a></span>
                            </div>
                        </li>
                        <li class='driver-profile-mid-part-details'>
                            <div class="driver-profile-mid-inner-a">
                                <div class="profile-icon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></div>
                                <h3>Password</h3>
                                <span><a id="show-edit-password-div" class="hide-password-div hidev"><i
                                                class="fa fa-pencil" aria-hidden="true"></i>Edit</a></span>
                            </div>
                        </li>
                        {{--                        <li class='driver-profile-mid-part-details'>--}}
                        {{--                            <div class="driver-profile-mid-inner">--}}
                        {{--                                <div class="profile-icon"><i class="fa fa-language" aria-hidden="true"></i></div>--}}
                        {{--                                <h3>Language</h3>--}}
                        {{--                                <p>English</p>--}}
                        {{--                                <span><a id="show-edit-language-div" class="hide-language-div hidev"><i--}}
                        {{--                                                class="fa fa-pencil" aria-hidden="true"></i>Edit</a></span>--}}
                        {{--                            </div>--}}
                        {{--                        </li>--}}
                        {{--                        <li class='driver-profile-mid-part-details'>--}}
                        {{--                            <div class="driver-profile-mid-inner">--}}
                        {{--                                <div class="profile-icon"><i class="fa fa-bank" aria-hidden="true"></i></div>--}}
                        {{--                                <h3>Bank Details</h3>--}}
                        {{--                                <p></p>--}}
                        {{--                                <span><a id="show-edit-bankdetail-div" class="hide-bankdetail-div hidev"><i--}}
                        {{--                                                class="fa fa-pencil" aria-hidden="true"></i>Edit</a></span>--}}
                        {{--                            </div>--}}
                        {{--                        </li>--}}
                    </ul>
                </div>
                <!-- Address form -->
                <div class="profile-Password showV" id="show-edit-address" style="display: none;">
                    <form id="frm2" method="post" action="{{ route('providers.address-update')}}">
                        {{ csrf_field() }}
                        <p class="address-pointer"><img src="assets/img/pas-img1.jpg" alt=""></p>
                        <h3><i class="fa fa-map-marker" aria-hidden="true"></i>Address</h3>
                        <input type="hidden" class="edit" name="action" value="address">
                        <div class="profile-address-part">
                           <span>
                           <label>Address<span class="red">*</span></label>
                           <input type="text" class="profile-address-input" placeholder="Address 1"
                                  value="{{ Auth::guard('provider_web')->user()->addressline1 }}"
                                  name="address1" required>
                           </span>
                            <span>
                               <label>Address 2</label>
                               <input type="text" class="profile-address-input" placeholder="LINE 2"
                                      value="{{ Auth::guard('provider_web')->user()->addressline2 }}" name="address2"
                                      required></span>

                            <span>
                              <label>State </label>
                              <input type="text" class="profile-address-input" placeholder="State"
                                     value="{{ Auth::guard('provider_web')->user()->state }}" name="state" required>
                           </span>
                            <span>
                              <label>City</label>
                              <input type="text" class="profile-address-input" placeholder="City"
                                     value="{{ Auth::guard('provider_web')->user()->city }}" name="city" required>
                           </span>
                            <!--<span>
                               <label>City</label>
                               <input type="text" class="profile-address-input" placeholder="City 1" value="" name="vCity" required>
                               </span> -->
                            <span>
                           <label>Zip<span class="red">*</span></label>
                           <input type="text" class="profile-address-input" placeholder="ZIP CODE"
                                  value="{{ Auth::guard('provider_web')->user()->zipcode }}"
                                  name="zipcode" required></span>
                        </div>
                        <span>
                        <b>
                        <input name="save" type="submit" value="Save" class="profile-Password-save">
                        <input name="" id="hide-edit-address-div" type="button" value="Cancel"
                               class="profile-Password-cancel">
                        </b>
                        </span>
                        <div style="clear:both;"></div>
                    </form>
                </div>
                <!-- End: Address Form -->
                <!-- Password form -->
                <div class="profile-Password showV" id="show-edit-password" style="display: none;">
                    <form id="frm3" method="post" action="{{ route('providers.change-password') }}" >
                        {{ csrf_field() }}
                        <p class="password-pointer"><img src="assets/img/pas-img1.jpg" alt=""></p>
                        <h3><i class="fa fa-unlock-alt" aria-hidden="true"></i>Password</h3>
                        <div class="row">
{{--                            <div class="col-md-4">--}}
{{--                              <span>--}}
{{--                              <label>Current Password<span class="red">*</span></label>--}}
{{--                              <input type="password" class="input-box" placeholder="Current Password" name="cpass"--}}
{{--                                     id="cpass" minlength="6" required>--}}
{{--                              </span>--}}
{{--                            </div>--}}
                            <div class="col-md-4">
                              <span>
                              <label>New Password<span class="red">*</span> </label>
                              <input type="password" class="input-box" placeholder="New Password" name="password"
                                     id="npass" required>
                              </span>
                            </div>
                            <div class="col-md-4">
                              <span>
                              <label>Confirm New Password<span class="red">*</span></label>
                              <input type="password" class="input-box" placeholder="Confirm New Password" name="password_confirmation"
                                     id="ncpass" required>
                              </span>
                            </div>
                        </div>
                        <span>
                        <b>
                        <input name="save" type="submit" value="Save" class="profile-Password-save">
                        <input name="" id="hide-edit-password-div" type="button" value="Cancel"
                               class="profile-Password-cancel">
                        </b>
                        </span>
                        <div style="clear:both;"></div>
                    </form>
                </div>
                <!-- End: Password Form -->
                <!-- Language form -->
                <div class="profile-Password showV" id="show-edit-language" style="display: none;">
                    <form id="frm4" method="post">
                        <p class="language-pointer"><img src="assets/img/pas-img1.jpg" alt=""></p>
                        <h3><i class="fa fa-language" aria-hidden="true"></i>Language</h3>
                        <input type="hidden" value="lang1" name="action">
                        <div class="edit-profile-detail-form-password-inner profile-language-part">
                           <span>
                              <label>Select Language</label>
                              <select name="lang1" class="custom-select-new profile-language-input">
                                 <option value="AR">Arabic</option>
                                 <option value="EN" selected>English</option>
                                 <option value="FN">French</option>
                                 <option value="DE">German</option>
                                 <option value="PT">Portuguese</option>
                                 <option value="RS">Russian</option>
                                 <option value="ES">Spanish</option>
                              </select>
                           </span>
                        </div>
                        <span>
                        <b>
                        <input name="save" type="button" value="Save" class="profile-Password-save"
                               onClick="editProfile('lang');">
                        <input name="" id="hide-edit-language-div" type="button" value="Cancel"
                               class="profile-Password-cancel">
                        </b>
                        </span>
                        <div style="clear:both;"></div>
                    </form>
                </div>
                <!-- End: Language Form -->
                <!-- bank detail -->
                <div class="profile-Password showV" id="show-edit-bankdeatil" style="display: none;">
                    <form id="frm6" method="post" onsubmit="return editPro('bankdetail')">
                        <p class="bankdeail-pointer"><img src="assets/img/pas-img1.jpg" alt=""></p>
                        <h3><i class="fa fa-bank" aria-hidden="true"></i>Bank Details</h3>
                        <input type="hidden" class="edit" name="action" value="bankdetail">
                        <div class="profile-address-part">
                           <span>
                           <label>Payment Email<span class="red">*</span></label>
                           <input type="email" class="profile-address-input" placeholder="Payment Email" value=""
                                  name="vPaymentEmail" required>
                           </span>
                            <span>
                           <label>Bank Account Holder Name  </label>
                           <input type="text" class="profile-address-input" placeholder="Account Holder Name" value=""
                                  name="vBankAccountHolderName"></span>
                            <span>
                           <label>Account Number</label>
                           <input type="text" class="profile-address-input" placeholder="Account Number" value=""
                                  name="vAccountNumber"></span>
                            <span>
                           <label>Bank Name </label>
                           <input type="text" class="profile-address-input" placeholder="Name of Bank" value=""
                                  name="vBankName"></span>
                            <span>
                           <label>Bank Location</label>
                           <input type="text" class="profile-address-input" placeholder="Bank Location" value=""
                                  name="vBankLocation">
                           </span>
                            <span>
                           <label>BIC/SWIFT Code</label>
                           <input type="text" class="profile-address-input" placeholder="BIC/SWIFT Code" value=""
                                  name="vBIC_SWIFT_Code">
                           </span>
                        </div>
                        <span>
                        <b>
                        <input name="save" type="submit" value="Save" class="profile-Password-save">
                        <input name="" id="hide-edit-bankdetail-div" type="button" value="Cancel"
                               class="profile-Password-cancel">
                        </b>
                        </span>
                        <div style="clear:both;"></div>
                    </form>
                </div>
                <!-- end bank detail -->
                <!-- end bank detail -->
                <div style="display: none;" class="driver-profile-bottom-part required-documents-bottom-part two-part-document">
                    <h3>Required Documents</h3>
                    <div class="profile-req-doc driver-document-action-page">
                        <div class="profile-req-doc-inner pro-required">
                            <div class="panel panel-default upload-clicking">
                                <input type="hidden" id="ex_status" value="no">
                                <div class="panel-heading">
                                    <div>Work Experience Certificate</div>
                                </div>
                                <input type="hidden" id="doc_id" value="">
                                <div class="panel-body">
                                    <label>
                                        <p><a href="Array/375/pdf_20180425050335.pdf" target="_blank">Work Experience
                                                Certificate</a></p>
                                    </label>
                                    <br/>
                                    <b>
                                        <button class="btn btn-info" data-toggle="modal" data-target="#uiModal"
                                                id="custId"
                                        >Work Experience Certificate
                                        </button>
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="modal fade" id="uiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                         aria-hidden="true">
                        <div class="modal-content image-upload-1">
                            <div class="fetched-data"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="modal fade" id="uiModal_4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-content image-upload-1 popup-box3">
                <div class="upload-content">
                    <h4>Profile Picture</h4>
                    <form class="form-horizontal frm9" id="frm9" method="post" enctype="multipart/form-data" action="{{ route('providers.update-profile') }}" name="frm9">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-preview thumbnail" style="height: unset !important;">
                                        <img src = "{{ (Auth::guard('provider_web')->user()->image != '') ? Auth::guard('provider_web')->user()->image : 'http://ufxforall4.bbcsproducts.com/webimages/upload/Driver/375/2_1531891800_76874.jpg' }}" style="height:100px;"/>
                                    </div>
                                    <div style="margin-top: 25px;">
                                        {{--                                    <span class="btn btn-file btn-success"><span class="fileupload-new">Upload Photo</span><span class="fileupload-exists">Change</span>--}}
                                        <input type="file" name="image"/>
                                        {{--                                    <input type="hidden" name="photo_hidden"  id="photo" value="1531891800_76874.jpg" />--}}
                                        {{--                                    </span>--}}
                                        {{--                                        <a href="#" class="btn btn-danger" id="cancel-btn" data-dismiss="fileupload">X</a>--}}
                                    </div>
                                    {{--                                    <div class="upload-error"><span class="file_error"></span></div>--}}
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="save" name="save" value="Save"><input type="button" class="cancel" data-dismiss="modal" name="cancel" value="Cancel">
                    </form>
                    <div style="clear:both;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-content-profile">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="H2">Note for Demo</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" name="verification" id="verification">
                            <p>Thanks for registering as an individual Service Provider.</p>
                            <p>Since this is a Demo Version, Uploading of document is not required. You just have to go
                                online and be available on App to accept a job. Kindly login in the App and become
                                online.</p>
                            <p>However in real system, a Service Provider will need to uplaod documents and get the
                                account validated in-order to be visible on the App as an available Service
                                Provider.</p>
                            <div class="form-group">
                            </div>
                            <p class="help-block" id="verification_error"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer part -->
    <div class="footer">
        <div class="footer-top-part">
            <div class="footer-inner">
                <div class="footer-box1">
{{--                    <div class="lang" id="lang_open">--}}
{{--                        <b><a href="javascript:void(0);">SELECT YOUR LANGUAGE</a></b>--}}
{{--                    </div>--}}
{{--                    <div class="lang-all" id="lang_box">--}}
{{--                        <ul>--}}
{{--                            <li onclick="change_lang(this.id);" id="EN"><a href="javascript:void(0);"--}}
{{--                                                                           class="active">English</a></li>--}}
{{--                            <li onclick="change_lang(this.id);" id="FN"><a href="javascript:void(0);"--}}
{{--                                                                           class="">French</a></li>--}}
{{--                            <li onclick="change_lang(this.id);" id="DE"><a href="javascript:void(0);"--}}
{{--                                                                           class="">German</a></li>--}}
{{--                            <li onclick="change_lang(this.id);" id="RS"><a href="javascript:void(0);"--}}
{{--                                                                           class="">Russian</a></li>--}}
{{--                            <li onclick="change_lang(this.id);" id="ES"><a href="javascript:void(0);"--}}
{{--                                                                           class="">Spanish</a></li>--}}
{{--                            <li onclick="change_lang(this.id);" id="AR"><a href="javascript:void(0);"--}}
{{--                                                                           class="">Arabic</a></li>--}}
{{--                            <li onclick="change_lang(this.id);" id="PT"><a href="javascript:void(0);"--}}
{{--                                                                           class="">Portuguese</a></li>--}}

{{--                            <!--  <li><a href="contact-us" >Can't find your language? Contact Us</a></li> -->--}}
{{--                        </ul>--}}
{{--                    </div>--}}
                    <span>
							<a href="https://www.facebook.com/v3cube" target="_blank"><i class="fa fa-facebook"></i></a>
							<a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
							<a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
							<a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
						</span>

                </div>
                <div class="footer-box2">
                    <ul>
                        <li><a href="how-it-works.html">How it Work</a></li>
                        <li><a href="trust-safty-insurance.html">Trust Safety & Insurance</a></li>
                        <li><a href="terms-condition.html">Terms & Conditions</a></li>
                        <li><a href="faq.html">Faq</a></li>
                        <li><a href="privacy-policy.html">Privacy Policy</a></li>
                    </ul>
                    <ul>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="contact-us.html">Contact Us</a></li>
                        <li><a href="help-center.html">Help Center</a></li>
                        <li><a href="legal.html">Legal</a></li>
                    </ul>
                </div>
                <div class="footer-box3">
						<span>
							<a href="https://itunes.apple.com/us/app/v3cube-service-provider-v4-1/id1290188778?mt=8"
                               target="_blank"><img src="{{ asset('frontend/assets/img/app-stor-img.png') }}"
                                                    alt=""></a>
						</span>
                    <span>
							<a href="https://play.google.com/store/apps/details?id=com.cubeplus.provider"
                               target="_blank"><img src="{{ asset('frontend/assets/img/google-play-img.png') }}" alt=""></a>
						</span>
                </div>
                <div style="clear:both;"></div>
            </div>
        </div>
        <div class="footer-bottom-part">
            <div class="footer-inner">
            {{--<span>&copy; Copyright 2017 @ CubeServePlus</span>--}}
            <!--<p>Website Design & Developed by: <a href="http://v3cube.com" target="_blank">v3cube.com</a></p>-->
            </div>
            <div style=" clear:both;"></div>
        </div>
    </div>
    <script>
        function change_lang(lang) {
            document.location = 'common415a.html?lang=' + lang;
        }
    </script>


    <script type="text/javascript">
        $(document).ready(function () {
            $(".custom-select-new1").each(function () {
                var selectedOption = $(this).find(":selected").text();
                $(this).wrap("<em class='select-wrapper'></em>");
                $(this).after("<em class='holder'>" + selectedOption + "</em>");
            });
            $(".custom-select-new1").change(function () {
                var selectedOption = $(this).find(":selected").text();
                $(this).next(".holder").text(selectedOption);
            });
            $("#lang_box").hide();
            $("#lang_open").click(function () {
                $("#lang_box").slideToggle();
            });

            $('html').click(function (e) {
                $('#lang_box').hide();
            });

            $('#lang_open').click(function (e) {
                e.stopPropagation();
            });

        })
    </script>
    <!-- footer part end -->
    <!-- -->
    <div style="clear:both;"></div>
</div>
<!-- home page end-->
<!-- Footer Script -->
<!-- Custome JS -->
<script src="{{ asset('frontend/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/bootbox.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/magic.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".custom-select-new").each(function () {
            $(this).wrap("<em class='select-wrapper'></em>");
            $(this).after("<em class='holder'></em>");
        });
        $(".custom-select-new").change(function () {
            var selectedOption = $(this).find(":selected").text();
            $(this).next(".holder").text(selectedOption);
        }).trigger('change');

        $(".label-i").on('click', function (e) {
            var lang_id = $(this).data('id');
            var from = $(this).data('value');
            $.ajax({
                type: "POST",
                url: 'language_popup.php',
                data: 'lang_id=' + lang_id + '&from=' + from,
                success: function (dataHtml) {
                    $("#lang_popup").html(dataHtml);
                    $("#myModalHorizontal").modal('show');
                },
                error: function (dataHtml) {

                }
            });
            e.stopPropagation();
            return false;
        });
    });

    function updateLanguage() {
        var formdata = $("#_languages_form").serialize();
        $.ajax({
            type: "POST",
            url: 'language_save.php',
            data: formdata,
            success: function (dataHtml) {
                location.reload();
            },
            error: function (dataHtml) {

            }
        });
    }

</script>

<!-- Modal -->
<div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Language Label</h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body" id="lang_popup">

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateLanguage();">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<!-- End: Footer Script -->
<!-- <script>

    function change_heading(type) {
        $('.error-login-v').hide();
        if (type == 'forgot') {

            $('#frmforget').show();
            $('#login_box').hide();
            $('#label-id').text("Forgot Password");
        }
        else {
            $('#frmforget').hide();
            $('#login_box').show();
            $('#label-id').text("LOG IN");
        }
    }
    function chkValid(login_type) {
        var id = document.getElementById("vEmail").value;
        var pass = document.getElementById("vPassword").value;
        if (id == '' || pass == '') {
            document.getElementById("errmsg").innerHTML = 'Please enter Email Id and/or password.';
            document.getElementById("errmsg").style.display = '';
            return false;
        }
        else {
            var request = $.ajax({
                type: "POST",
                url: 'ajax_login_action.php',
                data: $("#login_box").serialize(),

                success: function (data) {
                    if (data == 1) {
                        document.getElementById("errmsg").innerHTML = 'Your account seems to be deleted. Please contact administrator.';
                        document.getElementById("errmsg").style.display = '';
                        return false;
                    }
                    else if (data == 2) {
                        document.getElementById("errmsg").style.display = 'none';
                        departType = '';
                        if (login_type == 'rider' && departType == 'mobi')
                            window.location = "http://cubetaxiplusbeta.bbcsproducts.com/Page-Not-Found";
                        else if (login_type == 'rider')
                            window.location = "sign-in-2.html";
                        else if (login_type == 'driver')
                            window.location = "sign-in-2.html";

                        return true; // success registration
                    }
                    else if (data == 3) {
                        document.getElementById("errmsg").innerHTML = 'Invalid Email/Mobile or Password';
                        document.getElementById("errmsg").style.display = '';
                        return false;

                    } else if (data == 4) {
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

            request.fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
                return false;
            });
            return false;
        }
    }
    function forgotPass() {
        $('.error-login-v').hide();
        var site_type = 'Demo';
        var id = document.getElementById("femail").value;
        if (id == '') {
            document.getElementById("errmsg").style.display = '';
            document.getElementById("errmsg").innerHTML = 'Please enter correct email address.';
        }
        else {
            var request = $.ajax({
                type: "POST",
                url: 'ajax_fpass_action.php',
                data: $("#frmforget").serialize(),
                dataType: 'json',
                beforeSend: function () {
                    //alert(id);
                },
                success: function (data) {

                    if (data.status == 1) {
                        change_heading('login');
                        document.getElementById("success").innerHTML = data.msg;
                        document.getElementById("success").style.display = '';

                    }
                    else {
                        document.getElementById("errmsg").innerHTML = data.msg;
                        document.getElementById("errmsg").style.display = '';
                    }

                }
            });

            request.fail(function (jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            });


        }
        return false;
    }

    function fbconnect() {
        javscript: window.location = 'fbconnect.html';
    }

    $(document).ready(function () {
        var err_msg = '';
        // alert(err_msg);
        if (err_msg != "") {
            document.getElementById("errmsg").innerHTML = err_msg;
            document.getElementById("errmsg").style.display = '';
            return false;
        }
    });
</script>  -->
<script>
    $(document).ready(function () {
        $("#show-edit-profile-div").click(function () {
            $("#hide-profile-div").hide();
            $("#show-edit-profile").show();
        });
        $("#hide-edit-profile-div").click(function () {
            $("#show-edit-profile").hide();
            $("#hide-profile-div").show();
            $("#frm1")[0].reset();
            var selectedOption = $('.custom-select-new.vCountry').find(":selected").text();
            var selectedOption1 = $('.custom-select-new.vCurrencyDriver').find(":selected").text();
            if (selectedOption != "" || selectedOption1 != "") {
                $('.custom-select-new.vCountry').next(".holder").text(selectedOption);
                $('.custom-select-new.vCurrencyDriver').next(".holder").text(selectedOption1);
            }
        });
        // address form
        $("#show-edit-address-div").click(function () {
            $('.hidev').show();
            $('.showV').hide();
            $(".hide-address-div").hide();
            $("#show-edit-address").show(300);
        });
        $("#hide-edit-address-div").click(function () {
            $('.hidev').show();
            $('.showV').hide();
            $("#show-edit-address").hide();
            $(".hide-address-div").show();
            $("#frm2")[0].reset();
            var selectedOption = $('#vCountry').find(":selected").text();
            var selectedOption1 = $('#vState').find(":selected").text();
            var selectedOption2 = $('#vCity').find(":selected").text();
            if (selectedOption != "" || selectedOption1 != "" || selectedOption2 != "") {
                $('#vCountry').next(".holder").text(selectedOption);
                $('#vState').next(".holder").text(selectedOption1);
                $('#vCity').next(".holder").text(selectedOption2);
            }
        });
        // end address form
        // Password form
        $("#show-edit-password-div").click(function () {
            $('.hidev').show();
            $('.showV').hide();
            $(".hide-password-div").hide();
            $("#show-edit-password").show(300);
        });
        $("#hide-edit-password-div").click(function () {
            $('.hidev').show();
            $('.showV').hide();
            $("#show-edit-password").hide();
            $(".hide-password-div").show();
            $("#frm3")[0].reset();
        });
        //end password form
        //language form
        $("#show-edit-language-div").click(function () {
            $('.hidev').show();
            $('.showV').hide();
            $(".hide-language-div").hide();
            $("#show-edit-language").show(300);
        });
        $("#hide-edit-language-div").click(function () {
            $('.hidev').show();
            $('.showV').hide();
            $("#show-edit-language").hide();
            $(".hide-language-div").show();
            $("#frm4")[0].reset();
            var selectedOption = $('.profile-language-input').find(":selected").text();
            if (selectedOption != "") {
                $('.profile-language-input').next(".holder").text(selectedOption);
            }
        });
        //end language form
        //Bank Details  form
        $("#show-edit-bankdetail-div").click(function () {
            $('.hidev').show();
            $('.showV').hide();
            $(".hide-bankdetail-div").hide();
            $("#show-edit-bankdeatil").show(300);
        });
        $("#hide-edit-bankdetail-div").click(function () {
            $('.hidev').show();
            $('.showV').hide();
            $("#show-edit-bankdeatil").hide();
            $(".hide-bankdetail-div").show();
            $("#frm6")[0].reset();
        });
        //end bank detail form

        var user = 'Demo';
        if (user == 'Demo') {
            var a = '';
            if (a != undefined && a != '') {
                $('#formModal').modal('show');
            }
            //$('#formModal').modal('show');
        }

        $('[data-toggle="tooltip"]').tooltip();

        $('#cancel-btn').on('click', function () {
            $('#photo').val('');
        });


        //  Work Experience Certificate	 modal
        function setModel001(idVal) {
            // $('#uiModal').on('show.bs.modal', function (e) {
            // var rowid = $(e.relatedTarget).data('id');
            var id = '375';
            var user = 'driver';

            $.ajax({
                type: 'post',
                url: 'driver_document_fetch.php', //Here you will fetch records
                data: 'rowid=' + idVal + '-' + id + '-' + user, //Pass $id
                success: function (data) {
                    $('#uiModal').modal('show');
                    $('.fetched-data').html(data);//Show fetched data from database
                }
            });
        }


    });
</script>
</body>

<!-- Mirrored from ufxforall4.bbcsproducts.com/company-login by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 03 Mar 2019 17:23:20 GMT -->

</html>