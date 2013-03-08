<?php session_start()?>

<?php
// Import
require_once('../config/db.php');
require_once('../lib/functions.php');

// connect
$conn = connect();

$results = $conn->query("SELECT CONCAT(contact_firstname,' ',contact_lastname) as name FROM contacts WHERE contact_id={$_POST['id']}");
$contact = $results->fetch_assoc();
$name = $contact['name'];
// Execute query
$sql = "DELETE FROM contacts WHERE contact_id={$_POST['id']}";
$conn->query($sql);

// Check for MySQL error
if($conn->errno > 0) {
	// Put SQL error into session
	$error = "<strong>MySQL Error # {$conn->errno}</strong>:";
	$error .= "{$conn->error}</br><strong>SQL:</strong> $sql";
	$_SESSION['message'] = array (
			'type' => 'danger',
			'text' => $error
	);

	// set location header
	header('Location:../?p=list_contacts');

	//kill script
	die();
}

// close
$conn->close();

// redirect with message
$_SESSION['message'] = array (
		'type' => 'warning',
		'text' => "<strong>$name</strong> has been erased from the Earth."
);

header('Location:../?p=list_contacts');
