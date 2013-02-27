<h2>New Moron</h2>
<form class="form-horizontal" action="actions/add_contact.php" method="post">
	<div class="control-group">
		<label class="control-label" for="contact_firstname">Moron's First Name</label>
		<div class="controls">
			<?php echo input('contact_firstname','required')?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="contact_lastname">Moron's Last Name</label>
		<div class="controls">
			<?php echo input('contact_lastname','required')?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="contact_phone">Phone Number</label>
		<div class="controls">
			(<?php echo input('contact_phone1','999',null,'phone span1')?>)
			<?php echo input('contact_phone2','888',null,'phone span1')?> - 
			<?php echo input('contact_phone3','7777',null,'phone span2')?>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="contact_email">Email Address</label>
		<div class="controls">
			<?php echo input('contact_email','required')?>
		</div>
	</div>
	<div class="control-group">
		<select name="group_id">
			<?php
			$options = get_options('group',0,'Select a group.');
			echo dropdown('group_id', $options);
			?>
		</select>
	</div>
	<div class="form-actions">
  		<button type="submit" class="btn btn-success"><i class="icon-plus-sign icon-white"></i> Add Moron</button>
  		<button type="button" class="btn">Cancel</button>
	</div>
</form>