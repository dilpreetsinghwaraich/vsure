<div class="logedin-order-page generate-pdf-print">
  <h2>View Order Details</h2>
  @if (Session::has('success'))
    <div class="alert alert-info">{{ Session::get('success') }}</div>
    <?php Session::forget('success') ?>
  @endif
  @if (Session::has('warning'))
    <div class="alert alert-warning">{{ Session::get('warning') }}</div>
    <?php Session::forget('warning') ?>
  @endif
  <div class="content-main order-details-page-main">
    <div class="row">
      <table class="table table-condensed">
        <thead>
          <tr>
            <th>Order Item</th>
            <th>Firm Name</th>
            <th>Order Status</th>
            <th>Payment Status</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="order-<?php echo $order->package_title; ?>"><?php echo $order->package_title; ?></td>
            <td><?php echo $order->customer_name; ?></td>
            <td class="status-<?php echo $order->order_status; ?>"><?php echo ucfirst($order->order_status); ?></td>
            <td class="status-<?php echo $order->amount_status; ?>"><?php echo ucfirst($order->amount_status); ?></td>
            <td><?php echo $order->order_date; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="order-details-page-main-inner col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <p>From : <span><b>Vsure Consulting India,</b></span>  
          244a, 2nd Floor, Tower, B, <br>
          Spaze Edge tower, Gurgoan-122001<br>
          Phone : 0928312309
          Email: info@vsurecfo.com</p>
      </div>
      <?php 
      $billing_address = json_decode($order->billing_address); 
      $mainAddress = [];
      $mainAddress[] = $billing_address->city;
      $mainAddress[] = $billing_address->state;
      $mainAddress[] = $billing_address->country;
      ?>
      <div class="order-details-page-main-inner col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <p>To : <span><b><?php echo $billing_address->name; ?>,</b></span> 
          <?php echo $billing_address->address; ?><br>
          <?php echo implode(',', $mainAddress); ?>(<?php echo $billing_address->postal_code; ?>)<br>
          Phone : <?php echo $billing_address->phone; ?><br>
          Email: <?php echo $billing_address->email; ?></p>
      </div>
      <div class="order-details-page-main-inner col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <p> <span><b>INVOICE  : <?php echo $order->invoice_id; ?></b></span>
          <?php
            if ($order->amount_status == 'pending') {
          ?>
            <span>Payment Due : <?php echo $order->order_sub_total; ?></span> 
          <?php }else{
            ?>
             <span>Payment : <?php echo $order->order_sub_total; ?></span> 
            <?php
          } ?>
            Payment Status  : <?php echo $order->amount_status; ?></p>
      </div>
    </div>
    <div class="row">
      <table class="table table-condensed">
        <thead>
          <tr>
            <th>Qty</th>
            <th>Product</th>
            <th>Description</th>
            <th>SubTotal</th>
            <th>Date</th>
          </tr>
        </thead>
        <?php 
          $package = json_decode($order->products_details);        
          $term = Helper::getPostTermByID($package->package_terms);
        ?>
        <tbody>
          <tr>            
            <td>1</td>
            <td class="order-<?php echo $order->package_title; ?>"><?php echo $term->term_title.' - '.$order->package_title; ?></td>
            <td ><?php echo strip_tags($package->package_content); ?></td>
            <td ><?php echo Helper::displayPrice($package); ?></td>
            <td style="white-space: nowrap;"><?php echo $order->order_date; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="order-details-page-main-inner col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h2 class="view-order-page-amount-due">AMOUNT DUE : <?php echo $order->order_date; ?></h2>
        <div class="order-view-payment-section">
          <p>Payment Method</p>
          <a href="#"><img src="<?php echo asset('public/images/razorpay.png') ?>" style="width:90px"></a> </div>
      </div>
      <div class="order-details-page-main-inner col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <table class="table table-condensed">
          <tbody>
            <tr>
              <td><b>Sub Total</b></td>
              <td><?php echo $order->order_sub_total; ?></td>
            </tr>
            <tr>
              <td><b>Grand Total</b></td>
              <td><?php echo $order->grand_total; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <?php
      if ($type != 'admin') {
        ?>
        <div class="row">
          <div class="order-details-page-main-inner col-lg-6 col-md-6 col-sm-6 col-xs-12"> </div>
          <div class="order-details-page-main-inner-bottom-btn col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?php
              if ($order->amount_status == 'pending') {
                ?>
                  <form action="{!!route('payment')!!}/<?php echo $order->invoice_id; ?>" method="POST" >
                      <script src="https://checkout.razorpay.com/v1/checkout.js"
                              data-key="{{ Config::get('razorpay.razor_key') }}"
                              data-amount="<?php echo $order->grand_total*100 ?>"
                              data-buttontext="Pay Amount"
                              data-name="<?php echo $order->package_title; ?>"
                              data-description="<?php echo strip_tags($package->package_content); ?>"
                              data-image="<?php echo asset('/public'); ?>/images/logo.png"
                              data-prefill.name="<?php echo $billing_address->name; ?>"
                              data-prefill.email="<?php echo $billing_address->email; ?>"
                              data-theme.color="#ff7529">
                      </script>
                      <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                  </form>
                <?php
              }
              ?>                           
              <button onclick="Javascript:window.open('<?php echo url('generate/print/'.$order->invoice_id) ?>','','')">Print</button>
              <button onclick="Javascript:window.open('<?php echo url('generate/pdf/'.$order->invoice_id) ?>','','')">Generate PDF</button>
          </div>
        </div>
          <?php
        }?> 
  </div>
</div>