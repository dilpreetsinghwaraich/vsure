<?php 
if ($type == 'modal') {
  ?>
  <div class="col-xs-12 margin-btm-10">
    <style type="text/css">
      .banners-service-page{
        padding-bottom: 20px;
      }
    </style>
  <?php
}else{
  ?>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-btm-10">
  <?php
}
$cls = 'blog-post';
if ($type == 'blog' || $type == 'modal') {
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
  
  <style type="text/css">
    .form-group{
      clear: both;
    }
  </style>

  <div class="banners-service-page <?php echo $cls; ?>">
      <h4>Create Your Service Request</h4>
    <?php 
      if ($type == 'modal') {
        ?>
      <div class="service_Request_from">
      <?php 
      }else{ ?>
      <div class="right-service-contact-form service_Request_from">
      <?php } ?>
      <div class="serviceRequestResponse">
      </div>
      <?php $user = \Helper::getCurrentUser(); ?>
      <?php echo Form::open(array('url' => 'submit/service/enquery', 'method' => 'post')) ?>
      <?php 
        $show_otp_button = true;
        if (!empty($user->name)) {
          ?>
          <input type="hidden" value="<?php echo $user->name ?>" name="name">
          <?php
        }else{
          ?>
          <div class="form-group">
            <label class="label">Name</label>
            <input type="text" class="form-control name" placeholder="Name" value="<?php echo old('name') ?>" name="name" required="">
          </div>
          <?php
        }

        if (!empty($user->email)) {
          ?>
          <input type="hidden" value="<?php echo $user->email ?>" name="email">
          <?php
        }else{
          ?>
          <div class="form-group">
            <label class="label">Email</label>
            <input type="email" class="form-control email" placeholder="Email" value="<?php echo old('email') ?>" name="email" required="">
          </div>
          <?php
        }

        if (!empty($user->phone)) {
          $show_otp_button = false;
          ?>
          <input type="hidden" value="<?php echo $user->phone ?>" name="phone">
          <?php
        }else{
          ?>
          <div class="form-group">
            <label class="label">Phone</label>
            <input type="text" class="form-control InputNumber contact" placeholder="Phone" value="<?php echo old('phone') ?>" name="phone" required=""> 
          </div>
          <!-- <div class="form-group">
            <label class="label">Phone</label>
            <input type="text" class="form-controlc InputNumber phone_otp_send contact" placeholder="Phone" value="<?php echo old('phone') ?>" name="phone" required=""> 
            <a href="javascript:void(0);" class="resend_code" <?php if(!empty(old('otp_code'))){?> style="display: block;" <?php }else{ ?>  style="display: none;" <?php } ?> onclick="$('.phone_otp_send').trigger('change');">Resend</a>
          </div>
          <div class="form-group otp_code_label" <?php if(!empty(old('otp_code'))){?> style="display: inline;" <?php }else{ ?>  style="display: none;" <?php } ?>>
            <label class="label " >Otp Code</label>
            <input type="text" class="form-controlc otp_code InputNumber" <?php if(!empty(old('otp_code'))){?> required <?php }?>placeholder="OTP CODE" value="<?php echo old('otp_code') ?>" name="otp_code">
          </div> -->
          <?php
        }
        if ($type == 'blog') { 
          ?>
        <div class="form-group">
          <label class="label">Service</label>
          <select name="service_id" required="" class="form-control">
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
        }elseif($type == 'service' || $type == 'modal'){
          ?>
          <input type="hidden" name="service_id" required="" value="<?php echo $service->service_id ?>" class="form-control">
          <?php
        }
        ?>
      <div class="form-group">
        <?php //echo Helper::getCityStateCountriesView(old('country'), old('state'), old('city')) ?>        
      </div>
      <?php 
      /*if($show_otp_button == true)
      {
        ?>
        <button type="button" class="btn btn-info" id="send_otp" style="padding: 6px 12px;">Send OTP</button>
        <button type="submit" class="btn btn-info" id="continue_request" style="display: none;padding: 6px 12px;">Continue</button> 
        <?php
      }else
      {
        ?>
        <button type="submit" class="btn btn-info" style="padding: 6px 12px;">Continue</button> 
        <?php     
      }*/
      ?>
      <button type="submit" class="btn btn-info" style="padding: 6px 12px;">Continue</button>
      </form>
    </div>
  </div>
</div>