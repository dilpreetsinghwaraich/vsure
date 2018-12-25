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
            <th scope="col">User Login</th>
            <th scope="col">Phone</th>
            <th scope="col">City</th>
            <th scope="col">Role</th>
            <th scope="col">Documents</th>
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
              <td><?php echo $user->user_login; ?></td>
              <td><?php echo $user->phone ?></td>
              <td><?php echo Helper::getCity($user->city) ?></td>
              <td><?php echo $user->role ?></td>
              <td><a href="javascript:void(0);" class="getUserDocumentDetails" data-user_id="<?php echo $user->user_id; ?>" data-toggle="modal" data-target="#getUserDocumentDetailsModal">View</a></td>
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
<div id="getUserDocumentDetailsModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Document Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="publishDocumentDetals">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>