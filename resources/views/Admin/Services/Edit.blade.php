<h4 class="c-grey-900 mT-10 mB-30">Edit Service</h4>
<div class="row">
  <div class="masonry-item col-md-12">
    <div class="bgc-white p-20 bd">
      <div class="mT-30">
        <?php echo Form::open(array('url' => 'admin/update/service/'.$service_id, 'method' => 'post','files' => true)) ?>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="service_title">Title</label>
              <input type="text" class="form-control" id="service_title" name="service_title" value="<?php echo $service->service_title; ?>" placeholder="Title">
            </div>                  
            <div class="form-group col-md-12">
              <label for="service_content">Content</label>
              <textarea class="form-control" id="service_content" name="service_content" required placeholder="Content"><?php echo $service->service_content; ?></textarea>
            </div>

            <?php $service_questions = (!empty($service->service_questions)?$service->service_questions:[]); ?>
            <?php echo view('Admin.Services.QuestionSection',compact('service_questions')); ?>

            <?php $service_features = (!empty($service->service_features)?$service->service_features:[]); ?>
            <?php echo view('Admin.Services.FeatureSection',compact('service_features')); ?>

            <?php $service_short_info = (!empty($service->service_short_info)?$service->service_short_info:[]); ?>
            <?php echo view('Admin.Services.ContactSection',compact('service_short_info')); ?>
            
            <?php $service_documents = (!empty($service->service_documents)?$service->service_documents:[]); ?>
            <?php echo view('Admin.Services.DocumentSection',compact('service_documents')); ?>            
            
            <?php 
            $service_process_results = (!empty($service->service_process_results)?$service->service_process_results:[]); 
            echo view('Admin.Services.ProcessResult',compact('service_process_results'));
            ?>
            
            <?php $service_packages = (!empty($service->service_packages)?$service->service_packages:[]); ?>
            <?php echo view('Admin.Services.PackageSection',compact('service_packages')); ?>
                              
            <div class="form-group col-md-12">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-control select2-multiple multiSelect">
                <option value="1" <?php echo ($service->status == 1?'selected':$service->status == ''?'selected':''); ?>>Publish</option>
                <option value="0" <?php echo ($service->status == 0?'selected':''); ?>>Draft</option>
              </select>
            </div>
            <div class="form-group col-md-12">
              <label for="show_nav_menu">Show In Nav Menu</label>
              <select name="show_nav_menu" id="show_nav_menu" class="form-control select2-multiple multiSelect">
                <option value="1" <?php echo ($service->show_nav_menu == 1?'selected':$service->show_nav_menu == ''?'selected':''); ?>>Yes</option>
                <option value="0" <?php echo ($service->show_nav_menu == 0?'selected':''); ?>>NO</option>
              </select>
            </div>
          </div>                                     
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>          
    