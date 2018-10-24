
      <h4 class="c-grey-900 mT-10 mB-30">Feature</h4>
      <div class="row">
        <div class="masonry-item col-md-12">
          <div class="bgc-white p-20 bd">
            <div class="mT-30">
              <?php echo Form::open(array('url' => 'admin/update/feature/'.$feature->feature_id, 'method' => 'post', 'files'=>true)) ?>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="feature_title">Title</label>
                    <input type="text" class="form-control" id="feature_title" name="feature_title" value="<?php echo $feature->feature_title ?>" placeholder="Title">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="feature_content">Content</label>
                    <textarea class="form-control" id="feature_content" name="feature_content" required placeholder="Content"><?php echo $feature->feature_content ?></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="feature_image">Image</label>
                    <input type="file" name="feature_image" class="form-control" onchange="jQuery('#feature_image_hide').hide();" required="" id="feature_image">
                    <?php if (!empty($feature->feature_image)) {
                      ?>
                      <img src="<?php echo asset('/').$feature->feature_image ?>" style="width:150px;height:150px;" id="feature_image_hide" alt="<?php echo $feature->feature_title; ?>">
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
    