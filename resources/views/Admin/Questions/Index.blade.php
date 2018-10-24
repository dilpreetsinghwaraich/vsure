
      <div class="row">
        <div class="col-md-4">
          <h4 class="c-grey-900 mT-10 mB-30">Add Question</h4>
          <div class="row">
            <div class="masonry-item col-md-12">
              <div class="bgc-white p-20 bd">
                <div class="mT-30">
                  <?php echo Form::open(array('url' => 'admin/save/question/', 'method' => 'post')) ?>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="question_title">Question Title</label>
                        <input type="text" class="form-control" id="question_title" name="question_title" value="<?php echo old('question_title'); ?>" placeholder="Question Title">
                      </div>
                      <div class="form-group col-md-12">
                        <label for="question_content">Question Content</label>
                        <textarea class="form-control" id="question_content" name="question_content" required placeholder="Question Content"><?php echo old('question_content'); ?></textarea>
                      </div>
                      <div class="form-group col-md-12">
                        <label for="question_terms">Question Terms</label>
                        <select name="question_terms[]" id="question_terms" multiple="" class="form-control select2-multiple multiSelect">
                          <option value="">Select Term</option>
                          <?php
                            foreach ($terms as $term) {
                              echo "<option value='".$term->term_id."' ".(!empty(old('question_terms')) && in_array($term->term_id, old('question_terms'))?"selected":"").">".$term->term_title."</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>                                     
                    <button type="submit" class="btn btn-primary">Save</button>
                  </form>
                </div>
              </div>
            </div>
          </div> 
        </div>
        <div class="col-md-8">
          <h4 class="c-grey-900 mT-10 mB-30">All Questions</h4>
          <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Question Title</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sno = 1;
                foreach ($questions as $question)
                {
                  ?>
                  <tr>
                    <th scope="row"><?php echo $sno; ?></th>
                    <td><?php echo $question->question_title; ?></td>
                    <td>
                      <a href="<?php echo url('admin/edit/question/'.$question->question_id) ?>">Edit</a>
                      | <a href="<?php echo url('admin/delete/question/'.$question->question_id) ?>">Delete</a></td>
                  </tr>
                  <?php 
                  $sno++;
                }
                ?>
              </tbody>
            </table>
          </div>
          {{ $questions->links() }}
        </div>
      </div>          
    