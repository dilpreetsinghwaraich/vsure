 <!--HEADER-->
  <div class="">
  <div class="bg-color" style="background: url('<?php echo asset('/public'); ?>/images/home-back.jpg')">
    <div class="wrapper">
      <div class="banner-info about-page-banner wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
        <h1 class="bnr-title  text-center gallery">Service Packages</h1>
        <h2 class="text-center gallery"><?php echo $serviceForm->service_title; ?>- #<?php echo $serviceRequest->ticket; ?></h2>
      </div>
    </div>
  </div>
</div>
  <!--/ HEADER--> 
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
                <?php 
                  if (empty(session('token'))) {
                    ?>
                      <a  href="#" class="dropdown-toggle" data-toggle="modal" data-target="#loginModal">Order Now</a>
                    <?php
                  }else
                  {
                  ?>
                    <a href="<?php echo url('checkout/'.$package->package_id); ?>?ticket=<?php echo $serviceRequest->ticket; ?>">Order Now</a>
                  <?php } ?>
              </div>
            </div>
          <?php
        }
      } ?>
    </div>
  </section>
  