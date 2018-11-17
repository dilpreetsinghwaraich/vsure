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
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
              <?php if (!empty($post->image)) {
                ?>
                  <img src="<?php echo asset('/').'/'.$post->image; ?>"> 
                <?php
              }else{ ?>
              <img src="<?php echo asset('/public'); ?>/images/about-us-image.jpg"> 
            <?php } ?>
            </div>
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
  <?php echo Helper::ourClientsSection(); ?>
  <!-- blog end--> 
  
  <!-- blog-second start -->
  <?php echo Helper::latestBlogSection(); ?>
  <!-- blog end-->