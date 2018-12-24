<section id="feature" class="vsure-company-details-page wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
  <div class="text-center">
    <div class="logedin-notifications-page">
      <div class="row">
        <div class="col-lg-12 col-xs-12 sidebar office-details-sidebar service-request-page-nav"> 
          <div class="container">
            <?php 
            $activeTab = 'active';
            $tab_count = [];
            $last_tab = 0;
            if (!empty($serviceForm->form_fields) && is_array($serviceForm->form_fields)) {
              foreach ($serviceForm->form_fields as $form_key => $form_value) {
                $tab_count[] = $form_key;
                $last_tab = $form_key;
                ?>
                <a class="<?php echo $activeTab; ?> serviceRequestLeftSidebarNavTab tab_<?php echo $form_key ?>" href="#companyCommonFormTemplate_<?php echo $form_key ?>"><?php echo isset($form_value['tab_title'])?$form_value['tab_title'] :'' ?></a> 
                <?php
                $activeTab = '';
              }
            } 
            ?>
          </div>
        </div>
        <div class="col-lg-12 col-xs-12 content office-details-content service-request-page-data">
          <ol class="progtrckr" data-progtrckr-steps="<?php echo count($tab_count); ?>">
            <?php
            $sn = 1;
            foreach ($tab_count as $tbct) {
              if ($tbct == $last_tab) {
                echo '<li class="progtrckr-todo" id="prog_tab_'.$tbct.'">Finish</li>';
              }else{
                echo '<li class="progtrckr-todo" id="prog_tab_'.$tbct.'">Step '.$sn.'</li>';
              }  
              $sn++;
            } 
            ?>
          </ol>
                  
          <?php echo Form::open(array('url' => 'submit/help/desk/ticket/'.$serviceRequest->ticket, 'class'=>'serviceRequestFormSubmit','method' => 'post','files'=>true)) ?>
            <?php 
            $type = 'view';
            echo view('ServiceRequest.companyCommonFormTemplate', compact('serviceForm','serviceRequest','type')); ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>