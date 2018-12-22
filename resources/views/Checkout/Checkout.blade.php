<div class="header">
   <div class="bg-color" style="background: url('<?php echo asset('/public'); ?>/images/home-back.jpg')">
      <div class="wrapper">
       <div class="banner-info thanku-page-banner banners-home wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
          <h1 class="bnr-title  text-center gallery">Checkout</h1>
          <h2 class="text-center gallery"><?php echo $serviceForm->service_title; ?>- #<?php echo $serviceRequest->ticket; ?></h2>
        </div>
      </div>
  </div>
</div>
<section id="feature" class="thanks-page-content wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
  <div class="container">
    <?php echo Form::open(array('url' => 'complete/order/'.$package->package_id.'?ticket='.$serviceRequest->ticket, 'method' => 'post', 'files'=>true)) ?>
      <div class="logedin-profile-page">
        <div class="row"> 
          <div class="col-md-7">
            @if (Session::has('success'))
              <div class="alert alert-info">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('warning'))
              <div class="alert alert-warning">{{ Session::get('warning') }}</div>
            @endif
            @if (Session::has('error'))
              <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            <h2>Billing Details</h2>
              <div class="form-group">
                <label for="name">Name</label>
                <input class="name form-control" type="name" placeholder="Name" required="" value="<?php echo $profile->name ?>" name="name">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input class="email form-control" type="email" placeholder="Email" value="<?php echo $profile->email ?>" name="email" required>
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input class="phone InputNumber form-control" type="text" placeholder="Phone" value="<?php echo $profile->phone ?>" name="phone" required>
              </div>

              <div class="form-group">
                <label for="company">Company</label>
                <input class="company form-control" type="text" placeholder="Company" value="<?php echo $profile->company ?>" name="company">
              </div>
              <div class="form-group">
                <label for="country">Country</label>
                <select class="form-control" name="country" id="country">
                  <option value="India" selected="">India</option>
                </select>
              </div>
              <div class="form-group">
                <label for="state">State</label>
                <select name="state" id="state" required="" class="form-control">
                  <option value="">---Select State---</option>
                  <?php 
                  if (!empty($states)) {
                    foreach ($states as $state)
                    {
                      echo '<option value="'.$state->state.'" '.($profile->state == $state->state?'selected':'').'>'.$state->state.'</option>';
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="city">City</label>
                <select name="city" id="city" required="" class="form-control">
                  <option value="">---Select City---</option>
                  <?php 
                  if (!empty($profile->city)) {
                    ?>
                    <option value="<?php echo $profile->city ?>" selected><?php echo $profile->city ?></option>
                    <?php
                  }
                  ?>  
                </select>
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <textarea class="address form-control" required="" placeholder="Address" name="address"><?php echo $profile->address ?></textarea>
              </div>      
              <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input class="postal_code InputNumber form-control" type="text" required="" placeholder="Postal Code" value="<?php echo $profile->postal_code ?>" name="postal_code">
              </div>            
          </div>
          <div class="col-md-5">
            <h2>Package Details</h2>
            <div class="form-group">
              <label for="postal_code">Package Name:- </label>
              <?php echo $package->package_title; ?>
            </div>
            <div class="form-group">
              <label for="postal_code">Package Price:- </label>
              <?php echo Helper::displayPrice($package); ?>
            </div>
            <div class="form-group">
              <label for="postal_code">Payment Method:- </label>
              <label><input type="radio" name="payment_method" value="razorpay" class="form-control"><img src="<?php echo asset('public/images/razorpay.png') ?>" style="width:90px"></label>
              <label><input type="radio" name="payment_method" value="paypal" class="form-control"><img src="<?php echo asset('public/images/paypal.png') ?>" style="width:90px"></label>
            </div>
            <div class="form-group">
                <input class="btn btn-success" type="submit" value="Process Order">
              </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</section>
