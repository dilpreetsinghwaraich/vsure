
      <h4 class="c-grey-900 mT-10 mB-30">Edit Post</h4>
      <div class="row">
        <div class="masonry-item col-md-12">
          <div class="bgc-white p-20 bd">
            <div class="mT-30">
              <?php echo Form::open(array('url' => 'admin/update/post/'.$post->post_id, 'method' => 'post', 'files'=>true)) ?>
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
                    <textarea class="form-control" id="post_excerpt" name="post_excerpt" required placeholder="Content"><?php echo $post->post_excerpt; ?></textarea>
                  </div>

                  <div class="form-group col-md-12">
                    <label for="post_content">Content</label>
                    <textarea class="form-control" id="post_content" name="post_content" required placeholder="Content"><?php echo $post->post_content; ?></textarea>
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
                    <label for="term">Terms</label>
                    <select name="term" id="term" class="form-control select2-multiple multiSelect">
                      <option value="0">Select Term</option>
                      <?php
                        foreach ($terms as $term) {
                          echo "<option value='".$term->term_id."' ".($term->term_id = $post->term?"selected":"").">".$term->term_title."</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <?php
                  $post_meta_data = $post->post_meta_data;
                  ?>
                  <div class="form-group col-md-12">
                    <label for="post_seo_meta_title">Seo Meta Title</label>
                    <input type="text" class="form-control" id="post_seo_meta_title" name="post_meta_data[title]" value="<?php echo (isset($post_meta_data['title'])?$post_meta_data['title']:''); ?>" placeholder="Title">
                  </div>
                  
                  <div class="form-group col-md-12">
                    <label for="post_seo_meta_description">Seo Meta Desciption</label>
                    <textarea class="form-control" id="post_seo_meta_description" name="post_meta_data[description]" required placeholder="Content"><?php echo (isset($post_meta_data['description'])?$post_meta_data['description']:''); ?></textarea>
                  </div>
                </div>                                     
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>          
    