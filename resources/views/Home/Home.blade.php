  
<?php 
$sliderImages = Helper::getSlider();
if (!empty($sliderImages)) {
  $active = 'active';
  ?>
    <div class="vsure-home-page-slider">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <?php
          foreach ($sliderImages as $sliderImage) {
            ?>
              <div class="item <?php echo $active; ?>">
                <img src="<?php echo asset('/'.$sliderImage['image']); ?>" alt="<?php echo $sliderImage['post_title'] ?>" style="width:100%;">
                <div class="carousel-caption">
                  <h2><?php echo $sliderImage['post_title'] ?></h2>              
                  <?php echo $sliderImage['post_content'] ?>                  
                </div>
              </div>
            <?php
            $active = '';
          }
          ?>          
        
         <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="fa fa-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="fa fa-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>

        </div>
      </div>
    </div> 
  <?php
}
?>
            
<div class="vsure-homepage-clients-icons">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-6">
				<img src="<?php echo asset('https://vsurecfo.com/public/images/thread origin.png') ?>">
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6">
				<img src="<?php echo asset('https://vsurecfo.com/public/images/wedyut.png') ?>">
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6">
				<img src="<?php echo asset('https://vsurecfo.com/public/images/rsqr.png') ?>">
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6">
				<img src="<?php echo asset('https://vsurecfo.com/public/images/human.png') ?>">
			</div>
		</div>
	</div>
</div>
  <div class="header">
    <div class="bg-color" style="background-image: url('<?php echo asset('/public'); ?>/images/home-back.jpg')">
      <div class="wrapper">
        <div class="banner-info home-page-banner-info banners-home wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
          <h1 class="bnr-title  text-center gallery">STARTUP SOLUTION</h1>
          <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"> </div>
          <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 margin-btm-10">
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                <a href="<?php echo url('service/private-limited-company-incorporation') ?>">
                  <div class="wrap-item">
                    <div class="item-img"> <img src="<?php echo asset('/public'); ?>/images/icon1.png"> </div>
                    <p>Private Limited Company<br>
                      Incorporation</p>
                  </div>
                </a>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                <a href="<?php echo url('service/public-limited-company-registration') ?>">
                  <div class="wrap-item">
                    <div class="item-img"> <img src="<?php echo asset('/public'); ?>/images/icon2.png"> </div>
                    <p>Public Limited Company<br>
                      Registration</p>
                  </div>
                </a>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                <a href="<?php echo url('service/one-person-company-registration') ?>">
                  <div class="wrap-item">
                    <div class="item-img"> <img src="<?php echo asset('/public'); ?>/images/icon3.png"> </div>
                    <p>One Person Company<br>
                      Registration</p>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12"></div>
        <div class="banner-info padding-0 wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
          <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12"> </div>
          <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 gallery">
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                <a href="<?php echo url('service/llp-incorporation') ?>">
                  <div class="wrap-item ">
                    <div class="item-img"> <img src="<?php echo asset('/public'); ?>/images/icon4.png"> </div>
                    <p>Limited Liability<br>
                      Partnership</p>
                  </div>
                </a>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                <a href="<?php echo url('service/partnership-firm-registration') ?>">
                  <div class="wrap-item">
                    <div class="item-img"> <img src="<?php echo asset('/public'); ?>/images/icon5.png"> </div>
                    <p>Partnership Firm<br>
                      Registration</p>
                  </div>
                </a>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                <a href="<?php echo url('service/proprietorship-firm') ?>">
                  <div class="wrap-item">
                    <div class="item-img"> <img src="<?php echo asset('/public'); ?>/images/icon6.png"> </div>
                    <p>Proprietorship Firm<br>
                    </p>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ HEADER--> 
  
  <!-- Feature start-->
  <section id="feature" class="section-padding wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
    <div class="container">
      <div class="text-center">
        <p class="text-center"><img src="<?php echo asset('/public'); ?>/images/startup.png"></p>
        <h1>VSure Has Over <span>100+ Startup</span> And Counting</h1>
        <p>Making It The Most Trusted Consultant In The Market</p>
      </div>
    </div>
  </section>
  <!--feature end--> 
  
  <!--Service start-->
  <section id="service" class="section-padding wow fadeInUp delay-05s animated" style="visibility: visible; animation-name: fadeInUp;">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="service-title pad-bt15">Registration Services</h2>
          <p class="sub-title pad-bt15">Get the Registeration</p>
          <hr class="bottom-line">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12  service1">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 line text-center">
            <a href="<?php echo url('service/food-license-registration') ?>">
              <div class="wrap-item pad30">
                <div class="item-img"> <img src="<?php echo asset('/public'); ?>/images/food.png"> </div>
                <p>Food License<br>
                  Registration</p>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 line text-center">
            <a href="<?php echo url('service/msme-udyog-aadhar-registration') ?>">
              <div class="wrap-item pad30">
                <div class="item-img"> <img src="<?php echo asset('/public'); ?>/images/aadhar.png"> </div>
                <p>MSME Udyog Aadhar<br>
                  Registration</p>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 wrap1 text-center">
            <a href="<?php echo url('service/shop-and-establishment-registration') ?>">
              <div class="wrap-item pad30">
                <div class="item-img"> <img src="<?php echo asset('/public'); ?>/images/cart.png"> </div>
                <p>Shop and Establishment<br>
                  act Registration</p>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 line line1 text-center">
            <a href="<?php echo url('service/gst-registration') ?>">
              <div class="wrap-item pad30">
                <div class="item-img"> <img src="<?php echo asset('/public'); ?>/images/GST1.png"> </div>
                <p>GST <br>
                  Registration</p>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 line line1 text-center">
            <a href="<?php echo url('service/trademark-registration') ?>">
              <div class="wrap-item pad30">
                <div class="item-img"> <img src="<?php echo asset('/public'); ?>/images/service-tax.png"> </div>
                <p>Service Tax<br>
                  Registration</p>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
            <a href="<?php echo url('service/import-export-code-registration') ?>">
              <div class="wrap-item pad30">
                <div class="item-img"> <img src="<?php echo asset('/public'); ?>/images/code.png"> </div>
                <p>Import-Export<br>
                  Code</p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Service end--> 
  
  <!--Portfolio start-->
  <section id="portfolio" class="section-padding wow fadeInUp delay-05s animated" style="visibility: visible; animation-name: fadeInUp;">
    <div class="container">
      <div class="row">
        <div class="col-lg-2"> </div>
        <div class="col-lg-8 text-center">
          <h2 class="service-title pad-bt16">Why Choose us ?</h2>
          <p>Our Core Values</p>
          <hr class="bottom-line1">
          <p class="sub-title pad-bt17">We believe our strength and knowledge that differentiate us from others Our 24 x 7 Support to clients from our CA asisted team make our client as our family member.</p>
        </div>
        <div class="col-lg-2"> </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
          <div class="wrap-item1">
            <div class="item-img"> <img src="<?php echo asset('/public'); ?>/images/great.png"> </div>
            <h3>CREATIVE SOLUTIONS</h3>
            <hr class="bottom-line2">
            <p>VSURE CONSULTING looks forward to entailing you with the best possible solutions. Our aim is to provide you with a whole new dimension of working and to track in the most fitted accounting solutions according to your requirements. We delve in your accounting, registration or tax filling projects deeper and deeper like our own to come up with the creative ideas that suit best for your profile.</p>
            <button>LEARN MORE</button>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  text-center">
          <div class="wrap-item1">
            <div class="item-img"> <img src="<?php echo asset('/public'); ?>/images/highest.png"> </div>
            <h3>HIGHEST STANDARDS</h3>
            <hr class="bottom-line3">
            <p>Whether you are a startup or an established firm, the main motto of VSURE CONSULTING is to give you the best. We never settle for the ordinary or normal, after all that is what keeps you apart from the rest in the market. Our team understands the importance of your time and money, thus we make sure to keep you updated with the project and meet all deadlines without fail. </p>
            <button>LEARN MORE</button>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  text-center">
          <div class="wrap-item1">
            <div class="item-img"> <img src="<?php echo asset('/public'); ?>/images/professional.png"> </div>
            <h3>PROFESSIONAL TEAM</h3>
            <hr class="bottom-line4">
            <p>At VSURE CONSULTING, we have a trained and professional team of experts with years of experience in their respective fields. We believe in working and growing together that’s why we present you with the crème de la crème services. Our association among clients is so strong which enables them to build better communication this means better results. After being savvy of the exact needs, our team members work in a professional upfront and deliver the requirements of the clients with excellence.</p>
            <button>LEARN MORE</button>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12  text-center">
          <div class="wrap-item1">
            <div class="item-img"> <img src="<?php echo asset('/public'); ?>/images/creative.png"> </div>
            <h3>GREAT SERVICES</h3>
            <hr class="bottom-line5">
            <p>The connection we build with our clients is for lifetime. Our accounting, registration and tax filling services are up to date and within the parameters of clients. We make sure to let our ideas and dream formulate a living reality. This is attained by engaging with the clients and regularly updating them about the progress. Our team is well cooperative to all the changes that you like to be featured in the whole process.</p>
            <button>LEARN MORE</button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Portfolio end--> 
  
  <!-- blog start -->
  <section id="blog" class="section-padding wow fadeInUp delay-05s" style="visibility: hidden; animation-name: none;">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
          <h2 class="service-title pad-bt18">Compliance services</h2>
          <p class="sub-title pad-bt19">Get the Services Here</p>
          <hr class="bottom-line1">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-1"> </div>
        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
              <a href="<?php echo url('service/income-tax-return-filing') ?>">
                <div class="blog-sec homepage-blog-sec">
                  <div class="blog-img img-responsive text-center"> <img src="<?php echo asset('/public'); ?>/images/tax.jpg">
                    <h2>Income tax compliance</h2>
                    <p>Get Register your private limited company having lot of benefits of issuing shares and attracting investors with your idea for Startup Funding</p>
                    <button>Start Now</button>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
              <a href="<?php echo url('service/gst-return-filing') ?>">
                <div class="blog-sec homepage-blog-sec">
                  <div class="blog-img img-responsive text-center"> <img src="<?php echo asset('/public'); ?>/images/gst.jpg">
                    <h2>GST Compliance </h2>
                    <p>Get Register your private limited company having lot of benefits of issuing shares and attracting investors with your idea for Startup Funding</p>
                    <button>Start Now</button>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
              <a href="<?php echo url('service/roc-return-filing') ?>">
                <div class="blog-sec homepage-blog-sec">
                  <div class="blog-img img-responsive text-center"> <img src="<?php echo asset('/public'); ?>/images/law.jpg">
                    <h2>Company Law Compliance </h2>
                    <p>Get Register your private limited company having lot of benefits of issuing shares and attracting investors with your idea for Startup Funding</p>
                    <button>Start Now</button>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-1"></div>
      </div>
    </div>
  </section>
  <!-- blog end--> 
  
  <!--testimonial start-->
  <section id="testimonial" class="wow fadeInUp delay-05s" style="visibility: hidden; animation-name: none;background-image: url('<?php echo url('/public') ?>/images/startup-back.jpg');">
    <div class="bg-testicolor1">
      <div class="container">
        <div class="row">
          <div class="col-lg-2"> </div>
          <div class="col-lg-8 col-md-12 text-center "> <img src="<?php echo asset('/public'); ?>/images/icon.png">
            <p>We’re Here To Help Your Business Blast Off!<br>
              Through Creative Ideas, Innovation &amp; Sheer Determination</p>
          </div>
          <div class="col-lg-2"> </div>
        </div>
        <div class="row">
          <div class="col-lg-2"> </div>
          <div class="col-lg-8 text-center "> <a href="<?php echo url('/contact-us'); ?>" target="_blank">
            <button>Let’s Get Started</button>
            </a>
            <h3></h3>
          </div>
          <div class="col-lg-2"> </div>
        </div>
      </div>
    </div>
  </section>
  <!--testimonial end--> 
  
  <!-- blog-second start -->
  <?php echo Helper::latestBlogSection(); ?>
  <!-- blog end-->
  <?php echo Helper::HomeSubscribePopup(); ?>
