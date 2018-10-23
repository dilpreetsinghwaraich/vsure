
      <div class="row">
        <div class="col-md-4">
          <h4 class="c-grey-900 mT-10 mB-30">Add Term</h4>
          <div class="row">
            <div class="masonry-item col-md-12">
              <div class="bgc-white p-20 bd">
                <div class="mT-30">
                  <?php echo Form::open(array('url' => 'admin/save/term/', 'method' => 'post')) ?>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="term_title">Term Title</label>
                        <input type="text" class="form-control" id="term_title" name="term_title" value="<?php echo old('term_title'); ?>" placeholder="Term Title">
                      </div>
                      <div class="form-group col-md-12">
                        <label for="term_content">Term Content</label>
                        <textarea class="form-control" id="term_content" name="term_content" required placeholder="Term Content"><?php echo old('term_content'); ?></textarea>
                      </div>
                      <div class="form-group col-md-12">
                        <label for="term_type">Term Type</label>
                        <select class="form-control" id="term_type" name="term_type" required >
                          <option value="">Select</option>
                          <option value="question" <?php echo (old('term_type') == 'question'?'selected':''); ?>>Question</option>
                          <option value="feature" <?php echo (old('term_type') == 'feature'?'selected':''); ?>>Feature</option>
                          <option value="package" <?php echo (old('term_type') == 'package'?'selected':''); ?>>Package</option>
                          <option value="document" <?php echo (old('term_type') == 'document'?'selected':''); ?>>Document</option>
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
          <h4 class="c-grey-900 mT-10 mB-30">All Terms</h4>
          <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Term Title</th>
                  <th scope="col">Term Type</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sno = 1;
                foreach ($terms as $term)
                {
                  ?>
                  <tr>
                    <th scope="row"><?php echo $sno; ?></th>
                    <td><?php echo $term->term_title; ?></td>
                    <td><?php echo ucfirst($term->term_type); ?></td>
                    <td>
                      <a href="<?php echo url('admin/edit/term/'.$term->term_id) ?>">Edit</a>
                      | <a href="<?php echo url('admin/delete/term/'.$term->term_id) ?>">Delete</a></td>
                  </tr>
                  <?php 
                  $sno++;
                }
                ?>
              </tbody>
            </table>
          </div>
          {{ $terms->links() }}
        </div>
      </div>          
    