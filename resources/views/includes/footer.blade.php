<!-- Contact start -->
  <section id="contact" class="section-padding wow fadeInUp delay-05s" style="visibility: hidden; animation-name: none;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 botom">
              <h2>Contact info</h2>
              <hr class="bottom-lines">
              <p>VSure Consulting India, 4/27,<br>
                1st Floor, Madanpuri Road, Gurgaon</p>
              <p><span>Phone</span> : 0124-4286745</p>
              <p><span>Mobile</span> : +91-8800849054</p>
              <p><span>Email</span> : Mail Us</p>
              <!--  <p><span>Web</span> : Visit Our Website</p> --> 
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 botom">
              <h2>About Vsure consulting</h2>
              <hr class="bottom-lines">
              <p>Lid est laborum dolo rumes fugats untras. Etharums ser quidem rerum facilis dolores nemis omnis fugats vitaes nemo minima rerums unsers sadips amets. i architecto beatae vitae dicta sunt explicabo.</p>
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
          <p>Copyright 2012 - 2017 VSure Consulting  |  All Rights Reserved  |</p>
        </div>
      </div>
    </div>
  </section>
</div>
<script src="<?php echo asset('/public'); ?>/js/jquery.min.js"></script>
<script src="<?php echo asset('/public'); ?>/js/jquery.easing.min.js"></script> 
<script src="<?php echo asset('/public'); ?>/js/bootstrap.min.js"></script> 
<script src="<?php echo asset('/public'); ?>/js/wow.js"></script> 
<script src="<?php echo asset('/public'); ?>/js/jquery.bxslider.min.js"></script> 
<script src="<?php echo asset('/public'); ?>/js/custom.js"></script> 
<script src="<?php echo asset('/public'); ?>/js/vsurescriptversion001.js"></script> 
<script>
$(document).ready(function() {
  $('#media').carousel({
    interval: 4000
  });
});
</script> 
