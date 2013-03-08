<?php 
// Check to see if user is searching for a contact
$where = '';
if(isset($_GET['q']) && $_GET['q'] != '') {
	extract($_GET);
	$where = "WHERE contact_lastname LIKE '%$q%' OR contact_firstname LIKE '%$q%'";
	echo "<span class=\"label pull-right\">Names containing '$q' <a href=\"./?p=list_contacts\"><i class=\"icon-remove-sign icon-white\"></i></a></span>";
}
?>

<h2>Morons</h2>
<table class="table">
	<thead>
		<tr>
			<th><a href="./?p=list_contacts&sort=firstname">Name</a></th>
			<th><a href="./?p=list_contacts&sort=email">Email</a></th>
			<th>Phone</th>
			<th>Group</th>
			<th>Edit / Delete</th>
		</tr>
	</thead>
	<tbody>
<?php
// Connect to the database
// new mysqli(host,user,password,db name)
$conn = connect();

// Query the database
	// LEFT JOIN - groups you want all rows form, then group you want to join it with
$sql = "SELECT * FROM contacts LEFT JOIN groups ON contacts.group_id=groups.group_id $where ORDER BY contact_lastname,contact_firstname";
$results = $conn->query($sql);

// Loop over the contacts & display them
while(($contact = $results->fetch_assoc()) != null) {
	extract($contact);
	?>
	<tr>
		<td><?php echo $contact_firstname ?> <?php echo $contact_lastname ?></td>
		<td><a href="mailto:<?php echo $contact_email ?>"><?php echo $contact_email ?></a></td>
		<td><?php echo format_phone($contact_phone)?></td>
		<td><?php echo "<a href=\"./?p=group&id=$group_id\" class=\"label label-info\">$group_name</a>"?></td>
		<td><?php echo "<a class='btn btn-warning btn-mini' href='./?p=form_edit_contact&id=$contact_id'><i class='icon-wrench icon-white'></i></a> ";
				  echo 		'<form style="display:inline;" method="post" action="./actions/delete.php">';
				  echo			"<input type=\"hidden\" name=\"id\" value=\"$contact_id\"/>";
				  echo			"<button class='btn btn-danger btn-mini' type='submit'><i class='icon-trash icon-white'></i></button>";
				  echo		"</form>"?>
		</td>
	</tr>
<?php }

// Close the DB
$conn->close();
?>
	</tbody>
</table>