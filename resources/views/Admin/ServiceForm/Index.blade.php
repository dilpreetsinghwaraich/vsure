<div class="row">
  <div class="col-md-12">
    <h4 class="c-grey-900 mT-10 mB-30">Service Forms</h4>
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
      <?php 
      $optionValue = '';
      $services = \Helper::serviceFormMenu();
      foreach ($services as $service) {
        $optionValue .='<option value="'.$service['service_id'].'">'.$service['service_title'].'</option>';
      }
      ?>
      <select name="service_id" class="form-control" style="width: 200px; float: left; margin-right: 20px;" id="service_id">
        <option value="">Select Service</option>
        <?php echo $optionValue ?>
      </select>
      <a href="javascript:void(0);" class="btn btn-info" id="add_new_service_form">Add New Service Form</a>
    </div>
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $sno = 1;
          foreach ($serviceForms as $serviceForm)
          {
            ?>
            <tr>
              <th><?php echo $sno; ?></th>
              <td><?php echo $serviceForm->service_title; ?></td>
              <td><?php echo date('Y-m-d h:i A', strtotime($serviceForm->created_at)); ?></td>
              <td>
                <a href="<?php echo url('admin/edit/form/service/'.$serviceForm->service_id) ?>">Edit/View</a>
                | <a href="javascript:void(0);" data-toggle="modal" data-target="#myModal_<?php echo $serviceForm->service_id ?>">Clone</a>
                <div id="myModal_<?php echo $serviceForm->service_id ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Select Service To Clone</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <?php echo Form::open(array('url' => 'admin/clone/form/service/'.$serviceForm->service_id, 'method' => 'post')) ?>
                          <select name="clone_service_id" class="form-control" style="width: 200px; float: left; margin-right: 20px;" id="clone_service_id">
                            <option value="">Select Service</option>
                            <?php echo $optionValue ?>
                          </select>
                          <button type="submit" class="btn btn-info" id="clone_service_form">Clone Service</button>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div>
                | <a href="<?php echo url('admin/delete/form/service/'.$serviceForm->service_id) ?>">Delete</a>
              </td>
            </tr>
            <?php 
            $sno++;
          }
          ?>
        </tbody>
      </table>
    </div>
    {{ $serviceForms->links() }}
  </div>
</div> 
