<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-btm-10">
  <?php
  $cls = 'service';
  if ($type == 'blog') {
    $cls = 'blog-post';
  }
  ?>

  @if (Session::has('success'))
    <div class="alert alert-info">{{ Session::get('success') }}</div>
    <?php Session::forget('success') ?>
  @endif
  @if (Session::has('warning'))
    <div class="alert alert-warning">{{ Session::get('warning') }}</div>
    <?php Session::forget('warning') ?>
  @endif
  @if (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
    <?php Session::forget('error') ?>
  @endif
  <div class="serviceRequestResponse">
  </div>
  <style type="text/css">
    .form-group{
      clear: both;
    }
  </style>

  <div class="banners-service-page <?php echo $cls; ?>">
    <div class="right-service-contact-form">
      <?php echo Form::open(array('url' => 'submit/service/enquery', 'method' => 'post')) ?>
      <div class="form-group">
        <label class="label">Name</label>
        <input class="name" type="text" class="form-control" placeholder="Name" value="<?php echo old('name') ?>" name="name" required="">
      </div>
      <div class="form-group">
        <label class="label">Email</label>
        <input class="email" type="email" class="form-control" placeholder="Email" value="<?php echo old('email') ?>" name="email" required="">
      </div>
      <div class="form-group">
        <label class="label">Phone</label>
        <input class="contact" type="text" class="form-controlc InputNumber" placeholder="Phone" value="<?php echo old('phone') ?>" name="phone" id="phone_otp_send" required=""> 
        <a href="javascript:void(0);" class="resend_code" <?php if(!empty(old('otp_code'))){?> style="display: block;" <?php }else{ ?>  style="display: none;" <?php } ?> onclick="$('#phone_otp_send').trigger('change');">Resend</a>
      </div>
      <div class="form-group otp_code_label" <?php if(!empty(old('otp_code'))){?> style="display: inline;" <?php }else{ ?>  style="display: none;" <?php } ?>>
        <label class="label " >Otp Code</label>
        <input class="otp_code" type="text" class="form-controlc InputNumber" <?php if(!empty(old('otp_code'))){?> style="display: block;" required <?php }else{ ?>  style="display: none;" <?php } ?> placeholder="OTP CODE" value="<?php echo old('otp_code') ?>" name="otp_code" id="otp_code">
      </div>
        <?php
        if ($type == 'blog') { 
          ?>
        <div class="form-group">
          <label class="label">Service</label>
          <select name="service_id" id="service_id" required="" class="form-control">
            <option value="">Please Select Service</option>
            <?php 
            if (!empty($services)) {
              foreach ($services as $service) {
                echo '<option value="'.$service->service_id.'" '.(old('service_id') == $service->service_id? 'selected':'').'>'.$service->service_title.'</option>';
              }
            }
            ?>
          </select>
        </div>
        <?php 
        }elseif($type == 'service'){
          ?>
          <input type="hidden" name="service_id" id="service_id" required="" value="<?php echo $service->service_id ?>" class="form-control">
          <?php
        }
        ?>
      <div class="form-group">
        <label class="label">City</label>
        <select name="city" id="city" required="" class="form-control">
          <option value="">Please Select City</option>
          <?php 
          if (!empty($states)) {
            foreach ($states as $state) {
              echo '<option value="'.$state->city_id.'" '.(old('city') == $state->city_id? 'selected':'').'>'.$state->city.'</option>';
            }
          }
          ?>
        </select>
      </div>
        <button type="submit" class="btn btn-info">Submit</button> 
      </form>
    </div>
  </div>
</div>