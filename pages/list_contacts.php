<h2>Morons</h2>
<table class="table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Edit/Delete</th>
		</tr>
	</thead>
	<tbody>
<?php
// Connect to the database
// new mysqli(host,user,password,db name)
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

// Query the database
$sql = "SELECT * FROM contacts ORDER BY contact_lastname, contact_firstname";
$results = $conn->query($sql);

// Loop over the contacts & display them
while(($contact = $results->fetch_assoc()) != null) {
	extract($contact);
	?>
	<tr>
		<td><?php echo $contact_firstname ?> <?php echo $contact_lastname ?></td>
		<td><a href="mailto:<?php echo $contact_email ?>"><?php echo $contact_email ?></a></td>
		<td><?php echo format_phone($contact_phone)?></td>
		<td><?php echo '<a href="./?p=form_edit_contact&id=$contact_id">edit</a>';
				  echo 		'<form style="display:inline;" method="post" action="delete.php">';
				  echo			"<input type=\"hidden\" name=\"id\" value=\"$contact_id\"/>";
				  echo			'<input type="submit" value="delete" />';
				  echo		"</form>"?>
		</td>
	</tr>
<?php }

// Close the DB
$conn->close();
?>
	</tbody>
</table>