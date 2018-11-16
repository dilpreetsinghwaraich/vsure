<div class="row">
  <div class="masonry-item col-md-12">
    <div class="bgc-white p-20 bd">
      <div class="mT-30">
        <?php echo Form::open(array('url' => 'admin/update/order/'.$order->order_id, 'method' => 'post')) ?>
          <div class="form-row">
            <?php echo Helper::createInvoice($order, 'admin'); ?>                    
            <div class="form-group col-md-12">
              <label for="order_status"><b>Order Status:-</b> </label>
              <select name="order_status" id="order_status" class="form-control select2-multiple">
                <option value="pending" <?php echo ($order->order_status == 'pending'?'selected':''); ?>>Pending</option>
                <option value="processing" <?php echo ($order->order_status == 'processing'?'selected':''); ?>>Processing</option>
                <option value="completed" <?php echo ($order->order_status == 'completed'?'selected':''); ?>>Completed</option>
                <option value="canceled" <?php echo ($order->order_status == 'canceled'?'selected':''); ?>>Canceled</option>
              </select>
            </div>
          </div>                                     
          <button type="submit" class="btn btn-success">Update</button>
          <a href="<?php echo url('admin/generate/print/'.$order->order_id) ?>" target="_blank" class="btn btn-success">Print</a>
          <a href="<?php echo url('admin/generate/pdf/'.$order->order_id) ?>" target="_blank" class="btn btn-success">Generate PDF</a>
          <a href="<?php echo url('admin/order/send/invoice/mail/'.$order->order_id) ?>" class="btn btn-success">Send Mail</a>
        </form>
      </div>
    </div>
  </div>
</div>          
    