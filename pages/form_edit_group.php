<?php
// Connect to the DB
require_once('./config/db.php');
require_once('./lib/functions.php');
$conn = connect();

// Execute SELECT query
$sql = "SELECT * FROM contacts WHERE group_id={$_GET['id']}";
$results = $conn->query($sql);

// Store the contact date
$group = $results->fetch_assoc();
extract($group);

// Close the connection
$conn->close();

?>
<h2>Edit a Group</h2>
<form action="actions/edit_group.php" method="post">
	<label>First Name</label>
	<input type="text" name="group_name" value="<?php echo $group_name ?>" />
	<br/>
	
	<input type="hidden" name="contact_id" value="<?php echo $_GET['id'];?>"/>
	<input type="submit" value="Edit" />
	
	<div class="form-actions">
		<button type="submit" class="btn btn-warning"><i class="icon-edit icon-white"></i> Edit Group</button>
		<button type="button" class="btn" onclick="window.history.go(-1)">Cancel</button>
	</div>
</form>