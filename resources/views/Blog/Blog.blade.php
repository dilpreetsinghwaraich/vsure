<div class="header">
    <div class="bg-color" style="background: url('<?php echo asset('/public'); ?>/images/home-back.jpg')">
      <div class="wrapper">
        <div class="banner-info about-page-banner wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
          <h1 class="bnr-title  text-center gallery">Blog</h1>
          <h2 class="text-center gallery"><a href="<?php echo url('/'); ?>"><span>Home</span></a></h2>
        </div>
      </div>
    </div>
  </div>
  
  <section id="blog-second" class="section-padding wow fadeInUp delay-05s" style="visibility: hidden; animation-name: none;">
    <div class="container">
      <div class="row about-blog">
      <?php
      $count = 0;
      if (!empty($posts)) {
        foreach ($posts as $post) {
          if ($count%4 ==0 ) {
            echo '</div><div class="row about-blog">';
          }
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
          $count++;
        }
      }
      ?>
      </div>
      {{ $posts->links() }}
    </div>
  </section>
  <!-- blog end-->