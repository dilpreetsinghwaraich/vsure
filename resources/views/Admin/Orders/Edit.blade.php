
      <h4 class="c-grey-900 mT-10 mB-30">Package</h4>
      <div class="row">
        <div class="masonry-item col-md-12">
          <div class="bgc-white p-20 bd">
            <div class="mT-30">
              <?php echo Form::open(array('url' => 'admin/update/order/'.$order->order_id, 'method' => 'post')) ?>
                <div class="form-row">
                  <?php echo Helper::createInvoice($order, 'admin'); ?>                    
                  <div class="form-group col-md-12">
                    <label for="order_status"><b>Order Status:-</b> </label>
                    <select name="order_status" id="order_status" class="form-control select2-multiple multiSelect">
                      <option value="pending" <?php echo ($order->order_status == 'pending'?'selected':''); ?>>Pending</option>
                      <option value="processing" <?php echo ($order->order_status == 'processing'?'selected':''); ?>>Processing</option>
                      <option value="completed" <?php echo ($order->order_status == 'completed'?'selected':''); ?>>Completed</option>
                      <option value="canceled" <?php echo ($order->order_status == 'canceled'?'selected':''); ?>>Canceled</option>
                    </select>
                  </div>
                </div>                                     
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>          
    