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
    <div class="bgc-white bd bdrs-3 p-20 mB-20" style="display: inline-block;">
      <div class="col-md-10" style="float: left;">
        <?php echo Form::open(array('url' => 'admin/update/form/service/'.$service_id, 'method' => 'post')) ?>
          <div class="append_field">

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