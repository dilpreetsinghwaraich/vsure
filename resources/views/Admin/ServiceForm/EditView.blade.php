<style type="text/css">
  .append_tab_content {
      border: 1px solid;
      margin-bottom: 20px;
      height: 80px;
      overflow: hidden;
  }
  .append_tab_content.open {
      height: auto;
      min-height: 200px;
  }
  a.OPenCloseTab, .removeTab, .removeField {
      float: right;
      margin-right: 10px;
  }
</style>
<div class="row">
  <div class="col-md-12">
    <h4 class="c-grey-900 mT-10 mB-30">Service Forms</h4>
    <h5 class="c-grey-900 mT-10 mB-30"><?php echo $serviceForm->service_title ?></h5>
    <div class="bgc-white bd bdrs-3 p-20 mB-20" style="display: inline-block;">
      <div class="col-md-10" style="float: left;">
        <?php echo Form::open(array('url' => 'admin/update/form/service/'.$service_id, 'method' => 'post')) ?>
          <div class="append_field">
            <?php 
            if (!empty($serviceForm->form_fields) && is_array($serviceForm->form_fields)) {
              foreach ($serviceForm->form_fields as $form_key => $form_value) {
                ?>
                <div class="append_tab_content" id="tab_content_<?php echo $form_key ?>" data-tabCount="<?php echo $form_key ?>">
                  <div class="form-group col-md-12">
                    <label>Please enter your Tab Title</label>
                    <a href="javascript:void(0)" class="removeTab btn btn-info" data-tab_id="tab_content_<?php echo $form_key ?>">Remove</a>
                    <a href="javascript:void(0)" class="OPenCloseTab btn btn-info" data-tab_id="tab_content_<?php echo $form_key ?>">Open/Close</a>
                    <input type="text" class="form-control tab_title" required id="tab_title" name="form_fields[<?php echo $form_key ?>][tab_title]" value="<?php echo isset($form_value['tab_title'])?$form_value['tab_title'] :'' ?>" placeholder="Tab Title">
                  </div>
                  <?php 
                  if (!empty($form_value['field']) && is_array($form_value['field'])) {
                    foreach ($form_value['field'] as $field_key => $field_value) {
                      if (isset($field_value['text']) && !empty($field_value['text'])) {
                        echo Helper::getTextField($form_key, $field_key, $field_value['text']['title']);
                      }elseif (isset($field_value['email']) && !empty($field_value['email'])) {
                        echo Helper::getEmailField($form_key, $field_key, $field_value['email']['title']);
                      }elseif (isset($field_value['number']) && !empty($field_value['number'])) {
                        echo Helper::getNumberField($form_key, $field_key, $field_value['number']['title']);
                      }elseif (isset($field_value['textarea']) && !empty($field_value['textarea'])) {
                        echo Helper::getTextareaField($form_key, $field_key, $field_value['textarea']['title']);
                      }elseif (isset($field_value['checkbox']) && !empty($field_value['checkbox'])) {
                        echo Helper::getCheckboxField($form_key, $field_key, $field_value['checkbox']['title']), $field_value['checkbox']['value'];
                      }elseif (isset($field_value['radio']) && !empty($field_value['radio'])) {
                        echo Helper::getRadioField($form_key, $field_key, $field_value['radio']['title'], $field_value['radio']['value']);
                      }elseif (isset($field_value['select']) && !empty($field_value['select'])) {
                        echo Helper::getSelectField($form_key, $field_key, $field_value['select']['title'], $field_value['select']['value']);
                      }
                    }
                  }
                  ?>
                </div>
                <?php
              }
            } 
            ?>            
          </div>
          <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      <div class="col-md-2" style="float: left;border: 1px solid;padding: 10px;">
        <?php 
        $buttonArray = [
          'tab' => 'NewTabCreate',
          'text' => 'TextField',
          'email' => 'EmailField',
          'number' => 'NumberField',
          'textarea' => 'TextareaField',
          'checkbox' => 'CheckboxField',
          'radio' => 'RadioField',
          'select' => 'SelectField',
        ];
        foreach ($buttonArray as $key => $field) {
          ?>
          <a href="javascript:void(0);" style="margin-bottom: 10px;width: 100%;" data-key ="<?php echo $key; ?>" class="btn btn-info add_field"><?php echo $field; ?></a>
          <?php
        }
        ?>        
      </div>
    </div>
  </div>
</div>