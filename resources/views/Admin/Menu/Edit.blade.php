
      <h4 class="c-grey-900 mT-10 mB-30">Feature</h4>
      <div class="row">
        <div class="masonry-item col-md-12">
          <div class="bgc-white p-20 bd">
            <div class="mT-30">
              <?php echo Form::open(array('url' => 'admin/update/menu/'.$menu->post_id, 'method' => 'post', 'files'=>true)) ?>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="post_title">Title</label>
                    <input type="text" class="form-control" id="post_title" name="post_title" value="<?php echo $menu->post_title; ?>" placeholder="Title">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="">Url</label>
                    <input type="text" class="form-control" id="post_slug" name="post_slug" value="<?php echo $menu->post_slug; ?>" placeholder="Title">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="post_parent">Parent</label>
                    <select name="post_parent" id="post_parent" class="form-control select2-multiple">
                      <option value="">Select Parent</option>
                      <optgroup label="Blogs" id="blog" class="post_parent_group">
                        <?php
                          foreach ($parentMenus as $parentMenu) {
                            echo "<option value='".$parentMenu->post_id."' ".(!empty($parentMenu->post_slug) && $parentMenu->post_id == $menu->post_parent?"selected":"").">".$parentMenu->post_title."</option>";
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
    