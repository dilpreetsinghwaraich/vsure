
      <div class="row">
        <div class="col-md-12">
          <h4 class="c-grey-900 mT-10 mB-30">All Blog</h4>
          <a href="<?php echo url('admin/add/post') ?>">Add New</a>
          <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Url</th>
                  <th scope="col">Type</th>
                  <th scope="col">Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sno = 1;
                foreach ($posts as $post)
                {
                  ?>
                  <tr>
                    <th scope="row"><?php echo $sno; ?></th>
                    <td><?php echo $post->post_title; ?></td>
                    <td><?php echo $post->post_slug; ?></td>
                    <td><?php echo $post->post_type; ?></td>
                    <td><?php echo $post->status; ?></td>
                    <td>
                      <a href="<?php echo url('admin/edit/post/'.$post->post_id) ?>">Edit</a>
                      | <a target="_blank" href="<?php echo url('/').'/'.$post->post_slug ?>">View</a>
                      | <a href="<?php echo url('admin/delete/post/'.$post->post_id) ?>">Delete</a></td>
                  </tr>
                  <?php 
                  $sno++;
                }
                ?>
              </tbody>
            </table>
          </div>
          {{ $posts->links() }}
        </div>
      </div>          
    