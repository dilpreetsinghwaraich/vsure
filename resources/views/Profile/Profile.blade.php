
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
	<div class="col-lg-9 col-xs-12">
		<h3 class="profile-title"><?php echo $profile->name; ?></h3>
		<p class="profile-phone"><?php echo $profile->phone; ?></p>
		<p class="profile-email"><?php echo $profile->email; ?></p>
		<p class="profile-address-line-one"><span>Address</span><?php echo $profile->address; ?></p>
		<p class="profile-city"><span>City</span><?php echo $profile->city; ?></p>
		<p class="profile-state"><span>State</span><?php echo $profile->state; ?></p>
		<p class="profile-country"><span>Country</span><?php echo $profile->country. (!empty($profile->postal_code)?'('.$profile->postal_code.')':''); ?></p>
		<a class="profile-edit-btn dashboardLink" href="<?php echo url('/my-account') ?>" data-url="<?php echo url('edit/profile') ?>">Edit Profile</a>
	</div>
</div>                  