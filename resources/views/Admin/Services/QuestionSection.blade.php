<div class="form-group col-md-12">
  <h2>Question Section</h2>                    
  <div class="form-group col-md-12">
    <label for="question_title">Title</label>
    <input type="text" class="form-control" id="question_title" name="service_questions[title]" value="<?php echo (isset($service_questions['title'])?$service_questions['title']:''); ?>" placeholder="Title">
  </div> 
  <div class="form-group col-md-12">
    <label for="question_content">Content</label>
    <textarea class="form-control" id="question_content" name="service_questions[content]" required placeholder="Content"><?php echo (isset($service_questions['content'])?$service_questions['content']:''); ?></textarea>
  </div>
  <div class="form-group col-md-12">
    <label for="question_terms">Question Terms</label>
    <select name="service_questions[question_terms][]" id="question_terms" multiple="" class="form-control select2-multiple">
      <option value="">Select Term</option>
      <?php 
      $question_terms = (isset($service_questions['question_terms']) && !empty($service_questions['question_terms'])?$service_questions['question_terms']:[]);
      $terms = DB::table('terms')->whereIn('term_id', $question_terms)->get()->toArray();
      if (!empty($terms)) {
        foreach ($terms as $term) {
          echo '<option value="'.$term->term_id.'" selected>'.$term->term_title.'</option>';
        }
      }
      ?>
    </select>
  </div>
  <div class="form-group col-md-12">
    <label for="question_image">Image</label>
    <input type="file" class="form-control" id="question_image" onchange="jQuery('#question_image_hide').hide();" name="service_questions[image]">
    <?php if (isset($service_questions['image']) && !empty($service_questions['image'])) {
      ?>
      <img src="<?php echo asset('/').$service_questions['image'] ?>" style="width:150px;height:150px;" id="question_image_hide">
      <?php
    } ?>
    <input type="hidden" name="service_questions[old_image]" value="<?php echo (isset($service_questions['image'])?$service_questions['image']:''); ?>">
  </div>
</div>