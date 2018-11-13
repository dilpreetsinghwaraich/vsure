<div class="header">
    <div class="bg-color" style="background: url('<?php echo asset('/public'); ?>/images/home-back.jpg')">
      <div class="wrapper">
        <div class="banner-info about-page-banner wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
          <h1 class="bnr-title  text-center gallery"><?php echo $post->post_title; ?></h1>
          <h2 class="text-center gallery"><a href="<?php echo url('/'); ?>"><span>Home</span></a></h2>
        </div>
      </div>
    </div>
  </div>
  <!-- Feature start-->
  <section id="about-page-serve-you" class="section-padding wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
    <div class="container">
      <div class="about-page-serve-heading">
        <?php echo $post->post_excerpt; ?>
        <hr class="bottom-line-left">
      </div>
      <div class="about-page-serve-data">
        <div class="row">
          <div class="col-lg-12">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> <img src="<?php echo asset('/public'); ?>/images/about-us-image.jpg"> </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
              <?php echo $post->post_content; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--feature end--> 
  
  <!-- blog start -->
  <section id="team-member" class="about-page-team-section section-padding wow fadeInUp delay-05s" style="visibility: hidden; animation-name: none;">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
          <h2 class="service-title pad-bt18">Our Valuable Team Members</h2>
          <p class="sub-title pad-bt19">Get the Services Here</p>
          <hr class="bottom-line1">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-1"> </div>
        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="blog-sec">
                <div class="blog-img img-responsive text-center"> <img src="<?php echo asset('/public'); ?>/images/image-team.png">
                  <h2>John Doe</h2>
                  <h3>Developer</h3>
                  <p>Get Register your private limited company having lot of benefits of issuing shares and attracting investors with your idea for Startup Funding</p>
                  <i class="fa fa-facebook" aria-hidden="true"></i> <i class="fa fa-twitter" aria-hidden="true"></i> <i class="fa fa-globe" aria-hidden="true"></i> </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="blog-sec">
                <div class="blog-img img-responsive text-center"> <img src="<?php echo asset('/public'); ?>/images/image-team.png">
                  <h2>John Doe</h2>
                  <h3>Developer</h3>
                  <p>Get Register your private limited company having lot of benefits of issuing shares and attracting investors with your idea for Startup Funding</p>
                  <i class="fa fa-facebook" aria-hidden="true"></i> <i class="fa fa-twitter" aria-hidden="true"></i> <i class="fa fa-globe" aria-hidden="true"></i> </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="blog-sec">
                <div class="blog-img img-responsive text-center"> <img src="<?php echo asset('/public'); ?>/images/image-team.png">
                  <h2>John Doe</h2>
                  <h3>Developer</h3>
                  <p>Get Register your private limited company having lot of benefits of issuing shares and attracting investors with your idea for Startup Funding</p>
                  <i class="fa fa-facebook" aria-hidden="true"></i> <i class="fa fa-twitter" aria-hidden="true"></i> <i class="fa fa-globe" aria-hidden="true"></i> </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-1"></div>
      </div>
    </div>
  </section>
  <!-- blog end--> 
  
  <!-- blog-second start -->
  <section id="blog-second" class="section-padding wow fadeInUp delay-05s" style="visibility: hidden; animation-name: none;">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
          <h2 class="service-title pad-bt18">Latest News</h2>
          <p class="sub-title pad-bt19">Get Latest Update from us on various topics like<br>
            taxation,Finance,Legal and Business Ideas.</p>
          <hr class="bottom-line1">
        </div>
      </div>
      <div class="row about-blog">
        <?php
        if (!empty($posts)) {
          foreach ($posts as $post) {
            ?>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="blog-sec">
                <div class="blog-img text-center"> 
                  <?php 
                  if (!empty($post->image)) {
                    echo '<img class="img-responsive" src="'. asset('/'.$post->image) .'">';
                  }
                  ?>
                  <h2><?php echo $post->post_title ?></h2>
                  <h3><?php echo date('M, d Y',strtotime($post->created_at)); ?></h3>
                  <p><?php echo $post->post_excerpt; ?></p>
                  <button onclick="window.location.href='<?php echo url('/'.$post->post_slug); ?>'">LEARN MORE</button>
                </div>
              </div>
            </div>
            <?php
          }
        }
        ?>
      </div>
    </div>
  </section>
  <!-- blog end-->