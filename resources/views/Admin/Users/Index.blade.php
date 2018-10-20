
      <h4 class="c-grey-900 mT-10 mB-30">All Users</h4>
      <div class="row">
        <div class="col-md-12">
          <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Phone</th>
                  <th scope="col">City</th>
                  <th scope="col">Role</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sno = 1;
                foreach ($users as $user)
                {
                  ?>
                  <tr>
                    <th scope="row"><?php echo $sno; ?></th>
                    <td><?php echo $user->name; ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->phone ?></td>
                    <td><?php echo $user->city ?></td>
                    <td><?php echo $user->role ?></td>
                    <td>
                      <a href="<?php echo url('admin/user/edit/'.$user->user_id) ?>">Edit</a>
                      <?php if ($user->role != 'admin') {
                        ?>
                         | <a href="<?php echo url('admin/user/delete/'.$user->user_id) ?>">Delete</a></td>
                        <?php
                      } ?>                      
                  </tr>
                  <?php 
                  $sno++;
                }
                ?>
              </tbody>
            </table>
          </div>
          {{ $users->links() }}
        </div>
      </div>          
    