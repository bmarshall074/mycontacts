<?php session_start() ?>
<!-- <pre><?php // print_r($_POST);?></pre> -->

<?php
require_once('../config/db.php');
require_once('../lib/functions.php');
require_once('fields.php');

// Extract form data
extract($_POST);


// Validate form data
foreach($fields as $f) {
	// If invalid, redirect with message
	if($f['required'] && (!isset($_POST[$f['name']]) || $_POST[$f['name']] == '')) {
		// Store message into session
		$_SESSION['message'] = array(
				'type' => 'danger',
				'text' => 'Please provide all required information... or are you a moron yourself?'
		);
			
		//Store form data into session data
		$_SESSION['POST'] = $_POST;
		
		// Set location header
		header('Location:../?p=form_edit_group');
		
		// Kill script
		die();
	}
}

// Add Contact to DB

// Connect to the DB
$conn = connect();

// Execute query
$sql = "UPDATE contacts SET group_name='{$_POST['group_name']}' WHERE group_id='{$_POST['group_id']}'";
$conn->query($sql);

// Close DB connection
$conn->close();

// Set message in session data
$_SESSION['message'] = array(
	'type' => 'success',
	'text' => "<strong>$group_name</strong> has been successfully added."
);

// Set location header
header('Location:../?p=list_groups');
?>