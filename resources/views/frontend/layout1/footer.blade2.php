
    <footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
      <div class="footer-top">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-6 footer-links">
              <ul>
                <li>
                  <i class="bx bx-chevron-right"></i>
                  <a href="/how-it-works">How it Works</a>
                </li>
                <li>
                  <i class="bx bx-chevron-right"></i>
                  <a href="/trust-safety">Trust Safety & Insurance</a>
                </li>
                <li>
                  <i class="bx bx-chevron-right"></i>
                  <a href="/terms-and-conditions">Terms and Conditions</a>
                </li>
                <li>
                  <i class="bx bx-chevron-right"></i>
                  <a href="/faq">FAQs</a>
                </li>
                <li>
                  <i class="bx bx-chevron-right"></i>
                  <a href="#">Privacy Policy</a>
                </li>
              </ul>
            </div>

            <div class="col-lg-3 col-md-6 footer-links">
              <ul>
                <li>
                  <i class="bx bx-chevron-right"></i> <a href="/about-us">About Us</a>
                </li>
                <li>
                  <i class="bx bx-chevron-right"></i>
                  <a href="/contact-us">Contact Us</a>
                </li>
                <li>
                  <i class="bx bx-chevron-right"></i>
                  <a href="/help">Help center</a>
                </li>
                <li>
                  <i class="bx bx-chevron-right"></i>
                  <a href="/help">Help Center</a>
                </li>
                <li>
                  <i class="bx bx-chevron-right"></i>
                  <a href="/legal">Legal</a>
                </li>
              </ul>
            </div>
            <div class="col-lg-3 col-md-6 footer-info">
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"
                  ><i class="bx bxl-instagram"></i
                ></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
              </div>
              <div class="col-lg-3 col-md-6 footer-links">
                <ul>
                  <li>
                    <a href=""
                      ><img
                        src="{{ asset('frontend/assets1/img/google-play-img.png') }}"
                        alt=""
                    /></a>
                  </li>
                  <li>
                    <a href=""
                      ><img
                        src="{{ asset('frontend/assets1/img/app-stor-img.png') }}"
                        alt=""
                    /></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="copyright">
      
          <span style="color:#fff;">&copy; Copyright {{ date('Y') }} @ TaskMet</span>
        </div>
      </div>

      
    </footer> 
    <style>
        #footer {
  background: #0b212d;
  padding: 0 0 30px 0;
  color: #fff;
  font-size: 14px;
}

#footer .footer-newsletter {
  padding: 50px 0;
  background: #0d2735;
}

#footer .footer-newsletter h4 {
  font-size: 24px;
  margin: 0 0 20px 0;
  padding: 0;
  line-height: 1;
  font-weight: 600;
  color: #a2cce3;
}

#footer .footer-newsletter form {
  margin-top: 30px;
  background: #fff;
  padding: 6px 10px;
  position: relative;
  border-radius: 50px;
}

#footer .footer-newsletter form input[type="email"] {
  border: 0;
  padding: 4px;
  width: calc(100% - 100px);
}

#footer .footer-newsletter form input[type="submit"] {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  border: 0;
  background: none;
  font-size: 16px;
  padding: 0 20px;
  margin: 3px;
  background: #68A4C4;
  color: #fff;
  transition: 0.3s;
  border-radius: 50px;
}

#footer .footer-newsletter form input[type="submit"]:hover {
  background: #468db3;
}

#footer .footer-top {
  background: #0d2735;
  border-top: 1px solid #17455e;
  border-bottom: 1px solid #123649;
  padding: 60px 0 30px 0;
}

#footer .footer-top .footer-info {
  margin-bottom: 30px;
}

#footer .footer-top .footer-info h3 {
  font-size: 18px;
  margin: 0 0 20px 0;
  padding: 2px 0 2px 0;
  line-height: 1;
  color: #a2cce3;
  font-weight: 600;
}

#footer .footer-top .footer-info p {
  font-size: 14px;
  line-height: 24px;
  margin-bottom: 0;
  font-family: "Roboto", sans-serif;
  color: #fff;
}

#footer .footer-top .social-links a {
  font-size: 18px;
  display: inline-block;
  background: #1e4356;
  color: #fff;
  line-height: 1;
  padding: 8px 0;
  margin-right: 4px;
  border-radius: 50%;
  text-align: center;
  width: 36px;
  height: 36px;
  transition: 0.3s;
}

#footer .footer-top .social-links a:hover {
  background: #68A4C4;
  color: #fff;
  text-decoration: none;
}

#footer .footer-top h4 {
  font-size: 18px;
  font-weight: 600;
  color: #a2cce3;
  position: relative;
  padding-bottom: 12px;
}

#footer .footer-top .footer-links {
  margin-bottom: 30px;
}

#footer .footer-top .footer-links ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

#footer .footer-top .footer-links ul i {
  padding-right: 2px;
  color: #a2cce3;
  font-size: 18px;
  line-height: 1;
}

#footer .footer-top .footer-links ul li {
  padding: 10px 0;
  display: flex;
  align-items: center;
}

#footer .footer-top .footer-links ul li:first-child {
  padding-top: 0;
}

#footer .footer-top .footer-links ul a {
  color: #fff;
  transition: 0.3s;
  display: inline-block;
  line-height: 1;
}

#footer .footer-top .footer-links ul a:hover {
  color: #a2cce3;
}

#footer .footer-top .footer-contact {
  margin-bottom: 30px;
}

#footer .footer-top .footer-contact p {
  line-height: 26px;
}

#footer .copyright {
  text-align: center;
  padding-top: 30px;
}

#footer .credits {
  padding-top: 10px;
  text-align: center;
  font-size: 13px;
  color: #fff;
}

#footer .credits a {
  color: #a2cce3;
}

        
    </style>
    
    
    <script src="{{ asset('frontend/assets1/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets1/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets1/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('frontend/assets1/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('frontend/assets1/vendor/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets1/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/assets1/vendor/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets1/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets1/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets1/vendor/aos/aos.js') }}"></script>
    
    <!-- Template Main JS File -->
    <script src="{{ asset('frontend/assets1/js/main.js') }}"></script>