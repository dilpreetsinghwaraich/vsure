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