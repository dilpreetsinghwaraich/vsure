 <!--HEADER-->
  <div class="">
    <div class="bg-color" style="background: url('<?php echo asset('/public'); ?>/images/home-back.jpg')">
      <div class="wrapper">
        <div class="banner-info banners-service-page wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
          <div class="container">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 margin-btm-10">
              <div class="left-content">
                <div class="row">
                  <?php echo $service->service_content; ?> </div>
              </div>
            </div>
            <?php echo Helper::SidebarPost('service', $service); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ HEADER--> 
  
  <!-- Feature start-->
  <section id="pvt-ltd-company" class="fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
    <div class="container">
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 margin-btm-10">
        <div class="pvt-ltd-company-main">
          <h2><?php echo (isset($service_question['title'])?$service_question['title']:'') ?></h2>
          <h3><?php echo (isset($service_question['content'])?$service_question['content']:'') ?></h3>
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">All</a></li>
            <?php
              if (!empty($question_tabs)) {
                foreach ($question_tabs as $question_tab) {
                  echo '<li><a data-toggle="tab" href="#'.$question_tab->term_slug.'">'.$question_tab->term_title.'</a></li>';
                }
              }
            ?>            
          </ul>
          <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
              <?php 
              if (!empty($questions)) {
                foreach ($questions as $question) {
                  ?>
                  <div class="panel-heading">
                    <h4 class="panel-title"> <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#home_<?php  echo $question->question_id; ?>"><?php  echo $question->question_title; ?> <span>+</span></a> </h4>
                  </div>
                  <div id="home_<?php  echo $question->question_id; ?>" class="panel-collapse collapse">
                    <div class="panel-body"> <span> <?php echo $question->question_content; ?> </span> </div>
                  </div>
                  <?php
                }
              }
              ?>
            </div>
            <?php
              if (!empty($question_tabs)) {
                foreach ($question_tabs as $question_tab) {
                  ?>
                  <div id="<?php echo $question_tab->term_slug?>" class="tab-pane fade">
                    <?php 
                      if (!empty($questions)) {
                        foreach ($questions as $question) {
                          $question_terms = \Helper::maybe_unserialize($question->question_terms);
                          if ($question_tab->term_id = $question_terms) {
                            ?>
                            <div class="panel-heading">
                              <h4 class="panel-title"> <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#<?php echo $question_tab->term_slug?>_<?php  echo $question->question_id; ?>"><?php  echo $question->question_title; ?> <span>+</span></a> </h4>
                            </div>
                            <div id="<?php echo $question_tab->term_slug?>_<?php  echo $question->question_id; ?>" class="panel-collapse collapse">
                              <div class="panel-body"> <span> <?php echo $question->question_content; ?> </span> </div>
                            </div>
                            <?php
                          }
                        }
                      }
                      ?>
                  </div>
                  <?php
                }
              }
            ?>  
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-btm-2">
        <div class="pvt-ltd-company-image">
          <div class="tab-content"> 
          <?php 
          if (isset($service_question['image']) && !empty($service_question['image'])) {
            ?>
            <img src="<?php echo asset('/'.$service_question['image']) ?>">
            <?php
          }else{
            ?>
            <img src="<?php echo asset('/public') ?>/images/image.png">
            <?php
          } ?>             

          </div>
        </div>
      </div>
    </div>
  </section>
  <!--feature end--> 
  <?php 
  if (isset($service_feature['image']) && !empty($service_feature['image'])) {
    $service_feature_bc = $service_feature['image'];
  }else{
    $service_feature_bc = 'public/images/service-back.jpg';
  }
  ?>
  <!--why-choose-pvt-ltd-start-->
  <section id="choose-pvt-ltd-company" class="fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;background-image: url('<?php echo url('/'.$service_feature_bc) ?>');">
    <div class="container">
      <h2><?php echo (isset($service_feature['title'])?$service_feature['title']:'') ?></h2>
      <p><?php echo (isset($service_feature['content'])?$service_feature['content']:'') ?></p>
      <hr class="bottom-line1">
    </div>
  </section>
  <!--why-choose-pvt-ltd-end--> 
  <?php
  if (!empty($features)) {
   ?>
  <!-- choose-pvt-ltd-main-start -->
    <section id="choose-pvt-ltd-main" class="wow fadeInUp delay-05s" style="visibility: hidden; animation-name: none;">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
              <?php             
                foreach ($features as $feature) {
                  ?>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="blog-sec">
                      <div class="blog-img img-responsive text-center"> <img src="<?php echo asset('/'.$feature->feature_image) ?>">
                        <h2><?php echo $feature->feature_title; ?></h2>
                        <p><?php echo $feature->feature_content; ?></p>
                      </div>
                    </div>
                  </div>
                  <?php
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php } ?>
  <!--choose-pvt-ltd-main-end-->
  
<?php 
if (isset($service_short_info['image']) && !empty($service_short_info['image'])) {
  $start_section_bc = $service_short_info['image'];
}else{
  $start_section_bc = 'public/images/service-back.jpg';
}
?>
  <section id="start-your-company" class="section-padding wow fadeInUp delay-05s" style="visibility: hidden; animation-name: none;background-image: url('<?php echo url('/'.$start_section_bc) ?>');">
    <div class="container">
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 margin-btm-10">
        <div class="row">
          <h2>
            <?php echo (isset($service_short_info['title'])?$service_short_info['title']:'') ?></h2>
          <?php echo (isset($service_short_info['content'])?$service_short_info['content']:'') ?> </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-btm-10">
        <div class="row">
          <div class="service-contact-form">
            <h2>Fillup your details and company name</h2>
            <input class="name" type="text" placeholder="Name" name="name" required>
            <input class="email" type="text" placeholder="Email" name="name" required>
            <input class="contact" type="text" placeholder="Company name" name="name" required>
            <a href="">Submit</a> </div>
        </div>
      </div>
    </div>
  </section>
  <section id="service-page-doc-table" class="section-padding wow fadeInUp delay-05s" style="visibility: hidden; animation-name: none;">
    <div class="container">
      <h2><?php echo (isset($service_document['title'])?$service_document['title']:'') ?></h2>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-btm-10">
        <table class="table table-condensed">
          <thead>
            <tr>
              <th style="min-width:150px;">Sr. No.</th>
              <th>Documents Of Promoters</th>
              <th>Documents & Details In Respect Of Company</th>
            </tr>
          </thead>
          <tbody>
          <?php 
          if (!empty($documents)) {
            foreach ($documents as $document) {
              ?>
                <tr>
                  <td><span><?php echo $document->document_title; ?></span></td>
                  <td><?php echo $document->document_promoter; ?></td>
                  <td><?php echo $document->document_company; ?></td>
                </tr>
              <?php
            }
          }
          ?>
          </tbody>
        </table>
        <h3>Note : All Documents lnck sdv sd,m sdvm sdvm sdv skd v</h3>
      </div>
    </div>
  </section>

  <section id="service-page-radial-progress-bar" class="section-padding wow fadeInUp delay-05s" style="visibility: hidden; animation-name: none;">
    <div class="container">
      <h2><?php echo (isset($service_process_results['section_title'])?$service_process_results['section_title']:'') ?></h2>
      <div class="row">
        <?php 
        $progress_bar = ['dark','green','brown','blue','black'];
        $progress_count = 0;
        if (!empty($process_results)) {
          foreach ($process_results as $process_result) {
            ?>
            <div class="col-md-2 col-sm-6">
              <div class="progress <?php echo $progress_bar[$progress_count]; ?>"> 
                <span class="progress-left"> 
                  <span class="progress-bar"></span> 
                </span> 
                <span class="progress-right"> 
                  <span class="progress-bar"></span> 
                </span>
                <div class="progress-value"><img src="<?php echo asset('/'.$process_result->process_image) ?>"></div>
              </div>
              <div class="progress-bar-text">
                <h3><?php echo $process_result->process_title; ?></h3>
                <h4><?php echo $process_result->process_subtitle; ?></h4>
                <p><?php echo $process_result->process_content; ?></p>
              </div>
            </div>
            <?php
            $progress_count++;
          }
        }
        ?>
      </div>
    </div>
  </section>
  <section id="service-pricing-section" class="section-padding wow fadeInUp delay-05s" style="visibility: hidden; animation-name: none;">
    <div class="container">
      <h2><?php echo (isset($service_package['title'])?$service_package['title']:''); ?></h2>
      <?php 
      if (!empty($packages)) {
        foreach ($packages as $package) {
          $cls = '';
          if ($package->is_featured) {
            $cls = 'featured';
          }
          ?>
            <div class="col-md-3">
              <div class="pricing-section-main <?php echo $cls; ?>">
                <h3><?php echo $package->package_title ?></h3>
                <h4><?php echo Helper::displayPrice($package); ?></h4>
                <p><?php echo $package->package_content ?></p>
                <a  href="#" class="dropdown-toggle" data-toggle="modal" data-target="#serviceRequestModal">Order Now</a>
              </div>
            </div>
          <?php
        }
      } ?>
    </div>
  </section>
  
  <!--testimonial start-->
  <section id="testimonial" class="wow fadeInUp delay-05s" style="visibility: hidden; animation-name: none;background-image: url('<?php echo url('/public') ?>/images/startup-back.jpg');">
    <div class="bg-testicolor1">
      <div class="container">
        <div class="row">
          <div class="col-lg-2"> </div>
          <div class="col-lg-8 col-md-12 text-center "> <img src="<?php echo asset('/public') ?>/images/icon.png">
            <p>We’re Here To Help Your Business Blast Off!<br>
              Through Creative Ideas, Innovation &amp; Sheer Determination</p>
          </div>
          <div class="col-lg-2"> </div>
        </div>
        <div class="row">
          <div class="col-lg-2"> </div>
          <div class="col-lg-8 text-center "> <a href="<?php echo url('/contact-us') ?>" target="_blank">
            <button>Let’s Get Started</button>
            </a>
            <h3></h3>
          </div>
          <div class="col-lg-2"> </div>
        </div>
      </div>
    </div>
  </section>
  <!--testimonial end--> 
  <div class="header">
  <div class="modal fade" id="serviceRequestModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Service Request</h4>
        </div>
        <div class="modal-body" style="display: inline-block;">
          <?php echo Helper::SidebarPost('modal', $service); ?>
        </div>
      </div>
      
    </div>
  </div>
</div>