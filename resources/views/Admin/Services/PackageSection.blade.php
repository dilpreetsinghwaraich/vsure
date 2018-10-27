<div class="form-group col-md-12">
  <h2>Package Section</h2>                    
  <div class="form-group col-md-12">
    <label for="package_title">Title</label>
    <input type="text" class="form-control" id="package_title" name="service_packages[title]" value="<?php echo (isset($service_packages['title'])?$service_packages['title']:''); ?>" placeholder="Title">
  </div> 
  <div class="form-group col-md-12">
    <label for="package_ids">Packages</label>
    <select name="service_packages[package_ids][]" id="package_ids" multiple="" class="form-control select2-multiple">
      <option value="">Select Package</option>
      <?php 
      $package_ids = (isset($service_packages['package_ids']) && !empty($service_packages['package_ids'])?$service_packages['package_ids']:[]);
      $packages = DB::table('packages')->whereIn('package_id', $package_ids)->get()->toArray();
      if (!empty($packages)) {
        foreach ($packages as $package) {
          echo '<option value="'.$package->package_id.'" selected>'.$package->package_title.'</option>';
        }
      }
      ?>
    </select>
  </div>
</div>