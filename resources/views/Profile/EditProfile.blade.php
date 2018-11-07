
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
	<div class="col-md-12">
		<form class="editProfileForm" action="/">
			<input class="Name" type="Name" placeholder="Name" value="<?php echo old('name') ?>" name="name" required>
			<input class="Last Name" type="email" placeholder="Email" name="email" value="<?php echo old('email') ?>" required>
			<input class="phone InputNumber" type="text" placeholder="Phone" min="10" max="10" name="phone" value="<?php echo old('phone') ?>" required>
		</form>
	</div>
</div>                  