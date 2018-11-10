
      <div class="row">
        <div class="col-md-4">
          <h4 class="c-grey-900 mT-10 mB-30">Add Feature</h4>
          <div class="row">
            <div class="masonry-item col-md-12">
              <div class="bgc-white p-20 bd">
                <div class="mT-30">
                  <?php echo Form::open(array('url' => 'admin/save/menu/', 'method' => 'post', 'files'=>true)) ?>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="post_title">Title</label>
                        <input type="text" class="form-control" id="post_title" name="post_title" value="<?php echo old('post_title'); ?>" placeholder="Title">
                      </div>
                      <div class="form-group col-md-12">
                        <label for="">Url</label>
                        <input type="text" class="form-control" id="post_slug" name="post_slug" value="<?php echo old('post_slug'); ?>" placeholder="Title">
                      </div>
                      <div class="form-group col-md-12">
                        <label for="post_parent">Parent</label>
                        <select name="post_parent" id="post_parent" class="form-control select2-multiple">
                          <option value="">Select Parent</option>
                            <?php
                              foreach ($parentMenus as $parentMenu) {
                                echo "<option value='".$parentMenu->post_id."' ".($parentMenu->post_id == old('post_parent')?"selected":"").">".$parentMenu->post_title."</option>";
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
          <h4 class="c-grey-900 mT-10 mB-30">All Menus</h4>
          <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sno = 1;
                foreach ($menus as $menu)
                {
                  ?>
                  <tr>
                    <th scope="row"><?php echo $sno; ?></th>
                    <td><?php echo $menu->post_title; ?></td>
                    <td>
                      <a href="<?php echo url('admin/edit/menu/'.$menu->post_id) ?>">Edit</a>
                      | <a href="<?php echo url('admin/delete/menu/'.$menu->post_id) ?>">Delete</a></td>
                  </tr>
                  <?php 
                  $sno++;
                }
                ?>
              </tbody>
            </table>
          </div>
          {{ $menus->links() }}
        </div>
      </div>          
    