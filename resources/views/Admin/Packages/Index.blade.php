
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
                  <th>Action</th>
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
                    <td><?php echo $package->price; ?></td>
                    <td>
                      <a href="<?php echo url('admin/edit/package/'.$package->document_id) ?>">Edit</a>
                      | <a href="<?php echo url('admin/delete/package/'.$package->document_id) ?>">Delete</a></td>
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
    