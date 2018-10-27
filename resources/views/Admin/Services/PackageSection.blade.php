<div class="form-group col-md-12">
  <h2>Package Section</h2>                    
  <div class="form-group col-md-12">
    <label for="package_title">Title</label>
    <input type="text" class="form-control" id="package_title" name="service_packages[title]" value="<?php echo (isset($service_packages['title'])?$service_packages['title']:''); ?>" placeholder="Title">
  </div> 
  <div class="form-group col-md-12">
    <label for="package_terms">Terms</label>
    <select name="service_packages[terms][]" id="package_terms" multiple="" class="form-control select2-multiple multiSelect">
      <option value="">Select Term</option>
      <?php
        foreach ($packageTerms as $packageTerm) {
          echo "<option value='".$packageTerm->term_id."' ".(isset($service_packages['terms']) && is_array($service_packages['terms']) && in_array($packageTerm->term_id, $service_packages['terms'])?"selected":"").">".$packageTerm->term_title."</option>";
        }
      ?>
    </select>
  </div>
</div>