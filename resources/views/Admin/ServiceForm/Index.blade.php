<div class="row">
  <div class="col-md-12">
    <h4 class="c-grey-900 mT-10 mB-30">Service Forms</h4>
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
      <select name="service_id" class="form-control" style="width: 200px; float: left; margin-right: 20px;" id="service_id">
        <option value="">Select Service</option>
        <?php 
        $services = \Helper::serviceFormMenu();
        foreach ($services as $service) {
          echo '<option value="'.$service['service_id'].'">'.$service['service_title'].'</option>';
        }
        ?>
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
                | <a href="<?php echo url('admin/clone/form/service/'.$serviceForm->service_id) ?>">Clone</a>
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
