<div class="row">
  <div class="col-md-12">
    <h4 class="c-grey-900 mT-10 mB-30">Contact Us Request</h4>
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Subject</th>
            <th scope="col">Message</th>
            <th scope="col">Date</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $sno = 1;
          foreach ($requests as $request)
          {
            ?>
            <tr>
              <th><?php echo $sno; ?></th>
              <td><?php echo $request->name; ?></td>
              <td><?php echo $request->email; ?></td>
              <td><?php echo $request->subject; ?></td>
              <td><?php echo $request->message; ?></td>
              <td><?php echo date('Y-m-d h:i A', strtotime($request->created_at)); ?></td>
            </tr>
            <?php 
            $sno++;
          }
          ?>
        </tbody>
      </table>
    </div>
    {{ $requests->links() }}
  </div>
</div>          