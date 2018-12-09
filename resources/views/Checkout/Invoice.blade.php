<div class="header">
  <div class="bg-color" style="background: url('<?php echo asset('/public'); ?>/images/home-back.jpg')">
    <div class="wrapper">
      <div class="banner-info thanku-page-banner banners-home wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
        <h2 class="text-center gallery"><?php echo $serviceForm->service_title; ?>- #<?php echo $serviceRequest->ticket; ?></h2>
      </div>
    </div>
  </div>
</div>
<section id="feature" class="thanks-page-content wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
  <div class="container">
    <?php echo $invoiceView; ?>
  </div>
</section>
