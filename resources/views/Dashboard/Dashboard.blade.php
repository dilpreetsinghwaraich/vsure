<?php 
	$profile =  Helper::getCurrentUser(); 
?>
<div class="header">
   <div class="bg-color" style="background: url('<?php echo asset('/public'); ?>/images/home-back.jpg')">
      	<div class="wrapper">
			<div class="banner-info thanku-page-banner banners-home wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
           		<h1 class="bnr-title  text-center gallery">Hello, <?php echo $profile->name; ?></h1>
	        </div>
	    </div>
	</div>
</div>
<section id="feature" class="thanks-page-content wow fadeIn delay-05s animated" style="visibility: visible; animation-name: fadeIn;">
    <div class="text-center">
        <div class="logedin-profile-page">
            <div class="row">               
               	<div class="col-lg-3 col-md-3 col-xs-12 sidebar my-account-sidebar-menu">
        					<h2>Menu</h2>
        					<a class=" " href="<?php echo url('my-account'); ?>" data-url="<?php echo url('my-profile'); ?>">My Profile</a>
        					<a class=" " href="<?php echo url('my-order') ?>" data-url="<?php echo url('my-order'); ?>">My Orders</a>
        					<a class=" " href="<?php echo url('my-documents') ?>" data-url="<?php echo url('my-documents'); ?>">My Documents</a>
        					<a class=" " href="<?php echo url('my-deliverable') ?>" data-url="<?php echo url('my-deliverable'); ?>">My Deliverable</a>
                  <a class=" " href="<?php echo url('my-service-request') ?>" data-url="<?php echo url(''); ?>">My Service Request</a>
                  <a class=" " href="<?php echo url('my-notifications') ?>" data-url="<?php echo url('my-notifications'); ?>">My Notifications</a>
					         <a href="<?php echo url('auth/logout') ?>">Logout</a>
                </div>

                <div class="col-lg-9 col-xs-12 content" id="dashboardViw">
            		  <?php echo $html; ?>
                </div>
            </div>
        </div>
    </div>
</section>