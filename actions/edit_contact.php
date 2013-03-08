<?php session_start()?>
<pre><?php print_r($_POST);?></pre>
<?php
// connect to the DB
require_once('../config/db.php');
require_once('../lib/functions.php');
require_once('fields.php');

$conn = connect();

$required = $fields;

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
		//header('Location:../?p=form_edit_contact');

		// Kill script
		die();
	}
}

// execute query
$sql = "UPDATE contacts SET contact_firstname='{$_POST['contact_firstname']}', contact_lastname='{$_POST['contact_lastname']}', contact_email='{$_POST['contact_email']}', contact_phone='{$_POST['contact_phone']}', group_id='{$_POST['group_id']}' WHERE contact_id='{$_POST['contact_id']}'";
$conn->query($sql);

// Check for MySQL error
if($conn->errno > 0) {
	// Put SQL error into session
	$error = "<strong>MySQL Error # {$conn->errno}</strong>:";
	$error .= "{$conn->error}</br><strong>SQL:</strong>$sql";
	$_SESSION['message'] = array (
			'type' => 'danger',
			'text' => $error
	);

	// set location header
	//header('Location:../?p=list_contacts');

	//kill script
	die();
}

// close connection
$conn->close();
// Set message in session data
$_SESSION['message'] = array(
		'type' => 'success',
		'text' => "<strong>$contact_firstname $contact_lastname</strong> has been edited."
);
// redirect
//header('Location:../?p=list_contacts');
?>