<link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/plugins/jquery.mb.YTPlayer-3.1.12/jquery.mb.YTPlayer.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/styles/post.css">
<link rel="stylesheet" type="text/css" href="<?php echo asset('/public'); ?>/styles/post_responsive.css">
<style type="text/css">
.ml-sm-auto, .mx-sm-auto {
    margin-left: auto!important;
    float: right;
    margin-top: 20px;
}
.post_panel .post_meta {
    font-family: 'Ubuntu', sans-serif;
    color: rgba(0,0,0,0.25);
    font-size: 14px;
    font-weight: 500;
    margin-left: 20px;
    margin-top: 18px;
    float: left;
}
.author_image {
    float: left;
}
.comment_input:first-child {
    margin-right: 0px;
}
.col-xl-8 {
    -ms-flex: 0 0 66.666667%;
    flex: 0 0 66.666667%;
    max-width: 66.666667%;
}
</style>
<div class="">
  <div class="bg-color" style="background: url('<?php echo asset('/public'); ?>/images/home-back.jpg')">
    <div class="wrapper">
      <div class="banner-info about-page-banner wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
        <h1 class="bnr-title  text-center gallery"><?php echo $post->post_title; ?></h1>
        <h2 class="text-center gallery"><a href="<?php echo url('/'); ?>"><span>Home</span></a></h2>
      </div>
    </div>
  </div>
</div>
<div class="super_container">
  <div class="page_content">
    <div class="container">
      <div class="row row-lg-eq-height"> 
        <div class="col-lg-8">
          <div class="post_content"> 
            <div class="post_panel post_panel_top d-flex flex-row align-items-center justify-content-start">
              <div class="author_image">
                <?php 
                  if (!empty($author->image)) {
                    $authorimage = asset('/').'/'.$author->image;
                  }else{
                    $authorimage = asset('/').'public/images/author.jpg';
                  } 
                ?> 
                <div><img src="<?php echo $authorimage; ?>" alt="<?php echo $author->name; ?>"></div>
              </div>
              <div class="post_meta"><a href="#"><?php echo $author->name; ?></a><span><?php echo date('M, d Y  h:i A', strtotime($post->created_at)); ?></span></div>
              <div class="post_share ml-sm-auto"> <span>share</span>
                <ul class="post_share_list">
                  <?php 
                    echo Share::page(
                                  Request::url(), 
                                  null, 
                                  ['class' => 'post_share_item', 'id' => 'facebook_share']
                                )
                                ->facebook(); 
                    echo Share::page(
                                    Request::url(), 
                                    null, 
                                    ['class' => 'post_share_item', 'id' => 'twitter_share']
                                  )->twitter(); 
                    echo Share::page(
                                    Request::url(), 
                                    null, 
                                    ['class' => 'post_share_item', 'id' => 'googlePlus_share']
                                  )->googlePlus(); 
                  ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row row-lg-eq-height"> 
        <div class="col-lg-8">
          <div class="post_content"> 
            
            <div class="post_body">
              <div><img src="<?php echo asset('/').'/'.$post->image; ?>" style="width: 100%;" alt="<?php echo $post->post_title; ?>"></div>
              <p class="post_p"><?php echo $post->post_content; ?></p>
            </div>
            
            <div class="post_panel bottom_panel d-flex flex-row align-items-center justify-content-start">
              <div class="author_image">
                <div><img src="<?php echo $authorimage; ?>" alt="<?php echo $author->name; ?>"></div>
              </div>
              <div class="post_meta"><a href="#"><?php echo $author->name; ?></a><span><?php echo date('M, d Y  h:i A', strtotime($post->created_at)); ?></span></div>
              <div class="post_share ml-sm-auto"> <span>share</span>
                <ul class="post_share_list">
                  <?php 
                    echo Share::page(
                                  Request::url(), 
                                  null, 
                                  ['class' => 'post_share_item', 'id' => 'facebook_share']
                                )
                                ->facebook(); 
                    echo Share::page(
                                    Request::url(), 
                                    null, 
                                    ['class' => 'post_share_item', 'id' => 'twitter_share']
                                  )->twitter(); 
                    echo Share::page(
                                    Request::url(), 
                                    null, 
                                    ['class' => 'post_share_item', 'id' => 'googlePlus_share']
                                  )->googlePlus(); 
                  ?>
                </ul>
              </div>
            </div>
            <div class="similar_posts">
              <div class="grid clearfix"> 
                <?php 
                  Helper::similarPosts($post);
                ?>
              </div>
              <?php 
                  echo Helper::comments($post);
                ?>
            </div>
          </div>
        </div>
        <?php echo Helper::SidebarPost('blog', []); ?>
      </div>
    </div>
  </div>
</div>
