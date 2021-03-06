<div class="row">
  <div class="col-md-12">
    <h4 class="c-grey-900 mT-10 mB-30"><?php echo $serviceForm->service_title; ?>- #<?php echo $serviceRequest->ticket; ?></h4>
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
      <section id="feature" class="vsure-company-details-page wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
        <div class="text-center">
          <div class="logedin-notifications-page">
            <div class="row">
              <div class="col-lg-3 col-xs-12 office-details-sidebar"> 
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
              <div class="col-lg-8 col-xs-12 content office-details-content">          
                <?php echo Form::open(array('url' => 'submit/help/desk/ticket/'.$serviceRequest->ticket, 'class'=>'serviceRequestFormSubmit','method' => 'post')) ?>
                  <?php echo view('Admin.ServiceRequest.CompanyCommonFormTemplate', compact('serviceForm','serviceRequest')); ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>          
