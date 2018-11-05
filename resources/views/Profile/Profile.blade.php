
<h2>Personal Details</h2>
<div class="content-main">
	<div class="col-lg-3 col-xs-12">
		<?php 
		if (!empty($profile->image) && file_exists(asset('/'.$profile->image))) {
			?>
			<img src="<?php echo asset('/'.$profile->image) ?>">
			<?php
		}else{
			?>
			<img src="<?php echo asset('/') ?>public/images/profile-image.png">
			<?php
		}
		?>		
	</div>
	<div class="col-lg-9 col-xs-12">
		<h3 class="profile-title"><?php echo $profile->name; ?></h3>
		<p class="profile-phone"><?php echo $profile->phone; ?></p>
		<p class="profile-email"><?php echo $profile->email; ?></p>
		<a class="profile-edit-btn" href="<?php echo url('edit/profile') ?>" data-url="<?php echo url('edit/profile/ajax') ?>">Edit Profile</a>
	</div>
</div>                  