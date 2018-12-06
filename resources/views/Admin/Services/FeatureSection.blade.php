<div class="form-group col-md-12">
  <h2>Feature Section</h2>                    
  <div class="form-group col-md-12">
    <label for="feature_title">Title</label>
    <input type="text" class="form-control" id="feature_title" name="service_features[title]" value="<?php echo (isset($service_features['title'])?$service_features['title']:''); ?>" placeholder="Title">
  </div> 
  <div class="form-group col-md-12">
    <label for="feature_content">Content</label>
    <textarea class="form-control textarea" id="feature_content" name="service_features[content]" required placeholder="Content"><?php echo (isset($service_features['content'])?$service_features['content']:''); ?></textarea>
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
    <label for="feature_terms">Feature Terms</label>
    <select name="service_features[feature_terms][]" id="feature_terms" multiple="" class="form-control select2-multiple">
      <option value="">Select Term</option>
      <?php 
      $feature_terms = (isset($service_features['feature_terms']) && !empty($service_features['feature_terms'])?$service_features['feature_terms']:[]);
      $terms = DB::table('terms')->whereIn('term_id', $feature_terms)->get()->toArray();
      if (!empty($terms)) {
        foreach ($terms as $term) {
          echo '<option value="'.$term->term_id.'" selected>'.$term->term_title.'</option>';
        }
      }
      ?>
    </select>
  </div>
</div>