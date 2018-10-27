<div class="form-group col-md-12">
  <h2>Process Results Section</h2>
  <div class="form-group col-md-12" style="padding: 30px 0px;">
    <label for="section_title">Section Title</label>
    <input type="text" class="form-control" id="section_title" name="service_process_results[section_title]" value="<?php echo (isset($service_process_results['section_title'])?$service_process_results['section_title']:''); ?>" placeholder="Title">
  </div>  
  <div class="form-group col-md-12">
    <label for="process_ids">Process Results</label>
    <select name="service_process_results[process_ids][]" id="process_ids" multiple="" class="form-control select2-multiple">
      <option value="">Select</option>
      <?php 
      $process_ids = (isset($service_process_results['process_ids']) && !empty($service_process_results['process_ids'])?$service_process_results['process_ids']:[]);
      $process = DB::table('process_results')->whereIn('process_id', $process_ids)->get()->toArray();
      if (!empty($process)) {
        foreach ($process as $proces) {
          echo '<option value="'.$proces->process_id.'" selected>'.$proces->process_title.'</option>';
        }
      }
      ?>
    </select>
  </div>
</div>