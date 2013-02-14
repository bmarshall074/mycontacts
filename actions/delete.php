<?php
// Import
require_once('../config/db.php');
require_once('../lib/functions.php');

// connect
$conn = connect();

// Execute query
$sql = "DELETE FROM contacts WHERE contact_id={$_POST['contact_id']}";
$conn->query($sql);

// close
$conn->close();

// redirect with message
$_SESSION['message'] = array (
		'type' => 'warning',
		'text' => 'The moron has been erased.'
);
header('Location:../list_contacts.php');
