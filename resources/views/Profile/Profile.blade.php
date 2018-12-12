
<h2>Personal Details</h2>
<div class="content-main">
	<div class="logedin-profile-page-image col-lg-3 col-xs-12">
		<a href="javascript:void(0)" class="change_profile">
			<?php 
				if (!empty($profile->image)) {
					?>
					<img class="profile_image_prview" src="<?php echo asset('/'.$profile->image) ?>">
					<?php
				}else{
					?>
					<img class="profile_image_prview" src="<?php echo asset('/') ?>public/images/profile-image.png">
					<?php
				}
			?>	
			<label for="profile_image" style="display: block;"><h3>Change Image</h3></label>
			<input type="file" name="profile_image" id="profile_image" accept="image/*" style="display: none;" />
		</a>
	</div>
	<div class="col-lg-9 col-xs-12 showProfile">
		<div class="messageResponsed"></div>
		@if (Session::has('success'))
		  <div class="alert alert-info">{{ Session::get('success') }}</div>
		@endif
		@if (Session::has('warning'))
		  <div class="alert alert-warning">{{ Session::get('warning') }}</div>
		@endif
		@if (Session::has('error'))
		  <div class="alert alert-danger">{{ Session::get('error') }}</div>
		@endif
		<h3 class="profile-title"><?php echo $profile->name; ?></h3>
		<p class="profile-phone"><?php echo $profile->phone; ?></p>
		<p class="profile-email"><?php echo $profile->email; ?>
			<?php 
				if ($profile->email_verified_at == '0') {
					echo '<span style="background:red; padding:5px; color:white;"><span style="color:white;" class="glyphicon glyphicon-envelope"></span>Email Not Verified</span><span class="varifyEmail" style="cursor:pointer;">verify</span>';
				}else{
					echo '<span style="background:green; padding:5px; color:white;"><span style="color:white;" class="glyphicon glyphicon-envelope"></span>Email Verified</span>';
				}
			?>
		</p>
		<p class="profile-address-line-one"><span>Address</span><?php echo $profile->address; ?></p>
		<p class="profile-city"><span>City</span><?php echo $profile->city; ?></p>
		<p class="profile-state"><span>State</span><?php echo $profile->state; ?></p>
		<p class="profile-country"><span>Country</span><?php echo $profile->country. (!empty($profile->postal_code)?'('.$profile->postal_code.')':''); ?></p>
		<a class="profile-edit-btn" href="<?php echo url('/edit/profile') ?>" data-url="<?php echo url('edit/profile') ?>">Edit Profile</a>
	</div>
</div>                  