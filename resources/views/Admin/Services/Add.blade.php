<h4 class="c-grey-900 mT-10 mB-30">Add Service</h4>
<div class="row">
  <div class="masonry-item col-md-12">
    <div class="bgc-white p-20 bd">
      <div class="mT-30">
        <?php echo Form::open(array('url' => 'admin/save/service/', 'method' => 'post','files' => true)) ?>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="service_title">Title</label>
              <input type="text" class="form-control" id="service_title" name="service_title" value="<?php echo old('service_title'); ?>" placeholder="Title">
            </div> 
            <div class="form-group col-md-12">
              <label for="service_image">Feature Image</label>
              <input type="file" class="form-control" id="service_image" name="service_image">
            </div>                  
            <div class="form-group col-md-12">
              <label for="service_content">Content</label>
              <textarea class="form-control textarea" id="service_content" name="service_content" required placeholder="Content"><?php echo old('service_content'); ?></textarea>
            </div>

            <?php $service_questions = (!empty(old('service_questions'))?old('service_questions'):[]); ?>
            <?php echo view('Admin.Services.QuestionSection',compact('service_questions')); ?>

            <?php $service_features = (!empty(old('service_features'))?old('service_features'):[]); ?>
            <?php echo view('Admin.Services.FeatureSection',compact('service_features')); ?>

            <?php $service_short_info = (!empty(old('service_short_info'))?old('service_short_info'):[]); ?>
            <?php echo view('Admin.Services.ContactSection',compact('service_short_info')); ?>
            
            <?php $service_documents = (!empty(old('service_documents'))?old('service_documents'):[]); ?>
            <?php echo view('Admin.Services.DocumentSection',compact('service_documents')); ?>
            
            <div class="form-group col-md-12">
              <h2>Process Results Section</h2>
              <?php 
                $service_process_result_section = (!empty(old('service_process_results'))?old('service_process_results'):[]); 
              ?>
              <div class="form-group col-md-12">
                <label for="section_title">Section Title</label>
                <input type="text" class="form-control" id="section_title" name="service_process_results[section_title]" value="<?php echo (isset($service_process_result_section['section_title'])?$service_process_result_section['section_title']:''); ?>" placeholder="Title">
              </div>  
              <div class="processResultSection" style="border: 1px solid #ccc;">   
              <?php 
                $service_process_result =  (isset($service_process_result_section['section_content'])?$service_process_result_section['section_content']:'');
                $index = 0;
              ?>             
                <?php echo view('Admin.Services.ProcessResult',compact('service_process_result','index')); ?>
              </div>
              <br>
              <button type="button" class="btn btn-success addProcessResultItem">Add Section</button>
            </div>

            <?php $service_packages = (!empty(old('service_packages'))?old('service_packages'):[]); ?>
            <?php echo view('Admin.Services.PackageSection',compact('service_packages')); ?>
                              
            <div class="form-group col-md-12">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-control select2-multiple multiSelect">
                <option value="1" <?php echo (old('status') == 1?'selected':old('status') == ''?'selected':''); ?>>Publish</option>
                <option value="0" <?php echo (old('status') == 0?'selected':''); ?>>Draft</option>
              </select>
            </div>
            <div class="form-group col-md-12">
              <label for="show_nav_menu">Show In Nav Menu</label>
              <select name="show_nav_menu" id="show_nav_menu" class="form-control select2-multiple multiSelect">
                <option value="1" <?php echo (old('show_nav_menu') == 1?'selected':old('show_nav_menu') == ''?'selected':''); ?>>Yes</option>
                <option value="0" <?php echo (old('show_nav_menu') == 0?'selected':''); ?>>NO</option>
              </select>
            </div>
          </div>                                     
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>          
    