
      <div class="row">
        <div class="col-md-12">
          <h4 class="c-grey-900 mT-10 mB-30">All Orders</h4>
          <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Package Title</th>
                  <th scope="col">Customer Name</th>
                  <th scope="col">Grand Total</th>
                  <th scope="col">Amount Status</th>
                  <th scope="col">Payment Method</th>
                  <th scope="col">Order Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sno = 1;
                foreach ($orders as $order)
                {
                  ?>
                  <tr>
                    <th scope="row"><?php echo $sno; ?></th>
                    <td><?php echo $order->package_title; ?></td>
                    <td><?php echo $order->customer_name; ?></td>
                    <td><?php echo $order->grand_total; ?></td>
                    <td><?php echo $order->amount_status; ?></td>
                    <td><?php echo $order->payment_method; ?></td>
                    <td><?php echo $order->order_status; ?></td>
                    <td>
                      <a href="<?php echo url('admin/edit/order/'.$order->order_id) ?>">Edit</a>
                    </td>
                  </tr>
                  <?php 
                  $sno++;
                }
                ?>
              </tbody>
            </table>
          </div>
          {{ $orders->links() }}
        </div>
      </div>          
    