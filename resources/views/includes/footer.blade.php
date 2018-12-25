<!-- Contact start -->
  <section id="contact" class="section-padding" >
    <div class="container">
      <div class="row" style="border-bottom: 2px solid #fff; padding-bottom: 30px; margin-bottom: 30px;">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 botom">
          <h2>Startup Solutions</h2>
          <hr class="bottom-lines">
          <ul class="footer-links">
            <li><a href="<?php echo url('/service/private-limited-company-incorporation') ?>">Private Limited Company Registration</a></li>
            <li><a href="<?php echo url('/service/proprietorship-firm') ?>">Proprietorship Firm</a></li>
            <li><a href="<?php echo url('/service/llp-incorporation') ?>">LLP Incorporation</a></li>
            <li><a href="<?php echo url('/service/one-person-company-registration') ?>">One Person Company</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 botom">
          <h2>Registration Services</h2>
          <hr class="bottom-lines">
          <ul class="footer-links">
            <li><a href="<?php echo url('/service/gst-registration') ?>">GST Registration</a></li>
            <li><a href="<?php echo url('/service/trademark-registration') ?>">Trademark Application</a></li>
            <li><a href="<?php echo url('/service/food-license-registration') ?>">Food License Registration</a></li>
            <li><a href="<?php echo url('/service/import-export-code-registration') ?>">Impot-Export Registration</a></li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 botom">
          <h2>Compliance Services</h2>
           <hr class="bottom-lines">
           <ul class="footer-links">
             <li><a href="<?php echo url('/service/income-tax-return-filing') ?>">Income Tax Return Filing</a></li>
             <li><a href="<?php echo url('/service/gst-return-filing') ?>">GST Return Filing</a></li>
             <li><a href="<?php echo url('/service/roc-return-filing') ?>">ROC Return Filing</a></li>
             <li><a href="<?php echo url('/service/tds-return-filing') ?>">TDS Return Filing</a></li>
           </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 botom">
              <h2>Usefull Links</h2>
              <hr class="bottom-lines">
              <ul class="footer-links">
                <li><a href="<?php echo url('about-us') ?>">About Us</a></li>
                <li><a href="<?php echo url('privacy-policy') ?>">Privacy Policy</a></li>
                <li><a href="<?php echo url('terms-and-conditions') ?>">Terms And Conditions</a></li>
                <li><a href="<?php echo url('refund-and-cancellation') ?>">Refund And Cancellation</a></li>
                <li><a href="<?php echo url('contact-us') ?>">Contact Us</a></li>
              </ul>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 botom">
              <h2>Contact info</h2>
              <hr class="bottom-lines">
              <p>Suite No. 244A, 2nd Floor, <br>
            		Tower-B, SPAZE EDGE Tower,<br>
            		Sector-47, Gurgaon-122001</p>
              <p><span>Phone</span> : 0124-4286745</p>
              <p><span>Mobile</span> : +91-8800849054</p>
              <p><span>Email</span> : <a href="mailto:sales@vsurecfo.com">sales@vsurecfo.com</a></p>
              <!--  <p><span>Web</span> : Visit Our Website</p> --> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 botom">
              <h2>About VSURE CFO</h2>
              <hr class="bottom-lines">
              <p> VSURE CFO is an Indian cloud platform to support Indian startups and enterprenures for their business setup to smoothly compliances. We have established ourselves in October 2017 with a team of 2 founder. Now we have expended our services online with a team of 20+ and having 100+ startups. We are catering all startups services to compliance services. In today's era, we are going to establish ourselves as Regtech Company.</p>
              <ul>
                <li class="fa fa-facebook fa-lg" aria-hidden="true"></li>
                <li class="fa fa-twitter fa-lg" aria-hidden="true"></li>
                <li class="fa fa-youtube-play fa-lg" aria-hidden="true"></li>
                <li class="fa fa-google-plus fa-lg" aria-hidden="true"></li>
                <li class="fa fa-linkedin fa-lg" aria-hidden="true"></li>
                <li class="fa fa-skype fa-lg" aria-hidden="true"></li>
                <li class="fa fa-envelope-o fa-lg" aria-hidden="true"></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 botom">
          <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-10">
              <h2>Get in touch</h2>
              <span style="color:#fff;" class="Save-msg"></span>
              <hr class="bottom-lines">
              <?php echo Form::open(array('url' => 'contact/us/submit', 'method' => 'post')) ?>
                <div class="messageResponsed"></div>
                <?php echo Form::text('name', old('name'),['class'=>'contactName','placeholder'=>'Name','required'=>'required']); ?>
                <?php echo Form::email('email', old('email'),['class'=>'contactEmail','placeholder'=>'Email','required'=>'required']); ?>
                <?php echo Form::hidden('url', url()->current(),['required'=>'required']); ?>
                <?php echo Form::textarea('comment', old('comment'),['class'=>'comment','placeholder'=>'Message','rows'=>'3','cols'=>'34','style'=>'color: #000;']); ?>
                <?php echo Form::button('Send', array('class' => 'footer_button contactUsFromSubmit','type'=>'button')); ?>
              <?php echo Form::close(); ?>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 col-xs-12">
          <p style="color: #fff">Copyright 2012 - 2018 VSure Consulting  |  All Rights Reserved </p>
        </div>
      </div>
    </div>
  </section>
</div>
<style type="text/css">
a.scrollTopClick {
    position: fixed;
    bottom: 0px;
    left: 0px;
    background: #5bc0de;
    width: 30px;
    height: 40px;
    padding: 3px;
    font-size: 22px;
    color: #fff;
}
</style>
<a href="javascript:void(0)" class="scrollTopClick"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
<?php 
if (empty(session('token'))) {
  ?>
  @include('Auth.LoginModal')
  <?php
} 
?>

<script type="text/javascript" src="<?php echo asset('public/admin/js') ?>/jquery-ui.js"></script>
<script src="<?php echo asset('/public'); ?>/js/jquery.easing.min.js"></script> 
<script src="<?php echo asset('/public'); ?>/js/bootstrap.min.js"></script> 
<script src="<?php echo asset('/public'); ?>/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo asset('/public'); ?>/plugins/easing/easing.js"></script>
<script src="<?php echo asset('/public'); ?>/plugins/masonry/masonry.js"></script>
<script src="<?php echo asset('/public'); ?>/plugins/parallax-js-master/parallax.min.js"></script>
<script src="<?php echo asset('/public'); ?>/js/wow.js"></script> 
<script src="<?php echo asset('/public'); ?>/js/jquery.bxslider.min.js"></script> 
<script src="<?php echo asset('/public'); ?>/js/custom.js"></script> 
<script src="<?php echo asset('/public'); ?>/js/vsurescriptversion001.js"></script> 
<script src="<?php echo asset('/public'); ?>/js/post.js"></script>
<script src="<?php echo asset('/public'); ?>/js/share.js"></script>
<script>
$(document).ready(function() {
  $(".scrollTopClick").click(function() {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
  });
  $('#media').carousel({
    interval: 4000
  });
});
</script> 

<!-- <script src="https://static.landbot.io/landbot-widget/landbot-widget-1.0.0.js"></script>
<script>
  var myLandbotLivechat = new LandbotLivechat({
    index: 'https://landbot.io/u/H-103341-IGGFUCU8A93S0XO4/index.html',
  });
</script>
<script>
  myLandbotLivechat.on('landbot-load', () => {
    myLandbotLivechat.sendProactive("Hello there!");
  });
</script> -->