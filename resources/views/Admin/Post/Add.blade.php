
      <h4 class="c-grey-900 mT-10 mB-30">Add Blog/Page</h4>
      <div class="row">
        <div class="masonry-item col-md-12">
          <div class="bgc-white p-20 bd">
            <div class="mT-30">
              <?php echo Form::open(array('url' => 'admin/save/post/', 'method' => 'post', 'files' => true)) ?>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="post_title">Title</label>
                    <input type="text" class="form-control" id="post_title" name="post_title" value="<?php echo old('post_title'); ?>" placeholder="Title">
                  </div>
                 
                  <div class="form-group col-md-12">
                    <label for="post_excerpt">Excerpt</label>
                    <textarea class="form-control" id="post_excerpt" name="post_excerpt" required placeholder="Content"><?php echo old('post_excerpt'); ?></textarea>
                  </div>

                  <div class="form-group col-md-12">
                    <label for="post_content">Content</label>
                    <textarea class="form-control" id="post_content" name="post_content" required placeholder="Content"><?php echo old('post_content'); ?></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control" id="image">                    
                  </div>
                  <div class="form-group col-md-12">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control select2-multiple multiSelect">
                      <option value="publish" <?php echo (old('status') == 'publish'?'selected':old('status') == ''?'selected':''); ?>>Publish</option>
                      <option value="draft" <?php echo (old('status') == 'draft'?'selected':''); ?>>Draft</option>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="post_type">Post Type</label>
                    <select name="post_type" id="post_type" class="form-control select2-multiple multiSelect">
                      <option value="blog" <?php echo (old('post_type') == 'blog'?'selected':old('post_type') == ''?'selected':''); ?>>Blog</option>
                      <option value="page" <?php echo (old('post_type') == 'page'?'selected':''); ?>>Page</option>
                    </select>
                  </div>
                </div>                                     
                <button type="submit" class="btn btn-primary">Save</button>
              </form>
            </div>
          </div>
        </div>
      </div>          
    