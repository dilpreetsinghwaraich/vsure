
      <h4 class="c-grey-900 mT-10 mB-30">Edit Term</h4>
      <div class="row">
        <div class="masonry-item col-md-12">
          <div class="bgc-white p-20 bd">
            <div class="mT-30">
              <?php echo Form::open(array('url' => 'admin/update/term/'.$term->term_id, 'method' => 'post')) ?>
                <div class="form-row">
                  <div class="form-group col-md-12">
                        <label for="term_title">Term Title</label>
                        <input type="text" class="form-control" id="term_title" name="term_title" value="<?php echo $term->term_title; ?>" placeholder="Term Title">
                      </div>
                      <div class="form-group col-md-12">
                        <label for="term_content">Term Content</label>
                        <textarea class="form-control textarea" id="term_content" name="term_content" required placeholder="Term Content"><?php echo $term->term_content; ?></textarea>
                      </div>
                      <div class="form-group col-md-12">
                        <label for="term_type">Term Type</label>
                        <select class="form-control" id="term_type" name="term_type" required >
                          <option value="">Select</option>
                          <option value="blog" <?php echo ($term->term_type == 'blog'?'selected':''); ?>>Blog</option>
                          <option value="question" <?php echo ($term->term_type == 'question'?'selected':''); ?>>Question</option>
                          <option value="feature" <?php echo ($term->term_type == 'feature'?'selected':''); ?>>Feature</option>
                          <option value="package" <?php echo ($term->term_type == 'package'?'selected':''); ?>>Package</option>
                          <option value="document" <?php echo ($term->term_type == 'document'?'selected':''); ?>>Document</option>
                          <option value="process" <?php echo ($term->term_type == 'process'?'selected':''); ?>>Process Result</option>
                        </select>
                      </div>
                </div>                                     
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>          
    