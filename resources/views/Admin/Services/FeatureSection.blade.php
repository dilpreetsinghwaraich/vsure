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
    <input type="file" class="form-control" id="feature_image" name="service_features[image]">
  </div>
  <div class="form-group col-md-12">
    <label for="feature_terms">Terms</label>
    <select name="service_features[terms][]" id="feature_terms" multiple="" class="form-control select2-multiple multiSelect">
      <option value="">Select Term</option>
      <?php
        foreach ($featureTerms as $featureTerm) {
          echo "<option value='".$featureTerm->term_id."' ".(isset($service_features['terms']) && is_array($service_features['terms']) && in_array($featureTerm->term_id, $service_features['terms'])?"selected":"").">".$featureTerm->term_title."</option>";
        }
      ?>
    </select>
  </div>
</div>