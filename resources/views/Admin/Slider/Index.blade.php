
      <div class="row">
        <div class="col-md-12">
          <h4 class="c-grey-900 mT-10 mB-30">All Slidera</h4>
          <a href="<?php echo url('admin/add/slider') ?>">Add Slider</a>
          <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Image</th
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sno = 1;
                foreach ($sliders as $slider)
                {
                  ?>
                  <tr>
                    <th scope="row"><?php echo $sno; ?></th>
                    <td><?php echo $slider->post_title; ?></td>
                    <td><img style="width: 100px;" src="<?php echo asset('/'.$slider->image); ?>" alt="<?php echo $slider->post_title; ?>"></td>
                    <td>
                      <a href="<?php echo url('admin/edit/slider/'.$slider->post_id) ?>">Edit</a>
                      | <a href="<?php echo url('admin/delete/slider/'.$slider->post_id) ?>">Delete</a></td>
                  </tr>
                  <?php 
                  $sno++;
                }
                ?>
              </tbody>
            </table>
          </div>
          {{ $sliders->links() }}
        </div>
      </div>          
    