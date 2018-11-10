
      <div class="row">
        <div class="col-md-12">
          <h4 class="c-grey-900 mT-10 mB-30">All Services</h4>
          <a href="<?php echo url('admin/add/service') ?>">Add Service</a>
          <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Url</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sno = 1;
                foreach ($services as $service)
                {
                  ?>
                  <tr>
                    <th scope="row"><?php echo $sno; ?></th>
                    <td><?php echo $service->service_title; ?></td>
                    <td>service/<?php echo $service->service_slug; ?></td>
                    <td><?php echo ($service->status == 1?'Publish':'Draft'); ?></td>
                    <td>
                      <a href="<?php echo url('admin/edit/service/'.$service->service_id) ?>">Edit</a>
                      | <a target="_blank" href="<?php echo url('/service/'.$service->service_slug) ?>">View</a>
                      | <a href="<?php echo url('admin/delete/service/'.$service->service_id) ?>">Delete</a>
                      | <a href="<?php echo url('admin/clone/service/'.$service->service_id) ?>">Clone</a></td>
                  </tr>
                  <?php 
                  $sno++;
                }
                ?>
              </tbody>
            </table>
          </div>
          {{ $services->links() }}
        </div>
      </div>          
    