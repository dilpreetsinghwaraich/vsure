<?php 
$activeContent = 'in';
if (!empty($serviceForm->form_fields) && is_array($serviceForm->form_fields)) {
  $tab_count = count($serviceForm->form_fields);
  $loopIndex = 0;
  foreach ($serviceForm->form_fields as $form_key => $form_value) {
    ?>
    <div class="content-main company_profile <?php echo $activeContent; ?> " id="companyCommonFormTemplate_<?php echo $form_key ?>">
      <h2>Home-<?php echo $serviceForm->service_title; ?>- #<?php echo $serviceRequest->ticket; ?></h2>
      <div class="vsure-company-page-content"> <span><?php echo isset($form_value['tab_title'])?$form_value['tab_title'] :'' ?></span>
        <p><?php echo isset($form_value['tab_sub_title'])?$form_value['tab_sub_title'] :'' ?></p>
      </div>
      <?php 
        if (!empty($form_value['field']) && is_array($form_value['field'])) {
          foreach ($form_value['field'] as $field_key => $field_value) {
            $company_details = $serviceRequest->company_details;
            if (isset($field_value['text']) && !empty($field_value['text'])) {
              ?>
              <div class="form-group">
                <label class="col-sm-12 control-label"><?php echo $field_value['text']['title'] ?></label>
                <div class="col-sm-12">
                  <input class="form-control emptyFieldCheck" id="focusedInput" type="text" name="company_details[text_<?php echo $form_key; ?>_<?php echo $field_key; ?>]" value="<?php echo (isset($company_details['text_'.$form_key.'_'.$field_key])?$company_details['text_'.$form_key.'_'.$field_key]:'') ?>" required data-placeholder="<?php echo $field_value['text']['title'] ?>">
                </div>
              </div>
              <?php
            }elseif (isset($field_value['email']) && !empty($field_value['email'])) {
              ?>
              <div class="form-group">
                <label class="col-sm-12 control-label"><?php echo $field_value['email']['title']; ?></label>
                <div class="col-sm-12">
                  <input class="form-control emptyFieldCheck" id="focusedInput" name="company_details[email_<?php echo $form_key; ?>_<?php echo $field_key; ?>]" type="email" value="<?php echo (isset($company_details['email_'.$form_key.'_'.$field_key])?$company_details['email_'.$form_key.'_'.$field_key]:'') ?>" required data-placeholder="<?php echo $field_value['email']['title'] ?>">
                </div>
              </div>
              <?php
            }elseif (isset($field_value['number']) && !empty($field_value['number'])) {
              ?>
              <div class="form-group">
                <label class="col-sm-12 control-label"><?php echo $field_value['number']['title']; ?></label>
                <div class="col-sm-12">
                  <input class="form-control InputNumber emptyFieldCheck" id="focusedInput" name="company_details[number_<?php echo $form_key; ?>_<?php echo $field_key; ?>]" type="text" value="<?php echo (isset($company_details['number_'.$form_key.'_'.$field_key])?$company_details['number_'.$form_key.'_'.$field_key]:'') ?>" required data-placeholder="<?php echo $field_value['number']['title'] ?>">
                </div>
              </div>
              <?php
            }elseif (isset($field_value['file']) && !empty($field_value['file'])) {
              ?>
                <div class="form-group">
                  <label class="col-sm-12 control-label"><?php echo $field_value['file']['title']; ?></label>
                  <div class="col-sm-12">
                    <input class="form-control" id="focusedInput" name="company_details[file_<?php echo $form_key; ?>_<?php echo $field_key; ?>]" type="file" data-placeholder="<?php echo $field_value['file']['title'] ?>">
                  </div>
                  <div class="col-sm-12">
                    <?php 
                    if (isset($company_details['file_'.$form_key.'_'.$field_key])?$company_details['file_'.$form_key.'_'.$field_key]:'')
                    {
                      $file = $company_details['file_'.$form_key.'_'.$field_key];
                      $ext = pathinfo($file, PATHINFO_EXTENSION);
                      switch ($ext) {
                        case 'jpg':
                        case 'jpeg':
                        case 'png':
                          ?><a href="<?php echo asset('/').'/'.$file ?>" target="_blank"><img src="<?php echo asset('/').'/'.$file ?>" class="img-responsive" style="width: 200px; height: 200px;"></a><?php
                          break;
                        case 'doc':
                          ?><a href="<?php echo asset('/').'/'.$file ?>" download="" target="_blank"><img src="<?php echo asset('/public/images/doc.png') ?>" class="img-responsive" style="width: 200px; height: 200px;"></a><?php
                          break; 
                        case 'pdf':
                          ?><a href="<?php echo asset('/').'/'.$file ?>" download="" target="_blank"><img src="<?php echo asset('/public/images/pdf.png') ?>" class="img-responsive" style="width: 200px; height: 200px;"></a><?php
                          break; 
                        case 'xlsx':
                        case 'csv':
                          ?><a href="<?php echo asset('/').'/'.$file ?>" download="" target="_blank"><img src="<?php echo asset('/public/images/xlsz.png') ?>" class="img-responsive" style="width: 200px; height: 200px;"><?php
                          break;   
                      }                      
                    }
                    ?>
                  </div>
                </div>
              <?php
            }elseif (isset($field_value['date']) && !empty($field_value['date'])) {
              ?>
                <div class="form-group">
                  <label class="col-sm-12 control-label"><?php echo $field_value['date']['title']; ?></label>
                  <div class="col-sm-12">
                    <input class="form-control emptyFieldCheck vsureDatepicker" name="company_details[date_<?php echo $form_key; ?>_<?php echo $field_key; ?>]" type="text" value="<?php echo (isset($company_details['date_'.$form_key.'_'.$field_key])?$company_details['date_'.$form_key.'_'.$field_key]:'') ?>" required data-placeholder="<?php echo $field_value['date']['title'] ?>">
                  </div>
                </div>
              <?php
            }elseif (isset($field_value['textarea']) && !empty($field_value['textarea'])) {
              ?>
                <div class="form-group">
                  <label class="col-sm-12 control-label"><?php echo $field_value['textarea']['title'] ?></label>
                  <div class="col-sm-12">
                    <textarea class="form-control emptyFieldCheck" rows="5" name="company_details[textarea_<?php echo $form_key; ?>_<?php echo $field_key; ?>]" data-placeholder="<?php echo $field_value['textarea']['title'] ?> " id="comment"><?php echo (isset($company_details['textarea_'.$form_key.'_'.$field_key])?$company_details['textarea_'.$form_key.'_'.$field_key]:'') ?></textarea>
                  </div>
                </div>
              <?php
            }elseif (isset($field_value['checkbox']) && !empty($field_value['checkbox'])) {
              ?>
                <div class="form-group">
                  <label class="col-sm-12 control-label"><?php echo $field_value['checkbox']['title']; ?></label>                  
                  <div class="col-sm-12" style="padding: 0;">
                    <?php 
                      $checkboxDefaultValue = (isset($company_details['checkbox_'.$form_key.'_'.$field_key])?$company_details['checkbox_'.$form_key.'_'.$field_key]:'');
                      $checkboxs = explode('^',$field_value['checkbox']['value']); 
                      if (!empty($checkboxs)) {
                        foreach ($checkboxs as $checkbox) {
                          ?>
                            <label><input type="checkbox" class="emptyFieldCheck" name="company_details[checkbox_<?php echo $form_key; ?>_<?php echo $field_key; ?>][]" value="<?php echo $checkbox ?>" <?php echo (is_array($checkboxDefaultValue) && in_array($checkbox, $checkboxDefaultValue)?'checked':'') ?> data-placeholder="<?php echo $field_value['checkbox']['title'] ?>"><?php echo $checkbox ?></label>
                          <?php
                        }
                      }
                    ?>    
                  </div>
                </div>
              <?php
            }elseif (isset($field_value['radio']) && !empty($field_value['radio'])) {
              ?>
                <div class="form-group">
                  <label class="col-sm-12 control-label"><?php echo $field_value['radio']['title']; ?></label>                  
                  <div class="col-sm-12" style="padding: 0;">
                    <?php 
                    $radioDefaultValue = (isset($company_details['radio_'.$form_key.'_'.$field_key])?$company_details['radio_'.$form_key.'_'.$field_key]:'');
                      $radios = explode('^',$field_value['radio']['value']); 
                      if (!empty($radios)) {
                        foreach ($radios as $radio) {
                          ?>
                           <label><input type="radio" class="emptyFieldCheck" name="company_details[radio_<?php echo $form_key; ?>_<?php echo $field_key; ?>]" value="<?php echo $radio ?>" <?php echo ($radioDefaultValue == $radio?'checked':'') ?> data-placeholder="<?php echo $field_value['radio']['title'] ?>"><?php echo $radio ?></label>
                          <?php
                        }
                      }
                    ?>    
                  </div>
                </div>
              <?php
            }elseif (isset($field_value['select']) && !empty($field_value['select'])) {
              ?>
                <div class="form-group">
                  <label class="col-sm-12 control-label"><?php echo $field_value['select']['title']; ?></label>                  
                  <div class="col-sm-12" style="padding: 0;">
                    <select class="form-control emptyFieldCheck" name="company_details[select_<?php echo $form_key; ?>_<?php echo $field_key; ?>]" id="sel<?php echo $field_key; ?>" data-placeholder="<?php echo $field_value['select']['title'] ?>">
                      <option value="">Select</option>
                      <?php 
                      $selectDefaultValue = (isset($company_details['select_'.$form_key.'_'.$field_key])?$company_details['select_'.$form_key.'_'.$field_key]:'');
                      $selects = explode('^',$field_value['select']['value']); 
                      if (!empty($selects)) {
                        foreach ($selects as $select) {
                          echo '<option value="'.$select.'" '.($selectDefaultValue == $select?'selected':'').'>'.$select.'</option>';
                        }
                      }
                      ?>                      
                    </select>
                  </div>
                </div>
              <?php
            }
          }
        }
      $loopIndex++;
      if ($type == 'index') {        
        if ($tab_count == $loopIndex) {
          ?>
          <div class="company-page-form-btn">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-default">Submit</button>
            </div>
          </div>
          <?php
        }else
        {
          ?>
          <div class="company-page-form-btn">
            <div class="col-sm-12">
              <button type="button" class="btn btn-default submit_form_button" data-tabKey="tab_<?php echo $form_key ?>">Save & Continue</button>
            </div>
          </div>
          <?php
        }
      }
      ?>      
    </div>
    <?php
    $activeContent = '';
  }
} 
?>