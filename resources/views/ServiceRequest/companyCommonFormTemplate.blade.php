<?php 
$activeContent = 'in';
if (!empty($serviceForm->form_fields) && is_array($serviceForm->form_fields)) {
  foreach ($serviceForm->form_fields as $form_key => $form_value) {
    ?>
    <div class="content-main company_profile <?php echo $activeContent; ?>" id="companyCommonFormTemplate_<?php echo $form_key ?>">
      <h2>Home-<?php echo $serviceForm->service_title; ?>- #<?php echo $serviceRequest->ticket; ?></h2>
      <div class="vsure-company-page-content"> <span><?php echo isset($form_value['tab_title'])?$form_value['tab_title'] :'' ?></span>
        <p>Enter your company name. Feel free to give us multiple options if you want us to search for the availability.</p>
      </div>
      <?php 
        if (!empty($form_value['field']) && is_array($form_value['field'])) {
          foreach ($form_value['field'] as $field_key => $field_value) {
            if (isset($field_value['text']) && !empty($field_value['text'])) {
              ?>
              <div class="form-group">
                <label class="col-sm-12 control-label"><?php echo $field_value['text']['title'] ?></label>
                <div class="col-sm-12">
                  <input class="form-control" id="focusedInput" type="text" name="text_<?php echo $form_key; ?>_<?php echo $field_key; ?>" value="" required>
                </div>
              </div>
              <?php
            }elseif (isset($field_value['email']) && !empty($field_value['email'])) {
              echo Helper::getEmailField($form_key, $field_key, $field_value['email']['title']);
            }elseif (isset($field_value['number']) && !empty($field_value['number'])) {
              ?>
              <div class="form-group">
                <label class="col-sm-12 control-label"><?php echo $field_value['number']['title']; ?></label>
                <div class="col-sm-12">
                  <input class="form-control" id="focusedInput" name="number_<?php echo $form_key; ?>_<?php echo $field_key; ?>" type="text" value="100000" required>
                  <p>One Lakh(s) rupees</p>
                </div>
              </div>
              <?php
            }elseif (isset($field_value['file']) && !empty($field_value['file'])) {
              echo Helper::getFileField($form_key, $field_key, $field_value['file']['title']);
            }elseif (isset($field_value['textarea']) && !empty($field_value['textarea'])) {
              ?>
                <div class="form-group">
                  <label class="col-sm-12 control-label"><?php echo $field_value['textarea']['title'] ?></label>
                  <div class="col-sm-12">
                    <textarea class="form-control" rows="5" name="textarea_<?php echo $form_key; ?>_<?php echo $field_key; ?>" placeholder="<?php echo $field_value['textarea']['title'] ?> " id="comment"></textarea>
                  </div>
                </div>
              <?php
            }elseif (isset($field_value['checkbox']) && !empty($field_value['checkbox'])) {
              echo Helper::getCheckboxField($form_key, $field_key, $field_value['checkbox']['title']), $field_value['checkbox']['value'];
            }elseif (isset($field_value['radio']) && !empty($field_value['radio'])) {
              ?>
                <div class="form-group">
                  <label class="col-sm-12 control-label"><?php echo $field_value['radio']['title']; ?></label>                  
                  <div class="col-sm-12" style="padding: 0;">
                    <?php 
                      $radios = explode('^',$field_value['radio']['value']); 
                      if (!empty($radios)) {
                        foreach ($radios as $radio) {
                          echo '<option value="'.$radio.'">'.$radio.'</option>';
                        }
                      }
                    ?>    
                  </div>
                </div>
              <?php
              echo Helper::getRadioField($form_key, $field_key, $field_value['radio']['title'], $field_value['radio']['value']);
            }elseif (isset($field_value['select']) && !empty($field_value['select'])) {
              ?>
                <div class="form-group">
                  <label class="col-sm-12 control-label"><?php echo $field_value['select']['title']; ?></label>                  
                  <div class="col-sm-12" style="padding: 0;">
                    <select class="form-control" name="select_<?php echo $form_key; ?>_<?php echo $field_key; ?>" id="sel<?php echo $field_key; ?>">
                      <option value="">Select</option>
                      <?php 
                      $selects = explode('^',$field_value['select']['value']); 
                      if (!empty($selects)) {
                        foreach ($selects as $select) {
                          echo '<option value="'.$select.'">'.$select.'</option>';
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
      ?>
      <div class="company-page-form-btn">
        <div class="col-sm-12">
          <button type="submit" class="btn btn-default">Submit Names</button>
        </div>
      </div>
    </div>
    <?php
    $activeContent++;
  }
} 
?>