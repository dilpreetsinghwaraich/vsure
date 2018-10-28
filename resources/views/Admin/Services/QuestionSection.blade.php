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
    <label for="question_ids">Questions</label>
    <select name="service_questions[question_ids][]" id="question_ids" multiple="" class="form-control select2-multiple">
      <option value="">Select Questions</option>
      <?php 
      $question_ids = (isset($service_questions['question_ids']) && !empty($service_questions['question_ids'])?$service_questions['question_ids']:[]);
      $questions = DB::table('questions')->whereIn('question_id', $question_ids)->get()->toArray();
      if (!empty($questions)) {
        foreach ($questions as $question) {
          echo '<option value="'.$question->question_id.'" selected>'.$question->question_title.'</option>';
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