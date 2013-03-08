<?php session_start() ?>
<!-- <pre><?php // print_r($_POST);?></pre> -->

<?php
require_once('../config/db.php');
require_once('../lib/functions.php');
require_once('fields.php');

// Extract form data
extract($_POST);

// Combine phone numbers
$_POST['contact_phone'] = $_POST['contact_phone1'].$_POST['contact_phone2'].$_POST['contact_phone3'];

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
		header('Location:../?p=form_add_contact');
		
		// Kill script
		die();
	}
}

// Add Contact to DB

// Connect to the DB
$conn = connect();

// Execute query
$contact_phone = $contact_phone1.$contact_phone2.$contact_phone3;
$sql = "INSERT INTO contacts (contact_firstname,contact_lastname,contact_email,contact_phone,group_id) VALUES ('$contact_firstname','$contact_lastname','$contact_email','$contact_phone',$group_id)";
$conn->query($sql);

// Check for MySQL error
if($conn->errno > 0) {
	// Put SQL error into session
	$error = "<strong>MySQL Error # {$conn->errno}</strong>:";
	$error .= "{$conn->error}</br><strong>SQL:</strong>#sql";
	$_SESSION['message'] = array (
		'type' => 'danger',
		'text' => $error	
	);
	
	// set location header
	header('Location:../?p=list_contacts');
	
	//kill script
	die();
}

// Close DB connection
$conn->close();

// Set message in session data
$_SESSION['message'] = array(
	'type' => 'success',
	'text' => "<strong>$contact_firstname $contact_lastname</strong> has been successfully added."
);

// Set location header
header('Location:../?p=list_contacts');
?>