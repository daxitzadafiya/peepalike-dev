@extends('frontend.layout.app')

@section('content')
    <div class="page-contant">
        <div class="page-contant-inner">
            <h2 class="header-page-f">FAQ</h2>
            <!-- contact page -->
            <div class="faq-page">
                <div class="faq-top-part">
                    <ul>
                        <li class="Active" >
                            <a href="javascript:void(0);" onClick="getFaqs('General',3)">General</a>
                        </li>
                        <li >
                            <a href="javascript:void(0);" onClick="getFaqs('Service Provider',1)">Service Provider</a>
                        </li>
                        <li >
                            <a href="javascript:void(0);" onClick="getFaqs('User',2)">User</a>
                        </li>
                        <li >
                            <a href="javascript:void(0);" onClick="getFaqs('123',4)">123</a>
                        </li>
                    </ul>
                </div>
                <div class="faq-bottom-part" id='cssmenu'>
                    <ul>
                        <li class='has-sub'>
                            <a href="#" class="faq-q">
                     <span>
                        <b>Q.</b>
                        <h3>How it works?</h3>
                     </span>
                            </a>
                            <ul class="faq-ans"  style="display:none">
                                <li id="faq_3">
                        <span>  Login to the User application and select appropriate service.
                        You will get the list of service providers to chose and send the job request.
                        Provider will accept your request and complete the job by coming to your job place.</span>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div style="clear:both;"></div>
        </div>
        <form name="faq" id="faq" action="#">
            <input type="hidden" name="id" id="iUniqueId"  value="">
            <input type="hidden" name="type" id="CatName"  value="">
        </form>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function FacdeQuestion(id) {
            if ($("#faq_" + id).is(":visible")) {
                $("#faq_" + id).slideToggle("slow");
            } else {
                $("#faq_" + id).slideToggle("slow");
            }
        }

        function getFaqs(cat, id) {
            //alert(cat+" "+id);
            $("#iUniqueId").val(id);
            $("#CatName").val(cat);
            document.faq.submit();
        }
    </script>
@endsection