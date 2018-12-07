
      <div class="row">
        <div class="col-md-12">
          <h4 class="c-grey-900 mT-10 mB-30">All Packages</h4>
          <a href="<?php echo url('admin/add/package') ?>">Add Package</a>
          <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Price</th>
                  <th scope="col">Featured</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sno = 1;
                foreach ($packages as $package)
                {
                  ?>
                  <tr>
                    <th scope="row"><?php echo $sno; ?></th>
                    <td><?php echo $package->package_title; ?></td>
                    <td><?php echo Helper::displayPrice($package); ?></td>
                    <td><?php echo ($package->is_featured == 1?'Yes':'No'); ?></td>
                    <td><?php echo ($package->status == 1?'Publish':'Draft'); ?></td>
                    <td>
                      <a href="<?php echo url('admin/edit/package/'.$package->package_id) ?>">Edit</a>
                      | <a href="<?php echo url('admin/clone/package/'.$package->package_id) ?>">Clone</a>
                      | <a href="<?php echo url('admin/delete/package/'.$package->package_id) ?>">Delete</a></td>
                  </tr>
                  <?php 
                  $sno++;
                }
                ?>
              </tbody>
            </table>
          </div>
          {{ $packages->links() }}
        </div>
      </div>          
    