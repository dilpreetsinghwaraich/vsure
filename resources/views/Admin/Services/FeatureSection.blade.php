<div class="form-group col-md-12">
  <h2>Feature Section</h2>                    
  <div class="form-group col-md-12">
    <label for="feature_title">Title</label>
    <input type="text" class="form-control" id="feature_title" name="service_features[title]" value="<?php echo (isset($service_features['title'])?$service_features['title']:''); ?>" placeholder="Title">
  </div> 
  <div class="form-group col-md-12">
    <label for="feature_content">Content</label>
    <textarea class="form-control" id="feature_content" name="service_features[content]" required placeholder="Content"><?php echo (isset($service_features['content'])?$service_features['content']:''); ?></textarea>
  </div>
  <div class="form-group col-md-12">
    <label for="feature_image">Background Image</label>
    <input type="file" class="form-control" id="feature_image" name="service_features[image]" onchange="jQuery('#service_features_hide').hide();">
    <?php if (isset($service_features['image']) && !empty($service_features['image'])) {
      ?>
      <img src="<?php echo asset('/').$service_features['image'] ?>" style="width:150px;height:150px;" id="service_features_hide">
      <?php
    } ?>
    <input type="hidden" name="service_features[old_image]" value="<?php echo (isset($service_features['image'])?$service_features['image']:''); ?>">
  </div>
  <div class="form-group col-md-12">
    <label for="feature_terms">Features</label>
    <select name="service_features[feature_ids][]" id="feature_ids" multiple="" class="form-control select2-multiple">
      <option value="">Select Features</option>
      <?php 
      $feature_ids = (isset($service_features['feature_ids']) && !empty($service_features['feature_ids'])?$service_features['feature_ids']:[]);
      $features = DB::table('features')->whereIn('feature_id', $feature_ids)->get()->toArray();
      if (!empty($features)) {
        foreach ($features as $feature) {
          echo '<option value="'.$feature->feature_id.'" selected>'.$feature->feature_title.'</option>';
        }
      }
      ?>
    </select>
  </div>
</div>