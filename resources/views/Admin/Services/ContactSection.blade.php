<div class="form-group col-md-12">
  <h2>Contact Section</h2>                    
  <div class="form-group col-md-12">
    <label for="contact_title">Title</label>
    <input type="text" class="form-control" id="contact_title" name="service_short_info[title]" value="<?php echo (isset($service_short_info['title'])?$service_short_info['title']:''); ?>" placeholder="Title">
  </div> 
  <div class="form-group col-md-12">
    <label for="contact_content">Content</label>
    <textarea class="form-control textarea" id="contact_content" name="service_short_info[content]" required placeholder="Content"><?php echo (isset($service_short_info['content'])?$service_short_info['content']:''); ?></textarea>
  </div>
  <div class="form-group col-md-12">
    <label for="contact_image">Background Image</label>
    <input type="file" class="form-control" id="contact_image" name="service_short_info[image]" onchange="jQuery('#service_short_info_hide').hide();">
    <?php if (isset($service_short_info['image']) && !empty($service_short_info['image'])) {
      ?>
      <img src="<?php echo asset('/').$service_short_info['image'] ?>" style="width:150px;height:150px;" id="service_short_info_hide">
      <?php
    } ?>
    <input type="hidden" name="service_short_info[old_image]" value="<?php echo (isset($service_short_info['image'])?$service_short_info['image']:''); ?>">
  </div>
</div>