<?php 
// Fetch the name of the group with the id that's in the QS
extract($_GET);

// Connect to the database
$conn = connect();
$sql = "SELECT group_name FROM groups WHERE group_id=$id";
$results = $conn->query($sql);
$group = $results->fetch_assoc();

?>
<h2><?php echo $group['group_name'] ?></h2>
<table class="table">
<thead>
<tr>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
</tr>
</thead>
<tbody>
<?php
// Query the database
$sql = "SELECT * FROM contacts WHERE group_id=$id ORDER BY contact_lastname, contact_firstname";
$results = $conn->query($sql);

// Loop over the contacts & display them
while(($contact = $results->fetch_assoc()) != null) {
	extract($contact);
	?>
	<tr>
		<td><?php echo $contact_firstname ?> <?php echo $contact_lastname ?></td>
		<td><a href="mailto:<?php echo $contact_email ?>"><?php echo $contact_email ?></a></td>
		<td><?php echo format_phone($contact_phone)?></td>
	</tr>
<?php }

// Close the DB
$conn->close();
?>
	</tbody>
</table>