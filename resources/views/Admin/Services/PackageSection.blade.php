<div class="form-group col-md-12">
  <h2>Package Section</h2>                    
  <div class="form-group col-md-12">
    <label for="package_title">Title</label>
    <input type="text" class="form-control" id="package_title" name="service_packages[title]" value="<?php echo (isset($service_packages['title'])?$service_packages['title']:''); ?>" placeholder="Title">
  </div> 
  <div class="form-group col-md-12">
    <label for="package_terms">Package Terms</label>
    <select name="service_packages[package_terms][]" id="package_terms" multiple="" class="form-control select2-multiple">
      <option value="">Select Term</option>
      <?php 
      $package_terms = (isset($service_packages['package_terms']) && !empty($service_packages['package_terms'])?$service_packages['package_terms']:[]);
      $terms = DB::table('terms')->whereIn('term_id', $package_terms)->get()->toArray();
      if (!empty($terms)) {
        foreach ($terms as $term) {
          echo '<option value="'.$term->term_id.'" selected>'.$term->term_title.'</option>';
        }
      }
      ?>
    </select>
  </div>
</div>