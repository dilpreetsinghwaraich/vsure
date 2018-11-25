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
        <div class="col-lg-9">
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
                  <li class="post_share_item"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                  <li class="post_share_item"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                  <li class="post_share_item"><a href="#"><i class="fa fa-google" aria-hidden="true"></i></a></li>
                </ul>
              </div>
            </div>
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
                  <li class="post_share_item"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                  <li class="post_share_item"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                  <li class="post_share_item"><a href="#"><i class="fa fa-google" aria-hidden="true"></i></a></li>
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
        <div class="col-lg-3">
          <div class="sidebar">
            <div class="sidebar_background"></div>
            <div class="sidebar_section">
              <div class="sidebar_title_container">
                <div class="sidebar_title">Top Stories</div>
                <div class="sidebar_slider_nav">
                  <div class="custom_nav_container sidebar_slider_nav_container">
                    <div class="custom_prev custom_prev_top"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
                      <polyline fill="#bebebe" points="0,5.61 5.609,0 7,0 7,1.438 2.438,6 7,10.563 7,12 5.609,12 -0.002,6.39 "/>
                      </svg> </div>
                    <ul id="custom_dots" class="custom_dots custom_dots_top">
                      <li class="custom_dot custom_dot_top active"><span></span></li>
                      <li class="custom_dot custom_dot_top"><span></span></li>
                      <li class="custom_dot custom_dot_top"><span></span></li>
                    </ul>
                    <div class="custom_next custom_next_top"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
                      <polyline fill="#bebebe" points="6.998,6.39 1.389,12 -0.002,12 -0.002,10.562 4.561,6 -0.002,1.438 -0.002,0 1.389,0 7,5.61 "/>
                      </svg> </div>
                  </div>
                </div>
              </div>
              <div class="sidebar_section_content"> 
                <div class="sidebar_slider_container">
                  <div class="owl-carousel owl-theme sidebar_slider_top"> 
                    <div class="owl-item"> 
                      
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/top_1.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/top_2.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Sidebar Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/top_3.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Sidebar Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/top_4.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                    </div>
                    
                    <!-- Top Stories Slider Item -->
                    <div class="owl-item"> 
                      
                      <!-- Sidebar Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/top_1.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Sidebar Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/top_2.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Sidebar Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/top_3.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Sidebar Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/top_4.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                    </div>
                    
                    <!-- Top Stories Slider Item -->
                    <div class="owl-item"> 
                      
                      <!-- Sidebar Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/top_1.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Sidebar Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/top_2.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Sidebar Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/top_3.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Sidebar Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/top_4.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Advertising -->
            
            <div class="sidebar_section">
              <div class="advertising">
                <div class="advertising_background" style="background-image:url(images/post_17.jpg)"></div>
                <div class="advertising_content d-flex flex-column align-items-start justify-content-end">
                  <div class="advertising_perc">-15%</div>
                  <div class="advertising_link"><a href="#">How Did van Gogh’s Turbulent Mind</a></div>
                </div>
              </div>
            </div>
            
            <!-- Newest Videos -->
            
            <div class="sidebar_section newest_videos">
              <div class="sidebar_title_container">
                <div class="sidebar_title">Newest Videos</div>
                <div class="sidebar_slider_nav">
                  <div class="custom_nav_container sidebar_slider_nav_container">
                    <div class="custom_prev custom_prev_vid"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
                      <polyline fill="#bebebe" points="0,5.61 5.609,0 7,0 7,1.438 2.438,6 7,10.563 7,12 5.609,12 -0.002,6.39 "/>
                      </svg> </div>
                    <ul id="custom_dots" class="custom_dots custom_dots_vid">
                      <li class="custom_dot custom_dot_vid active"><span></span></li>
                      <li class="custom_dot custom_dot_vid"><span></span></li>
                      <li class="custom_dot custom_dot_vid"><span></span></li>
                    </ul>
                    <div class="custom_next custom_next_vid"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
                      <polyline fill="#bebebe" points="6.998,6.39 1.389,12 -0.002,12 -0.002,10.562 4.561,6 -0.002,1.438 -0.002,0 1.389,0 7,5.61 "/>
                      </svg> </div>
                  </div>
                </div>
              </div>
              <div class="sidebar_section_content"> 
                
                <!-- Sidebar Slider -->
                <div class="sidebar_slider_container">
                  <div class="owl-carousel owl-theme sidebar_slider_vid"> 
                    
                    <!-- Newest Videos Slider Item -->
                    <div class="owl-item"> 
                      
                      <!-- Newest Videos Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/vid_1.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Newest Videos Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/vid_2.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Newest Videos Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/vid_3.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Newest Videos Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/vid_4.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                    </div>
                    
                    <!-- Newest Videos Slider Item -->
                    <div class="owl-item"> 
                      
                      <!-- Newest Videos Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/vid_1.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Newest Videos Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/vid_2.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Newest Videos Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/vid_3.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Newest Videos Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/vid_4.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                    </div>
                    
                    <!-- Newest Videos Slider Item -->
                    <div class="owl-item"> 
                      
                      <!-- Newest Videos Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/vid_1.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Newest Videos Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/vid_2.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Newest Videos Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/vid_3.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Newest Videos Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="side_post_image">
                            <div><img src="images/vid_4.jpg" alt=""></div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Advertising 2 -->
            
            <div class="sidebar_section">
              <div class="advertising_2">
                <div class="advertising_background" style="background-image:url(images/post_18.jpg)"></div>
                <div class="advertising_2_content d-flex flex-column align-items-center justify-content-center">
                  <div class="advertising_2_link"><a href="#">Turbulent <span>Mind</span></a></div>
                </div>
              </div>
            </div>
            
            <!-- Future Events -->
            
            <div class="sidebar_section future_events">
              <div class="sidebar_title_container">
                <div class="sidebar_title">Future Events</div>
                <div class="sidebar_slider_nav">
                  <div class="custom_nav_container sidebar_slider_nav_container">
                    <div class="custom_prev custom_prev_events"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
                      <polyline fill="#bebebe" points="0,5.61 5.609,0 7,0 7,1.438 2.438,6 7,10.563 7,12 5.609,12 -0.002,6.39 "/>
                      </svg> </div>
                    <ul id="custom_dots" class="custom_dots custom_dots_events">
                      <li class="custom_dot custom_dot_events active"><span></span></li>
                      <li class="custom_dot custom_dot_events"><span></span></li>
                      <li class="custom_dot custom_dot_events"><span></span></li>
                    </ul>
                    <div class="custom_next custom_next_events"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="7px" height="12px" viewBox="0 0 7 12" enable-background="new 0 0 7 12" xml:space="preserve">
                      <polyline fill="#bebebe" points="6.998,6.39 1.389,12 -0.002,12 -0.002,10.562 4.561,6 -0.002,1.438 -0.002,0 1.389,0 7,5.61 "/>
                      </svg> </div>
                  </div>
                </div>
              </div>
              <div class="sidebar_section_content"> 
                
                <!-- Sidebar Slider -->
                <div class="sidebar_slider_container">
                  <div class="owl-carousel owl-theme sidebar_slider_events"> 
                    
                    <!-- Future Events Slider Item -->
                    <div class="owl-item"> 
                      
                      <!-- Future Events Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="event_date d-flex flex-column align-items-center justify-content-center">
                            <div class="event_day">13</div>
                            <div class="event_month">apr</div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Future Events Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="event_date d-flex flex-column align-items-center justify-content-center">
                            <div class="event_day">27</div>
                            <div class="event_month">apr</div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Future Events Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="event_date d-flex flex-column align-items-center justify-content-center">
                            <div class="event_day">02</div>
                            <div class="event_month">may</div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Future Events Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="event_date d-flex flex-column align-items-center justify-content-center">
                            <div class="event_day">09</div>
                            <div class="event_month">may</div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                    </div>
                    
                    <!-- Future Events Slider Item -->
                    <div class="owl-item"> 
                      
                      <!-- Future Events Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="event_date d-flex flex-column align-items-center justify-content-center">
                            <div class="event_day">13</div>
                            <div class="event_month">apr</div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Future Events Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="event_date d-flex flex-column align-items-center justify-content-center">
                            <div class="event_day">27</div>
                            <div class="event_month">apr</div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Future Events Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="event_date d-flex flex-column align-items-center justify-content-center">
                            <div class="event_day">02</div>
                            <div class="event_month">may</div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Future Events Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="event_date d-flex flex-column align-items-center justify-content-center">
                            <div class="event_day">09</div>
                            <div class="event_month">may</div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                    </div>
                    
                    <!-- Future Events Slider Item -->
                    <div class="owl-item"> 
                      
                      <!-- Future Events Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="event_date d-flex flex-column align-items-center justify-content-center">
                            <div class="event_day">13</div>
                            <div class="event_month">apr</div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Future Events Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="event_date d-flex flex-column align-items-center justify-content-center">
                            <div class="event_day">27</div>
                            <div class="event_month">apr</div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Future Events Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="event_date d-flex flex-column align-items-center justify-content-center">
                            <div class="event_day">02</div>
                            <div class="event_month">may</div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                      
                      <!-- Future Events Post -->
                      <div class="side_post"> <a href="post.html">
                        <div class="d-flex flex-row align-items-xl-center align-items-start justify-content-start">
                          <div class="event_date d-flex flex-column align-items-center justify-content-center">
                            <div class="event_day">09</div>
                            <div class="event_month">may</div>
                          </div>
                          <div class="side_post_content">
                            <div class="side_post_title">How Did van Gogh’s Turbulent Mind</div>
                            <small class="post_meta">Katy Liu<span>Sep 29</span></small> </div>
                        </div>
                        </a> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
