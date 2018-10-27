
      <h4 class="c-grey-900 mT-10 mB-30">Package</h4>
      <div class="row">
        <div class="masonry-item col-md-12">
          <div class="bgc-white p-20 bd">
            <div class="mT-30">
              <?php echo Form::open(array('url' => 'admin/update/package/'.$package->package_id, 'method' => 'post')) ?>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="package_title">Title</label>
                    <input type="text" class="form-control" id="package_title" name="package_title" value="<?php echo $package->package_title ?>" placeholder="Title">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="regular_price">Regular Price</label>
                    <input type="text" class="form-control InputNumber" id="regular_price" name="regular_price" value="<?php echo $package->regular_price ?>" placeholder="Regular Price">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="sale_price">Sale Price</label>
                    <input type="text" class="form-control InputNumber" id="sale_price" name="sale_price" value="<?php echo $package->sale_price ?>" placeholder="Sale Price">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="discount_start">Discount Start</label>
                    <input type="text" class="form-control vsureDatepicker" id="discount_start" name="discount_start" value="<?php echo $package->discount_start ?>" placeholder="Discount Start">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="discount_end">Discount End</label>
                    <input type="text" class="form-control vsureDatepicker" id="discount_end" name="discount_end" value="<?php echo $package->discount_end ?>" placeholder="Discount End">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="package_content">Content</label>
                    <textarea class="form-control" id="package_content" name="package_content" required placeholder="Content"><?php echo $package->package_content ?></textarea>
                  </div>                  
                  <div class="form-group col-md-12">
                    <label for="package_terms">Terms</label>
                    <select name="package_terms[]" id="package_terms" multiple="" class="form-control select2-multiple multiSelect">
                      <option value="">Select Term</option>
                      <?php
                        foreach ($terms as $term) {
                          echo "<option value='".$term->term_id."' ".(is_array($package->package_terms) && in_array($term->term_id, $package->package_terms)?"selected":"").">".$term->term_title."</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control select2-multiple multiSelect">
                      <option value="1" <?php echo ($package->status == 1?'selected':''); ?>>Publish</option>
                      <option value="0" <?php echo ($package->status == 0?'selected':''); ?>>Draft</option>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="is_featured">Featured</label>
                    <input type="checkbox" id="is_featured" name="is_featured" value="1" <?php echo ($package->is_featured == 1 ?'checked':'') ?>>
                  </div>
                </div>                                     
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>          
    