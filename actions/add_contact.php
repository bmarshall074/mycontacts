<?php session_start() ?>
<pre><?php print_r($_POST);?></pre>

<?php
require('../config/db.php');
require('../config/app.php');
require('../lib/functions.php');

$required = array(
	'contact_firstname',
	'contact_lastname',
	'contact_email',
	'contact_phone1',
	'contact_phone2',
	'contact_phone3',
		
);
// Extract form data
extract($_POST);

// Validate form data
foreach($required as $r) {
	// If invalid, redirect with message
	if(!isset($_POST[$r]) || $_POST[$r] == '') {
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
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

// Execute query
$contact_phone = $contact_phone1.$contact_phone2.$contact_phone3;
$sql = "INSERT INTO contacts (contact_firstname,contact_lastname,contact_email,contact_phone) VALUES ('$contact_firstname','$contact_lastname','$contact_email',$contact_phone)";
$conn->query($sql);

// Close DB connection
$conn->close();

// Set message in session data
$_SESSION['message'] = array(
	'type' => 'success',
	'text' => '"<strong>$contact_firstname.$contact_lastname</strong>" has been successfully added.'
);

// Set location header
header('Location:../?p=list_contacts');
?>