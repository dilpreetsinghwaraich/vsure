
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
		<form class="editProfileForm form-horizontal" action="/">
			<div class="messageResponsed"></div>
			<div class="form-group">
				<label for="name">Name</label>
				<input class="name form-control" type="name" placeholder="Name" value="<?php echo $profile->name ?>" name="name">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input class="email form-control" type="email" placeholder="Email" value="<?php echo $profile->email ?>" name="email" required>
			</div>
			<div class="form-group">
				<label for="phone">Phone</label>
				<input class="phone InputNumber form-control" type="text" placeholder="Phone" value="<?php echo $profile->phone ?>" name="phone" required>
			</div>

			<div class="form-group">
				<label for="company">Company</label>
				<input class="company form-control" type="text" placeholder="Company" value="<?php echo $profile->company ?>" name="company" required>
			</div>
			<div class="form-group">
				<label for="country">Country</label>
				<select class="form-control" name="country" id="country">
					<option value="India" selected="">India</option>
				</select>
			</div>
			<div class="form-group">
				<label for="state">State</label>
				<select name="state" id="state" class="form-control">
				  <option value="">---Select State---</option>
				  <?php 
				  if (!empty($states)) {
				    foreach ($states as $state)
				    {
				      echo '<option value="'.$state->state.'" '.($profile->state == $state->state?'selected':'').'>'.$state->state.'</option>';
				    }
				  }
				  ?>
				</select>
			</div>
			<div class="form-group">
				<label for="city">City</label>
				<select name="city" id="city" class="form-control">
					<option value="">---Select City---</option>
					<?php 
					if (!empty($profile->city)) {
						?>
						<option value="<?php echo $profile->city ?>" selected><?php echo $profile->city ?></option>
						<?php
					}
					?>  
				</select>
			</div>
			<div class="form-group">
				<label for="address">Address</label>
				<textarea class="address form-control" placeholder="Address" name="address"><?php echo $profile->address ?></textarea>
			</div>			
			<div class="form-group">
				<label for="postal_code">Postal Code</label>
				<input class="postal_code InputNumber form-control" type="text" placeholder="Postal Code" value="<?php echo $profile->postal_code ?>" name="postal_code">
			</div>
			<div class="form-group">
				<input class="btn btn-success" type="submit">
			</div>
		</form>
	</div>
</div>                  