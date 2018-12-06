<div class="logedin-order-page">
  <h2>My Orders</h2>
  <div class="content-main">
      <table class="table table-condensed">
          <thead>
            <tr>
            <th>Order Item</th>
            <th>Date</th>
            <th>View</th>
            </tr>
          </thead>
          <tbody>  
          <?php
          if (!empty($serviceRequests)) {
            foreach ($serviceRequests as $serviceRequest) {
              $service = \App\Services::find($serviceRequest->service_id);
              ?>
                <tr>
                  <td><?php echo '#'.$serviceRequest->ticket.' '.$service->service_title; ?></td>
                  <td><?php echo date('M, d Y h:i A', strtotime($serviceRequest->created_at)); ?></td>
                  <td><a target="_blank" href="<?php echo url('/help/desk/ticket/'.$serviceRequest->ticket); ?>">View</a></td>
                </tr>
              <?php
            }
          }
          ?>
          </tbody>
      </table>          
  </div>                
</div>