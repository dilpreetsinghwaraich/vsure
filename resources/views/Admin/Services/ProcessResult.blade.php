<div class="form-group col-md-12">
  <h2>Process Results Section</h2>
  <div class="form-group col-md-12" style="padding: 30px 0px;">
    <label for="section_title">Section Title</label>
    <input type="text" class="form-control" id="section_title" name="service_process_results[section_title]" value="<?php echo (isset($service_process_results['section_title'])?$service_process_results['section_title']:''); ?>" placeholder="Title">
  </div>  
  <div class="form-group col-md-12">
    <label for="process_terms">Process Result Terms</label>
    <select name="service_process_results[process_terms][]" id="process_terms" multiple="" class="form-control select2-multiple">
      <option value="">Select Term</option>
      <?php 
      $process_terms = (isset($service_process_results['process_terms']) && !empty($service_process_results['process_terms'])?$service_process_results['process_terms']:[]);
      $terms = DB::table('terms')->whereIn('term_id', $process_terms)->get()->toArray();
      if (!empty($terms)) {
        foreach ($terms as $term) {
          echo '<option value="'.$term->term_id.'" selected>'.$term->term_title.'</option>';
        }
      }
      ?>
    </select>
  </div>
</div>