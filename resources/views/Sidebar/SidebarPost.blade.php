<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-btm-10">
  <?php
  $cls = 'service';
  if ($type == 'blog') {
    $cls = 'blog-post';
  }
  ?>
  <div class="banners-service-page <?php echo $cls; ?>">
    <div class="right-service-contact-form">
      <?php echo Form::open(array('url' => 'submit/service/enquery', 'method' => 'post')) ?>
        <input class="name" type="text" class="form-control" placeholder="Name" value="<?php echo old('name') ?>" name="name" required="">
        <input class="email" type="email" class="form-control" placeholder="Email" value="<?php echo old('email') ?>" name="email" required="">
        <input class="contact" type="text" class="form-controlc InputNumber" placeholder="Phone" value="<?php echo old('phone') ?>" name="phone" required="">
        <?php
        if ($type == 'blog') { 
          ?>
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
        <?php 
        }elseif($type == 'service'){
          ?>
          <input type="hidden" name="service_id" id="service_id" required="" value="<?php echo $service->service_id ?>" class="form-control">
          <?php
        }
        ?>
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
        <button type="submit" class="btn btn-info">Submit</button> 
      </form>
    </div>
  </div>
</div>