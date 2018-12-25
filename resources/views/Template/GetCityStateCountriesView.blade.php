<div class="row">
	<div class="form-group col-md-12">
		<label for="country">Country</label>
		<select class="form-control" name="country" id="ajax_country">
			<option value="">Select</option>
			<?php 
			if (!empty($countries)) {
				foreach ($countries as $country) {
					echo '<option value="'.$country->id.'" '.($country->id == $country_id?'selected':'').'>'.$country->name.'</option>';
				}
			}
			?>
		</select>                  
	</div>
	<div class="form-group col-md-12">
		<label for="state">State</label>
		<select class="form-control" name="state" id="ajax_state">
			<option value="<?php echo $state_id ?>"><?php echo Helper::getState($state_id) ?></option>
		</select>  
		</div>
	<div class="form-group col-md-12">
		<label for="city">City</label>
		<select class="form-control" name="city" id="ajax_city">
			<option value="<?php echo $city_id ?>"><?php echo Helper::getCity($city_id) ?></option>
		</select>            
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(document).on('change', '#ajax_country', function(event) {
			event.preventDefault();
			var country_id = $(this).val();
			$.ajax({
				url: '<?php echo url('getStatesByCountryID') ?>/'+country_id,
				type: 'GET',
			})
			.done(function(data) {
				$('#ajax_state').html(data);
			})
			.fail(function() {
				window.alert('Something Went Wrong, Please try after sometime.')
			});			
		});
		$(document).on('change', '#ajax_state', function(event) {
			event.preventDefault();
			var state_id = $(this).val();
			$.ajax({
				url: '<?php echo url('getCitiesByStateID') ?>/'+state_id,
				type: 'GET',
			})
			.done(function(data) {
				$('#ajax_city').html(data);
			})
			.fail(function() {
				window.alert('Something Went Wrong, Please try after sometime.')
			});			
		});
	});
</script>