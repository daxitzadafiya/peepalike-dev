<!-- footer part -->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5f148d97a45e787d128bbb5e/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div  style="background-color: rgba(30, 67, 86, 1);width:100vw;margin-left:-10px;">
    <div class="footer-top-part" style="background:rgba(30, 67, 86, 1);margin:0;padding:15px;">
        <div class="footer-inner" style="background:rgba(30, 67, 86, 1)">
            <div class="footer-box1" >
    <center>
                <span id="media-icons" style="padding:5px;width:33%;display:flex;justify-content:space-evenly;align-content:center;">
            <a href="https://www.facebook.com/taskmate" target="_blank"><i class="fa fa-facebook" style="font-size:16px;color:#fff;"></i></a>
            <a href="https://twitter.com/taskmate8" target="_blank"><i class="fa fa-twitter" style="font-size:16px;color:#fff;"></i></a>
            <a href="https://www.linkedin.com/company/taskmate" target="_blank"><i class="fa fa-linkedin" style="font-size:16px;color:#fff;"></i></a>
            <a href="https://www.instagram.com/taskmate_" target="_blank"><i class="fa fa-instagram" style="font-size:16px;color:#fff;"></i></a>
            </span>
            </center>
            <br>
            </div>
            <div class="footer-box2" style="display:flex;justify-content:space-evenly;">
                <ul style="list-style:none !important;">
                    <li><a href="{{ route('how-it-works') }}">How it Work</a></li>
                    <li><a href="{{ route('trust') }}">Trust Safety & Insurance</a></li>
                    <li><a href="{{ route('terms') }}">Terms & Conditions</a></li>
                    <li><a href="{{ route('faq') }}">Faq</a></li>
                    <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                </ul>
                <ul style="list-style:none !important;">
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    <li><a href="{{ route('help') }}">Help Center</a></li>
                    <li><a href="{{ route('legal') }}">Legal</a></li>
                </ul>
            </div><br>
            <center>
            <div class="footer-box3">
            <span>
            <a href="" ><img src="{{ asset('frontend/assets/img/app-stor-img.png') }}" alt=""></a>
            </span>
            
              <span>
            <a href="https://play.google.com/store/apps/details?id=com.kennedy.TaskMateUser" ><img src="{{ asset('frontend/assets/img/google-play-img.png') }}" alt=""></a>
            </span>
            </center>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
    <div class="footer-bottom-part" style="background:rgba(30, 67, 86, 1)">
        <div class="footer-inner">
            <span style="width:100%;text-align:center;font-size:13px;">&copy; Copyright {{ date('Y') }} @ TaskMate</span>
        </div>
        <div style=" clear:both;"></div>
    </div>
</div>
<div style="clear:both;"></div>
</div>

<style>
    ul li a{
        color:#fff;
        background-image:none !important;
    }
    .header-page,.header-page-ab,.header-page-c,.header-page-d,.header-page-e,.header-page-f,.header-page-g,.header-page-h{
        color:#105a80;
    }
    .header-page::before,.header-page-ab::before{
        background:#105a80;
    }
    button,input[type='submit']{
              background:#105a80 !important;
              border-color:#105a80 !important;
          }

    .head-p{
        font-size:13px;
    }
    @media only screen and (max-width:800px){
        .footer-box2{
            flex-direction:column !important;
            
            justify-content:center !important;
        }
        #media-icons{
            width:80%;
        }
    }
</style>
<!-- footer part end -->