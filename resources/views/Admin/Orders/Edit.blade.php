
      <h4 class="c-grey-900 mT-10 mB-30">Package</h4>
      <div class="row">
        <div class="masonry-item col-md-12">
          <div class="bgc-white p-20 bd">
            <div class="mT-30">
              <?php echo Form::open(array('url' => 'admin/update/order/'.$order->order_id, 'method' => 'post')) ?>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="order_id"><b>Order ID:-</b> </label>
                    <?php echo $order->order_id ?>
                  </div> 
                  <div class="form-group col-md-12">
                    <label for="invoice_id"><b>Invoice ID:-</b> </label>
                    <?php echo $order->invoice_id ?>
                  </div> 
                  <div class="form-group col-md-12">
                    <label for="package_title"><b>Package Title:-</b> </label>
                    <?php echo $order->package_title ?>
                  </div> 
                  <div class="form-group col-md-12">
                    <label for="order_date"><b>Order Date:-</b> </label>
                    <?php echo $order->order_date ?>
                  </div> 
                  <div class="form-group col-md-12">
                    <label for="customer_name"><b>Customer Name:-</b> </label>
                    <?php echo $order->customer_name ?>
                  </div> 
                  <div class="form-group col-md-12">
                    <label for="email"><b>Email ID:-</b> </label>
                    <?php echo $order->email ?>
                  </div> 
                  <div class="form-group col-md-12">
                    <label for="phone"><b>Phone Number:-</b> </label>
                    <?php echo $order->phone ?>
                  </div> 

                  <div class="form-group col-md-12">
                    <label for="payment_id"><b>Payment ID:-</b> </label>
                    <?php echo $order->payment_id ?>
                  </div> 
                  <div class="form-group col-md-12">
                    <label for="payment_method"><b>Payment Method:-</b> </label>
                    <?php echo $order->payment_method ?>
                  </div> 
                  <div class="form-group col-md-12">
                    <label for="order_sub_total"><b>Sub Total:-</b> </label>
                    <?php echo $order->order_sub_total ?>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="grand_total"><b>Grand Total:-</b> </label>
                    <?php echo $order->grand_total ?>
                  </div> 
                  <div class="form-group col-md-12">
                    <label for="order_status"><b>Order Status:-</b> </label>
                    <select name="order_status" id="order_status" class="form-control select2-multiple multiSelect">
                      <option value="pending" <?php echo ($order->order_status == 'pending'?'selected':''); ?>>Pending</option>
                      <option value="processing" <?php echo ($order->order_status == 'processing'?'selected':''); ?>>Processing</option>
                      <option value="completed" <?php echo ($order->order_status == 'completed'?'selected':''); ?>>Completed</option>
                      <option value="canceled" <?php echo ($order->order_status == 'canceled'?'selected':''); ?>>Canceled</option>
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="amount_status"><b>Payment Status:-</b> </label>
                    <?php echo $order->amount_status ?>
                  </div>
                </div>                                     
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>          
    