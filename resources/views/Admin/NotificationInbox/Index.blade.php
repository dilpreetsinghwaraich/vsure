<div class="row">
  <div class="col-md-12">
    <h4 class="c-grey-900 mT-10 mB-30">Notification Inbox</h4>
    <a href="javascript:void(0);" class="btn btn-info btn-lg" data-toggle="modal" data-target="#notificationMOdel">Compose Notification</a>
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Subject</th>
            <th scope="col">Description</th>
            <th scope="col">Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $sno = 1;
          foreach ($inboxs as $inbox)
          {
            ?>
            <tr>
              <th><?php echo $sno; ?></th>
              <td><?php echo $inbox->name; ?></td>
              <td><?php echo $inbox->subject; ?></td>
              <td><?php echo substr($inbox->message, 0, 20); ?></td>
              <td><?php echo date('Y-m-d h:i A', strtotime($inbox->created_at)); ?></td>
              <td>
                <a href="<?php echo url('admin/view/inbox/'.$inbox->uuid) ?>">View</a>
                | <a href="<?php echo url('admin/delete/inbox/'.$inbox->id) ?>">Delete</a>
              </td>
            </tr>
            <?php 
            $sno++;
          }
          ?>
        </tbody>
      </table>
    </div>
    {{ $inboxs->links() }}
  </div>
</div>          
<style type="text/css">
  .receiver_ids_user .select2-container{
        width: 100% !important;
  }
</style>
<div id="notificationMOdel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">New Message</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <?php echo Form::open(array('url' => 'admin/send/notification/', 'method' => 'post', 'files'=>true)) ?>
          <div class="form-group col-md-12 receiver_ids_user">
            <label for="receiver_ids">Select User</label>
            <select name="receiver_id[]" id="receiver_ids" multiple="" class="form-control select2-multiple">
              <option value="">Select</option>              
            </select>
          </div>
          <div class="form-group col-md-12">
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" class="form-control" placeholder="subject">
          </div>
          <div class="form-group col-md-12">
            <label for="message">Select User</label>
            <textarea name="message" class="form-control textarea" id="message"></textarea>
          </div>
          <div class="form-group col-md-12">
            <button type="submit" class="btn btn-success">Send</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>