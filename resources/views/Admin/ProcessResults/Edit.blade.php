
      <h4 class="c-grey-900 mT-10 mB-30">Feature</h4>
      <div class="row">
        <div class="masonry-item col-md-12">
          <div class="bgc-white p-20 bd">
            <div class="mT-30">
              <?php echo Form::open(array('url' => 'admin/update/process/result/'.$processResult->process_id, 'method' => 'post', 'files'=>true)) ?>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="process_title">Title</label>
                    <input type="text" class="form-control" id="process_title" name="process_title" value="<?php echo $processResult->process_title ?>" placeholder="Title">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="process_subtitle">Sub Title</label>
                    <input type="text" class="form-control" id="process_subtitle" name="process_subtitle" value="<?php echo $processResult->process_subtitle ?>" placeholder="Title">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="process_content">Content</label>
                    <textarea class="form-control" id="process_content" name="process_content" required placeholder="Content"><?php echo $processResult->process_content ?></textarea>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="process_image">Image</label>
                    <input type="file" name="process_image" class="form-control" onchange="jQuery('#feature_image_hide').hide();" id="process_image">
                    <?php if (!empty($processResult->process_image)) {
                      ?>
                      <img src="<?php echo asset('/').$processResult->process_image ?>" style="width:150px;height:150px;" id="feature_image_hide" alt="<?php echo $processResult->process_title; ?>">
                      <?php
                    } ?>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="process_terms">Terms</label>
                    <select name="process_terms[]" id="process_terms" multiple="" class="form-control select2-multiple multiSelect">
                      <option value="">Select Term</option>
                      <?php
                        foreach ($terms as $term) {
                          echo "<option value='".$term->term_id."' ".(is_array($processResult->process_terms) && in_array($term->term_id, $processResult->process_terms)?"selected":"").">".$term->term_title."</option>";
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
    