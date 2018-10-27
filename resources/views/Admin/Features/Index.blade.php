
      <div class="row">
        <div class="col-md-4">
          <h4 class="c-grey-900 mT-10 mB-30">Add Feature</h4>
          <div class="row">
            <div class="masonry-item col-md-12">
              <div class="bgc-white p-20 bd">
                <div class="mT-30">
                  <?php echo Form::open(array('url' => 'admin/save/feature/', 'method' => 'post', 'files'=>true)) ?>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="feature_title">Title</label>
                        <input type="text" class="form-control" id="feature_title" name="feature_title" value="<?php echo old('feature_title'); ?>" placeholder="Title">
                      </div>
                      <div class="form-group col-md-12">
                        <label for="feature_content">Content</label>
                        <textarea class="form-control" id="feature_content" name="feature_content" required placeholder="Content"><?php echo old('feature_content'); ?></textarea>
                      </div>
                      <div class="form-group col-md-12">
                        <label for="question_terms">Image</label>
                        <input type="file" name="feature_image" class="form-control" required="" id="feature_image">
                      </div>
                      <div class="form-group col-md-12">
                        <label for="feature_terms">Terms</label>
                        <select name="feature_terms[]" id="feature_terms" multiple="" class="form-control select2-multiple multiSelect">
                          <option value="">Select Term</option>
                          <?php
                            foreach ($terms as $term) {
                              echo "<option value='".$term->term_id."' ".(!empty(old('feature_terms')) && in_array($term->term_id, old('feature_terms'))?"selected":"").">".$term->term_title."</option>";
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
          <h4 class="c-grey-900 mT-10 mB-30">All Features</h4>
          <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sno = 1;
                foreach ($features as $feature)
                {
                  ?>
                  <tr>
                    <th scope="row"><?php echo $sno; ?></th>
                    <td><?php echo $feature->feature_title; ?></td>
                    <td>
                      <?php if (!empty($feature->feature_image)) {
                        ?>
                        <img src="<?php echo asset('/').$feature->feature_image ?>" style="width:50px;height:50px;" alt="<?php echo $feature->feature_title; ?>">
                        <?php
                      } ?></td>
                    <td>
                      <a href="<?php echo url('admin/edit/feature/'.$feature->feature_id) ?>">Edit</a>
                      | <a href="<?php echo url('admin/delete/feature/'.$feature->feature_id) ?>">Delete</a></td>
                  </tr>
                  <?php 
                  $sno++;
                }
                ?>
              </tbody>
            </table>
          </div>
          {{ $features->links() }}
        </div>
      </div>          
    