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
    <div class="about-page-serve-data">
      <div class="row">
        <div class="col-lg-10">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
            <?php if (!empty($post->image)) {
              ?>
                <img src="<?php echo asset('/').'/'.$post->image; ?>"> 
              <?php
            } ?>              
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p><?php echo $post->post_content; ?> </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  