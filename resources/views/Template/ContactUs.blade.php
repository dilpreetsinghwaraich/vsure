<!--HEADER-->
  <div class="header">
    <div class="bg-color" style="background: url('<?php echo asset('/public'); ?>/images/home-back.jpg')">
      <div class="wrapper">
        <div class="banner-info contact-page-banner banners-home wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
          <h1 class="bnr-title  text-center gallery"><?php echo $post->post_title; ?></h1>
          <h2 class="text-center gallery"><a href="<?php echo url('/'); ?>"><span>Home</span></a></h2>
        </div>
      </div>
    </div>
  </div>
  <!--/ HEADER--> 
  
  <!-- Feature start-->
  <section id="get-in-touch" class="section-padding wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
    <div class="container">
      <div class="contact-page-serve-heading">
        <?php echo $post->post_excerpt; ?>
        <hr class="bottom-line-left">
      </div>
      <div class="contact-page-serve-data">
        <div class="row">
          <div class="col-lg-12">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
              <p><?php echo $post->post_content; ?></p>
              <div class="contact-page-form">
                <?php echo Form::open(array('url' => 'contact/us/submit', 'method' => 'post')) ?>
                <div class="messageResponsed"></div>
                  <div class="col-md-6">
                    <?php echo Form::text('name', old('name'),['class'=>'contactName','placeholder'=>'Name','required'=>'required']); ?>
                  </div>
                  <div class="col-md-6">
                    <?php echo Form::email('email', old('email'),['class'=>'contactEmail','placeholder'=>'Email','required'=>'required']); ?>
                  </div>
                  <div class="col-md-12">
                    <?php echo Form::text('subject', old('subject'),['class'=>'subject','placeholder'=>'Subject']); ?>
                  </div>
                  <div class="col-md-12">
                    <?php echo Form::textarea('comment', old('comment'),['class'=>'comment','placeholder'=>'Message','rows'=>'3','style'=>'color: #000;']); ?>
                  </div>
                  <?php echo Form::button('Send', array('class' => 'contactUsFromSubmit')); ?>
                <?php echo Form::close(); ?>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
              <h3><i class="fa fa-map-marker"></i>&nbsp;Our Office Address</h3>
                <p> <strong>Gurgaon Office :</strong><br><br>
                  Suite No. 244A, 2nd Floor, <br>
                  Tower-B, SPAZE EDGE Tower,<br> 
                  Sector-47, Gurgaon-122001<br>
                  <b>Contact No.</b> : +91-8800849054, 0124-4286745<br>
                  <b>Customer Support Email id </b> : <a href="mailto:support@vsurecfo.com">support@vsurecfo.com</a><br>
                  <b>Sales Inquiry </b>: <a href="mailto:sales@vsurecfo.com">sales@vsurecfo.com</a>
                  <br><br>
                </p>
                <p> <strong>Karnal Office :</strong> <br><br>
                  SCO-268, 2nd Floor,<br> 
                  Mughal Canal Road, <br>
                  Karnal-132001<br>
                  <b>Contact No.</b> : +91-8800849054, +91-9896870152</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--feature end-->
  
  <!-- <section id="map" class="section-padding wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
    <div class="contact-page-map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d224568.30237037071!2d76.84969633013718!3d28.42288586405383!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d19d582e38859%3A0x2cf5fe8e5c64b1e!2sGurugram%2C+Haryana!5e0!3m2!1sen!2sin!4v1537293811255" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
  </section> -->
  
  <!-- Feature start-->
  <section id="feature" class="section-padding wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
    <div class="container">
      <div class="text-center">
        <p class="text-center"><img src="<?php echo asset('/public') ?>/images/startup.png"></p>
        <h1>VSure Has Over <span>100+ Startup</span> And Counting</h1>
        <p>Making It The Most Trusted Consultant In The Market</p>
      </div>
    </div>
  </section>
  <!--feature end-->