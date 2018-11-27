<div class="logedin-notifications-page">
	<h2>My Notifications</h2>
	<div class="content-main">
		<style type="text/css">
		  .container_class {
		      border: 2px solid #dedede;
		      background-color: #f1f1f1;
		      border-radius: 5px;
		      padding: 10px;
		      margin: 10px 0;
		  }

		  .darker {
		      border-color: #ccc;
		      background-color: #ddd;
		  }

		  .container_class::after {
		      content: "";
		      clear: both;
		      display: table;
		  }

		  .time-right {
		      float: right;
		      color: #aaa;
		  }

		  .time-left {
		      float: left;
		      color: #999;
		  }
		</style>

	  <?php 
	  if (!empty($inboxs)) {
	    foreach ($inboxs as $inboxM) {
	      if ($inboxM->admin == 'Send') {
	        $cls = '';
	        $cls2 = 'time-left';
	      }else{
	        $cls = 'darker';
	        $cls2 = 'time-right';
	      }
	      ?>
	        <div class="container_class <?php echo $cls; ?>">
	          <h5><?php echo $inboxM->subject; ?></h5>
	          <p><?php echo $inboxM->message; ?></p>
	          <span class="<?php echo $cls2; ?>"><?php echo date('M, d Y h:i A', strtotime($inboxM->created_at)) ?></span>
	        </div>
	      <?php
	    }
	  }
	  ?>
	   	     
	</div>
	<div class="bgc-white p-20 bd" style="text-align: left;">
	  <h5 class="c-grey-900 mT-10 mt-30 col-md-12">Reply To Admin</h5>
	  <div class="mT-30">
	    <?php echo Form::open(array('url' => 'send/notification/', 'method' => 'post', 'files'=>true)) ?>
	      <div class="form-row">
	        <div class="form-group col-md-12">
	          <label for="subject">Subject</label>
	          <input type="text" class="form-control" id="subject" name="subject" required="" placeholder="Subject">
	        </div>
	        <div class="form-group col-md-12">
	          <label for="message">Message</label>
	          <textarea class="form-control" id="message" name="message" required ></textarea>
	        </div>            
	      </div>  
	      <div class="form-group col-md-12">                                   
	      	<button type="button" class="btn btn-primary" id="sendNotification">Send</button>
	      </div>
	    </form>
	  </div>
	</div>
</div>