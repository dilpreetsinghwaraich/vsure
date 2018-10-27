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
    <label for="question_terms">Terms</label>
    <select name="service_questions[terms][]" id="question_terms" multiple="" class="form-control select2-multiple multiSelect">
      <option value="">Select Term</option>
      <?php
        foreach ($questionTerms as $questionTerm) {
          echo "<option value='".$questionTerm->term_id."' ".(isset($service_questions['terms']) && is_array($service_questions['terms']) && in_array($questionTerm->term_id, $service_questions['terms'])?"selected":"").">".$questionTerm->term_title."</option>";
        }
      ?>
    </select>
  </div>
  <div class="form-group col-md-12">
    <label for="question_image">Image</label>
    <input type="file" class="form-control" id="question_image" name="service_questions[image]">
  </div>
</div>