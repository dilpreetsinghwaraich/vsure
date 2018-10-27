
      <div class="row">
        <div class="col-md-4">
          <h4 class="c-grey-900 mT-10 mB-30">Add Process Result</h4>
          <div class="row">
            <div class="masonry-item col-md-12">
              <div class="bgc-white p-20 bd">
                <div class="mT-30">
                  <?php echo Form::open(array('url' => 'admin/save/process/result/', 'method' => 'post', 'files'=>true)) ?>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="process_title">Title</label>
                        <input type="text" class="form-control" id="process_title" name="process_title" value="<?php echo old('process_title'); ?>" placeholder="Title">
                      </div>
                      <div class="form-group col-md-12">
                        <label for="process_subtitle">Sub Title</label>
                        <input type="text" class="form-control" id="process_subtitle" name="process_subtitle" value="<?php echo old('process_subtitle'); ?>" placeholder="Title">
                      </div>
                      <div class="form-group col-md-12">
                        <label for="process_content">Content</label>
                        <textarea class="form-control" id="process_content" name="process_content" required placeholder="Content"><?php echo old('process_content'); ?></textarea>
                      </div>
                      <div class="form-group col-md-12">
                        <label for="process_image">Image</label>
                        <input type="file" name="process_image" class="form-control" required="" id="process_image">
                      </div>
                      <div class="form-group col-md-12">
                        <label for="process_terms">Terms</label>
                        <select name="process_terms[]" id="process_terms" multiple="" class="form-control select2-multiple multiSelect">
                          <option value="">Select Term</option>
                          <?php
                            foreach ($terms as $term) {
                              echo "<option value='".$term->term_id."' ".(!empty(old('process_terms')) && in_array($term->term_id, old('process_terms'))?"selected":"").">".$term->term_title."</option>";
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
          <h4 class="c-grey-900 mT-10 mB-30">All Process Results</h4>
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
                foreach ($processResults as $processResult)
                {
                  ?>
                  <tr>
                    <th scope="row"><?php echo $sno; ?></th>
                    <td><?php echo $processResult->process_title; ?></td>
                    <td>
                      <?php if (!empty($processResult->process_image)) {
                        ?>
                        <img src="<?php echo asset('/').$processResult->process_image ?>" style="width:50px;height:50px;" alt="<?php echo $processResult->process_title; ?>">
                        <?php
                      } ?></td>
                    <td>
                      <a href="<?php echo url('admin/edit/process/result/'.$processResult->process_id) ?>">Edit</a>
                      | <a href="<?php echo url('admin/delete/process/result/'.$processResult->process_id) ?>">Delete</a></td>
                  </tr>
                  <?php 
                  $sno++;
                }
                ?>
              </tbody>
            </table>
          </div>
          {{ $processResults->links() }}
        </div>
      </div>          
    