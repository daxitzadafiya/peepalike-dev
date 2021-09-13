<!-- footer part -->
<div  style="background-color: rgba(30, 67, 86, 1);width:100vw;margin-left:-10px;">
    <div class="footer-top-part" style="background:rgba(30, 67, 86, 1);margin:0;padding:15px;">
        <div class="footer-inner" style="background:rgba(30, 67, 86, 1)">
            <div class="footer-box1" >

                <span>
            <a href="https://www.facebook.com/Readiwork" target="_blank"><i class="fa fa-facebook" style="font-size:16px;"></i></a>
            <a href="https://twitter.com/Readiwork8" target="_blank"><i class="fa fa-twitter" style="font-size:16px;"></i></a>
            <a href="https://www.linkedin.com/company/Readiwork" target="_blank"><i class="fa fa-linkedin" style="font-size:16px;"></i></a>
            <a href="https://www.instagram.com/Readiwork_" target="_blank"><i class="fa fa-instagram" style="font-size:16px;"></i></a>
            </span>
            </div>
            <div class="footer-box2">
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
            <div class="footer-box3">
            <span>
            <a href="" ><img src="{{ asset('frontend/assets/img/app-stor-img.png') }}" alt=""></a>
            </span>
            
              <span>
            <a href="https://play.google.com/store/apps/details?id=com.kennedy.ReadiworkUser" ><img src="{{ asset('frontend/assets/img/google-play-img.png') }}" alt=""></a>
            </span>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
    <div class="footer-bottom-part" style="background:rgba(30, 67, 86, 1)">
        <div class="footer-inner">
            <span style="width:100%;text-align:center;font-size:13px;">&copy; Copyright {{ date('Y') }} @ Readiwork</span>
        </div>
        <div style=" clear:both;"></div>
    </div>
</div>
<div style="clear:both;"></div>
</div>

<style>
    #tawkchat-status-text-container{
        background:#214558 !important;
    }
    ul li a{
        background-image:none !important;
    }
        .header-page,.header-page-b,.header-page-ab, .header-page-a,.header-page-c,.header-page-d,.header-page-e{
        color:#105a80 !important;
    }
    
    
    .header-page::before,.header-page-ab::before{
        background:#105a80;
    }
    button,input[type='submit']{
              background:#105a80 !important;
          }
    .head-p{
        font-size:13px;
    }
</style>
<!-- footer part end -->