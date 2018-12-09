<section id="feature" class="vsure-company-details-page wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
  <div class="text-center">
    <div class="logedin-notifications-page">
      <div class="row">
        <div class="col-lg-3 col-xs-12 sidebar office-details-sidebar"> 
          <?php 
          $activeTab = 'active';
          if (!empty($serviceForm->form_fields) && is_array($serviceForm->form_fields)) {
            foreach ($serviceForm->form_fields as $form_key => $form_value) {
              ?>
              <a class="<?php echo $activeTab; ?> serviceRequestLeftSidebarNavTab tab_<?php echo $form_key ?>" href="#companyCommonFormTemplate_<?php echo $form_key ?>"><?php echo isset($form_value['tab_title'])?$form_value['tab_title'] :'' ?></a> 
              <?php
              $activeTab = '';
            }
          } 
          ?>
        </div>
        <div class="col-lg-9 col-xs-12 content office-details-content">          
          <?php echo Form::open(array('url' => 'submit/help/desk/ticket/'.$serviceRequest->ticket, 'class'=>'serviceRequestFormSubmit','method' => 'post','files'=>true)) ?>
            <?php echo view('ServiceRequest.companyCommonFormTemplate', compact('serviceForm','serviceRequest')); ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>