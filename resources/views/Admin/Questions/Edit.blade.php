
      <h4 class="c-grey-900 mT-10 mB-30">Question</h4>
      <div class="row">
        <div class="masonry-item col-md-12">
          <div class="bgc-white p-20 bd">
            <div class="mT-30">
              <?php echo Form::open(array('url' => 'admin/update/question/'.$question->question_id, 'method' => 'post')) ?>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="question_title">Question Title</label>
                    <input type="text" class="form-control" id="question_title" name="question_title" value="<?php echo $question->question_title ?>" placeholder="Question Title">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="question_content">Question Content</label>
                    <textarea class="form-control" id="question_content" name="question_content" required placeholder="Question Content"><?php echo $question->question_content ?></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="question_terms">Question Terms</label>
                    <select name="question_terms" id="question_terms" class="form-control select2-multiple multiSelect">
                      <option value="">Select Term</option>
                      <?php
                        foreach ($terms as $term) {
                          echo "<option value='".$term->term_id."' ".($term->term_id = $question->question_terms?"selected":"").">".$term->term_title."</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>                                     
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>          
    