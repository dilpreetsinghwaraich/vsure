<div class="logedin-order-page">
	<h2>My Orders</h2>
	<div class="content-main">
	    <table class="table table-condensed">
	        <thead>
	          <tr>
	          <th>Order Item</th>
	          <th>Firm Name</th>
	          <th>Order Status</th>
	          <th>Payment Status</th>
	          <th>Date</th>
	          <th>View</th>
	          </tr>
	        </thead>
	        <tbody>  
	        <?php
	        if (!empty($orders)) {
	        	foreach ($orders as $order) {
	        		?>
	        			<tr>
	        			  <td class="order-<?php echo $order->package_title; ?>"><?php echo $order->package_title; ?></td>
	        			  <td><?php echo $order->customer_name; ?></td>
	        			  <td class="status-<?php echo $order->order_status; ?>"><?php echo $order->order_status; ?></td>
	        			  <td class="status-<?php echo $order->amount_status; ?>"><?php echo $order->amount_status; ?></td>
	        			  <td><?php echo $order->order_date; ?></td>
	        			  <td><a target="_blank" href="<?php echo url('/view/help/desk/ticket/'.$order->ticket); ?>">View Service Request</a> 
	        			  	| <a target="_blank" href="<?php echo url('order/view/'.$order->invoice_id); ?>">View Invoice</a></td>
	        			</tr>
	        		<?php
	        	}
	        }
	        ?>
	        </tbody>
	    </table>          
	</div>                
</div>