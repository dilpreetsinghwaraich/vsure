
      <h4 class="c-grey-900 mT-10 mB-30">Edit Post</h4>
      <div class="row">
        <div class="masonry-item col-md-12">
          <div class="bgc-white p-20 bd">
            <div class="mT-30">
              <?php echo Form::open(array('url' => 'admin/update/slider/'.$slider->post_id, 'method' => 'post', 'files'=>true)) ?>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="post_title">Title</label>
                    <input type="text" class="form-control" id="post_title" name="post_title" value="<?php echo $slider->post_title; ?>" placeholder="Title">
                  </div>
                 
                  <div class="form-group col-md-12">
                    <label for="post_content">Content</label>
                    <textarea class="form-control textarea" id="post_content" name="post_content" required placeholder="Content"><?php echo $slider->post_content; ?></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control" onchange="jQuery('#feature_image_hide').hide();" id="image">
                    <?php if (!empty($slider->image)) {
                      ?>
                      <img src="<?php echo asset('/').$slider->image ?>" style="width:150px;height:150px;" id="feature_image_hide" alt="<?php echo $slider->post_title; ?>">
                      <?php
                    } ?>
                  </div>
                </div>                                     
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>          
    