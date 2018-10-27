<div class="form-group col-md-12 processResultItem">  
  <div class="form-group col-md-12">
    <label for="feature_title">Title</label>
    <input type="text" class="form-control" id="feature_title" name="service_process_results[section_content][<?php echo $index ?>][title]" value="<?php echo (isset($service_process_result['title'])?$service_process_result['title']:''); ?>" placeholder="Title">
  </div>
  <div class="form-group col-md-12">
    <label for="feature_title">Sub Title</label>
    <input type="text" class="form-control" id="feature_title" name="service_process_results[section_content][<?php echo $index ?>][sub_title]" value="<?php echo (isset($service_process_result['sub_title'])?$service_process_result['sub_title']:''); ?>" placeholder="Sub Title">
  </div> 
  <div class="form-group col-md-12">
    <label for="feature_content">Content</label>
    <textarea class="form-control" id="feature_content" name="service_process_results[section_content][<?php echo $index ?>][content]" required placeholder="Content"><?php echo (isset($service_process_result['content'])?$service_process_result['content']:''); ?></textarea>
  </div>  
  <button type="button" class="btn btn-danger removeProcessResultItem">Remove Section</button>
</div>