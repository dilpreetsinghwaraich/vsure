
      <h4 class="c-grey-900 mT-10 mB-30">Edit Page</h4>
      <div class="row">
        <div class="masonry-item col-md-12">
          <div class="bgc-white p-20 bd">
            <div class="mT-30">
              <?php echo Form::open(array('url' => 'admin/update/page/'.$post->post_id, 'method' => 'post', 'files'=>true)) ?>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="post_title">Title</label>
                    <input type="text" class="form-control" id="post_title" name="post_title" value="<?php echo $post->post_title; ?>" placeholder="Title">
                  </div>

                  <div class="form-group col-md-12">
                    <label for="post_slug">Url</label>
                    <input type="text" class="form-control" id="post_slug" name="post_slug" value="<?php echo $post->post_slug; ?>" placeholder="Url">
                  </div>
                 
                  <div class="form-group col-md-12">
                    <label for="post_excerpt">Excerpt</label>
                    <textarea class="form-control textarea" id="post_excerpt" name="post_excerpt" required placeholder="Content"><?php echo $post->post_excerpt; ?></textarea>
                  </div>

                  <div class="form-group col-md-12">
                    <label for="post_content">Content</label>
                    <textarea class="form-control textarea" id="post_content" name="post_content" required placeholder="Content"><?php echo $post->post_content; ?></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control" onchange="jQuery('#feature_image_hide').hide();" id="image">
                    <?php if (!empty($post->image)) {
                      ?>
                      <img src="<?php echo asset('/').$post->image ?>" style="width:150px;height:150px;" id="feature_image_hide" alt="<?php echo $post->post_title; ?>">
                      <?php
                    } ?>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control select2-multiple multiSelect">
                      <option value="publish" <?php echo ($post->status == 'publish'?'selected':$post->status == ''?'selected':''); ?>>Publish</option>
                      <option value="draft" <?php echo ($post->status == 'draft'?'selected':''); ?>>Draft</option>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="template">Template</label>
                    <select name="template" id="template" class="form-control select2-multiple multiSelect">
                      <option value="Template.SinglePage" <?php echo ($post->template == 'Template.SinglePage'?'selected':$post->template == ''?'selected':''); ?>>Default</option>
                      <option value="Template.AboutUs" <?php echo ($post->template == 'Template.AboutUs'?'selected':''); ?>>About Us</option>
                      <option value="Template.ContactUs" <?php echo ($post->template == 'Template.ContactUs'?'selected':''); ?>>Contact Us</option>
                    </select>
                  </div>
                </div>                                     
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>          
    