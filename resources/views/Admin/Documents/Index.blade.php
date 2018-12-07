
      <div class="row">
        <div class="col-md-4">
          <h4 class="c-grey-900 mT-10 mB-30">Add Document</h4>
          <div class="row">
            <div class="masonry-item col-md-12">
              <div class="bgc-white p-20 bd">
                <div class="mT-30">
                  <?php echo Form::open(array('url' => 'admin/save/document/', 'method' => 'post')) ?>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="document_title">Title</label>
                        <input type="text" class="form-control" id="document_title" name="document_title" value="<?php echo old('document_title'); ?>" placeholder="Title">
                      </div>
                      <div class="form-group col-md-12">
                        <label for="document_promoter">Document of promoter</label>
                        <textarea class="form-control textarea" id="document_promoter" name="document_promoter" required placeholder="Document of promoter"><?php echo old('document_promoter'); ?></textarea>
                      </div>
                      <div class="form-group col-md-12">
                        <label for="document_company">Document of company</label>
                        <textarea class="form-control textarea" id="document_company" name="document_company" required placeholder="Document of company"><?php echo old('document_company'); ?></textarea>
                      </div>
                      <div class="form-group col-md-12">
                        <label for="document_terms">Terms</label>
                        <select name="document_terms" id="document_terms" class="form-control select2-multiple multiSelect">
                          <option value="">Select Term</option>
                          <?php
                            foreach ($terms as $term) {
                              echo "<option value='".$term->term_id."' ".($term->term_id = old('document_terms')?"selected":"").">".$term->term_title."</option>";
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
          <h4 class="c-grey-900 mT-10 mB-30">All Documenta</h4>
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
                foreach ($documents as $document)
                {
                  ?>
                  <tr>
                    <th scope="row"><?php echo $sno; ?></th>
                    <td><?php echo $document->document_title; ?></td>
                    <td>
                      <a href="<?php echo url('admin/edit/document/'.$document->document_id) ?>">Edit</a>
                      | <a href="<?php echo url('admin/clone/document/'.$document->document_id) ?>">Clone</a>
                      | <a href="<?php echo url('admin/delete/document/'.$document->document_id) ?>">Delete</a></td>
                  </tr>
                  <?php 
                  $sno++;
                }
                ?>
              </tbody>
            </table>
          </div>
          {{ $documents->links() }}
        </div>
      </div>          
    