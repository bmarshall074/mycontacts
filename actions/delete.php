<?php
//connect
require('../config/db.php');
require('../config/app.php');
require('../lib/functions.php');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$sql = "DELETE FROM contacts WHERE contact_id={$_POST['id']}";
$conn->query($sql);
//close
$conn->close();
//redirect
header('Location:../list_contacts.php');
