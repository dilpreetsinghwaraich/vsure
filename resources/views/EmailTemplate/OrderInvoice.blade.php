<?php 
	$package = json_decode($order->products_details);        
	$term = Helper::getPostTermByID($package->package_terms);
?>
<table width="600px" style="margin:0 auto" class="m_-6783513939340938050m_-2993437530719343208content" align="center" border="0" cellspacing="10" cellpadding="0" bgcolor="#F4F5F8">
  <tbody>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="3" bgcolor="#2CA01C">
          <tbody>
            <tr>
              <td height="1" style="font-size:1px;line-height:1px">&nbsp;</td>
            </tr>
          </tbody>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="10" bgcolor="white" style="border:1px solid #dadbdd;border-top:0;padding-bottom:10px">
          <tbody>
            <tr bgcolor="#F4F5F8" style="color:#333333;border-bottom:1px solid #dadbdd">
              <td style="padding:0 25px 15px 25px"><table style="table-layout:fixed;padding-bottom:20px">
                  <tbody>
                    <tr>
                      <td><img src="https://ci5.googleusercontent.com/proxy/0KyVTdQHeVYciNKkIqziTZ1LyFRZ0ziPZ0ygFeSNt2UkBnLnks3wqWBLHbrXPt1MEjvJC-ahB9v645w6kp3cn8TAHbAGMrpIYwuvmbnkPPcLer4btk7mf1gabrHyCqXcrDuR=s0-d-e1-ft#https://c17.qbo.intuit.com/qbo17/ext/Image/show/716133818340424/1?15396377440000" height="auto" width="58" style="max-height:56px!important;vertical-align:top;padding-right:5px;padding-top:5px" alt="company_logo" class="CToWUd"></td>
                      <td style="font-size:16pt;font-weight:bold;word-wrap:break-word"><p>Lukesh Sethi and Associates &nbsp;</p></td>
                    </tr>
                  </tbody>
                </table>
                <table style="width:100%">
                  <tbody>
                    <tr>
                      <td><table align="left" border="0" cellpadding="0" cellspacing="0" style="padding-bottom:20px;padding-right:15px">
                          <tbody>
                            <tr>
                              <td style="border-right:1px solid #d4d7db;margin-right:0;padding-right:15px" nowrap=""><p class="m_-6783513939340938050m_-2993437530719343208inv_headers" style="font-size:12px;color:#393a3d;margin:0 0 5px 0">INVOICE</p>
                                <p class="m_-6783513939340938050m_-2993437530719343208inv_val" style="font-size:18px;margin:0"><?php echo $order->invoice_id; ?></p></td>
                              <td style="border-right:1px solid #d4d7db;margin-right:0;padding-right:15px;padding-left:15px" nowrap=""><p class="m_-6783513939340938050m_-2993437530719343208inv_headers" style="font-size:12px;color:#393a3d;margin:0 0 5px 0">DUE DATE</p>
                                <p class="m_-6783513939340938050m_-2993437530719343208inv_val" style="font-size:18px;color:#393a3d;margin:0"><?php echo $order->order_due_date; ?></p></td>
                              <td style="padding-left:15px"><p class="m_-6783513939340938050m_-2993437530719343208inv_headers" style="font-size:12px;color:#393a3d;margin:0 0 3px 0">BALANCE DUE</p>
                                <p class="m_-6783513939340938050m_-2993437530719343208inv_amt" style="font-size:20px;color:#393a3d;margin:0"><?php echo Helper::displayPrice($package); ?></p></td>
                            </tr>
                          </tbody>
                        </table>
                        <table class="m_-6783513939340938050m_-2993437530719343208buttonwrapper" align="center" border="0" cellpadding="0" cellspacing="0" style="width:125">
                          <tbody>
                            <tr>
                              <td align="center"><a class="m_-6783513939340938050m_-2993437530719343208buttonwrapper" href="<?php echo url('view/order/invoice/'.$order->invoice_id); ?>" style="text-decoration:none;display:inline-block;vertical-align:bottom;height:15px;padding:15px;border-radius:2px;text-align:center;background-color:#2ca01c;font-family:HelveticaNeueRoman,Helvetica,Verdana,sans-serif;font-size:16px;color:#fff;line-height:16px;letter-spacing:0.5px" target="_blank">View invoice</a></td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td style="font-size:12px;padding:20px 25px 50px 25px;color:#000000;font-family:HelveticaNeueRoman,Helvetica,Arial,Verdana,sans-serif"><p>Dear 
              	<?php echo $order->customer_name; ?>, <br><br> <?php echo $term->term_title.' - '.$order->package_title; ?>,<br>
                  <br>
                  Here's your invoice! We appreciate your prompt payment.<br>
                  <br>
                  Thanks for your business!<br>
                  Lukesh Sethi and Associates</p></td>
            </tr>
          </tbody>
        </table>
        <table border="0" width="100%">
          <tbody>
            <tr>
              <td align="left" style="padding:5px 0 10px 0"></td>
              <td width="100%" align="right" style="font-size:10px;color:#888888;padding:5px 0 10px 0">
                  <p style="margin-bottom:0">© Intuit, Inc. All rights reserved. &nbsp;
                      <a href="<?php echo url('privacy-policy') ?>" style="text-decoration:none;color:#0077c5" target="_blank" >Privacy</a> | 
                      <a href="<?php echo url('refund-and-cancellation') ?>" style="text-decoration:none;color:#0077c5" target="_blank" >Refund</a> | 
                      <a href="<?php echo url('terms-and-conditions') ?>" style="text-decoration:none;color:#0077c5" target="_blank" >Terms of Service</a>
                  </p>
              </td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
