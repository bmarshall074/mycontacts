<?php session_start()?>

<?php
// connect to the DB
require('../config/db.php');
require('../config/app.php');
require('../lib/functions.php');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

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
		header('Location:../?p=form_edit_contact');

		// Kill script
		die();
	}
}

// execute query
$sql = "UPDATE contacts SET contact_firstname='{$_POST['contact_firstname']}', contact_lastname='{$_POST['contact_lastname']}', contact_email='{$_POST['contact_email']}', contact_phone='{$_POST['contact_phone']}' WHERE contact_id='{$_POST['contact_id']}'";
$conn->query($sql);
// close connection
$conn->close();
// Set message in session data
$_SESSION['message'] = array(
		'type' => 'success',
		'text' => '"<strong>$contact_firstname.$contact_lastname</strong>" has been edited.'
);
// redirect
header('Location:../list_contacts.php');
?>