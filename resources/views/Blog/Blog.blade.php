<div class="header">
    <div class="bg-color" style="background-image: url('<?php echo asset('/public'); ?>/images/home-back.jpg')">
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
      <div class="about-blog">
        <div class="col-md-9">
          <h4 class="block-title"><span style="margin-right: 0px;">Latest Posts</span></h4>
          <div class="td-subcat-filter">
            <ul class="td-subcat-list">
              <li class="td-subcat-item" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                <a class="td-subcat-link" data-td_filter_value="" href="<?php echo url('blog') ?>">All</a>
              </li>
              <?php 
              $show_cate = [];
              $ct = 0;
              foreach ($terms as $term) {
                if ($ct < 2) {
                  $show_cate[] = $term->term_id;
                  ?>
                  <li class="td-subcat-item" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                    <a class="td-subcat-link" href="<?php echo url('blog') ?>?term=<?php echo $term->term_id; ?>"><?php echo $term->term_title; ?></a>
                  </li>
                  <?php
                }
                $ct++;
              }
              ?>   
            </ul>
            <div class="td-subcat-dropdown" style="">
              <div class="td-subcat-more" aria-haspopup="true"><span>More</span><i class="fa fa-angle-down" aria-hidden="true"></i></div>
              <ul class="td-pulldown-filter-list">
                <?php 
                  foreach ($terms as $term) {
                    if (!in_array($term->term_id, $show_cate)) {
                      ?>
                      <li class="td-subcat-item" style="transition: opacity 0.2s ease 0s; opacity: 1;">
                        <a class="td-subcat-link" href="<?php echo url('blog') ?>?term=<?php echo $term->term_id; ?>"><?php echo $term->term_title; ?></a>
                      </li>
                      <?php
                    }
                  }
                  ?>     
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row about-blog">
        <div class="col-md-9">
          <?php
          if (!empty($posts)) {
            foreach ($posts as $post) {
              ?>
              <div class="col-lg-12">
                <div class="blog-sec">
                  <div class="blog-img text-center" style="margin-top: 0px;"> 
                    <div class="blog-thumb">
                      <a href="<?php echo url('/'.$post->post_slug) ?>">
                      <?php 
                      if (!empty($post->image)) {
                        echo '<img height="150" width="218" class="img-responsive" src="'. asset('/'.$post->image) .'">';
                      }
                      ?>
                      </a>
                    </div>
                    <div class="item-details">
                      <h2><a href="<?php echo url('/'.$post->post_slug) ?>"><?php echo $post->post_title ?></a></h2>
                      <h3><?php echo date('M, d Y',strtotime($post->created_at)); ?></h3>
                      <p><?php echo substr($post->post_excerpt, 0, 250); ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <?php
            }
          }
          ?>
          <div class="col-lg-12">
            {{ $posts->links() }}
          </div>
        </div>
        <div class="col-md-3">

        </div>      
      </div>      
    </div>
  </section>
  <!-- blog end-->