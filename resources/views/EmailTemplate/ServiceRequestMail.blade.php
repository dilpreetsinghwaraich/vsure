<div class="m_920944854452305130span12">
  <div class="adM">
    <p> </p>
  </div>
  <div style="width:710px;margin:0">
    <div class="adM"> </div>    
    <p dir="ltr">Hi <?php echo $currentUser->name ?>,<br>
      <br>
      Thank you for your inquiry for <?php echo $service->service_title ?>.</p>
    <p dir="ltr">You are now in right hand for your service request. If You have not complete your service request form, You can do complete from below link : </p>
    <br>
    <p dir="ltr">Service Request Form : <a href="<?php echo url('/help/desk/ticket/'.$ticket) ?>" style="background:#8fca43;padding:13px 10px;color:#333;font-size:16px;border:0;border-radius:0;width:100%;text-decoration:none;text-transform:uppercase">Get started now</a></p></br>
    <p dir="ltr">You can call us at +91-8800849054 for any query if you have.<br>
      <br>
      Also, we are giving away free consultation assistance to you if you contact us within 48 hours of your subscription.  </p>
      <p dir="ltr">Don't hesitate to contact us if you have any questions or concerns. We consider our customers as apart of our family and we love to hear from them.</p>
    &nbsp;
    <br>
      <?php 
      if ($userType == 'new') {
       ?>
        <p dir="ltr"><b>Usrname: </b><?php echo $email; ?></p>
        <br>
        <p dir="ltr"><b>Password: </b><?php echo $password ?></p>
       <?php  
      } ?>
      <br>
      Regards<br>
      Team Vsure CFO<br>
      Sector 47, <br>
      Gurgaon<br>

    &nbsp;
    <p style="text-align:center">Please see - We are not spamming you in any way. You are receiving this email because you subscribed us on our website - <a href="<?php echo url('/') ?>" style="background:#8fca43;padding:13px 10px;color:#333;font-size:16px;border:0;border-radius:0;width:100%;text-decoration:none;text-transform:uppercase">www.vsurecfo.com</a><br>
    In case you wish to unsubscribe, please reply to this email saying “Unsubscribe” and we’ll remove you from the list.
    </p>
    &nbsp;&nbsp;
  </div>
</div>
