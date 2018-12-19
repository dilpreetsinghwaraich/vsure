<div class="row">
  <div class="col-md-12">
    <h4 class="c-grey-900 mT-10 mB-30">Service Requests</h4>
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Ticket+Service</th>
            <th scope="col">Date</th>
            <th scope="col">My Deliverable</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $sno = 1;
          foreach ($serviceRequests as $serviceRequest)
          {
            ?>
            <tr>
              <th><?php echo $sno; ?></th>
              <td><?php echo $serviceRequest->name; ?></td>
              <td><?php echo $serviceRequest->email; ?></td>
              <td><?php echo $serviceRequest->phone; ?></td>
              <td><?php echo '#'.$serviceRequest->ticket.' - '.$serviceRequest->service_title; ?></td>
              <td><?php echo date('Y-m-d h:i A', strtotime($serviceRequest->created_at)); ?></td>
              <td>
                <a href="<?php echo url('/admin/submit/service/request/deliverable/'.$serviceRequest->ticket); ?>">Submit</a>
              </td>
              <td><a href="<?php echo url('/admin/view/service/request/'.$serviceRequest->ticket); ?>">View</a>
                | <a href="<?php echo url('/admin/delete/service/request/'.$serviceRequest->ticket); ?>">Delete</a></td>
            </tr>
            <?php 
            $sno++;
          }
          ?>
        </tbody>
      </table>
    </div>
    {{ $serviceRequests->links() }}
  </div>
</div>          
