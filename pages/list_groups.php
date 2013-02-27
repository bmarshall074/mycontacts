<h2>Groups</h2>
<table class="table">
	<thead>
		<tr>
			<th>Group Name</th>
			<th>Members</th>
			<th>Edit / Delete</th>
		</tr>
	</thead>
	<tbody>
<?php
// Connect to the database
// new mysqli(host,user,password,db name)
$conn = connect();

// Query the database
$sql = "SELECT groups.*, COUNT(contact_id) AS num_contacts FROM groups LEFT JOIN contacts ON groups.group_id=contacts.group_id GROUP BY groups.group_id ORDER BY num_contacts DESC";
$results = $conn->query($sql);

// Loop over the contacts & display them
while(($group = $results->fetch_assoc()) != null) {
	extract($group);
	?>
	<tr>
		<td><?php echo "<a href=\"./?p=group&id=$group_id\">$group_name</a>"?> </td>
		<td><?php echo "<span class=\"badge badge-info\">$num_contacts</span>"?></td>
		<td><?php echo "<a class='btn btn-warning btn-mini' href='./?p=form_edit_contact&id=$group_id'><i class='icon-wrench icon-white'></i></a> ";
				  echo 		'<form style="display:inline;" method="post" action="./actions/delete_group.php">';
				  echo			"<input type=\"hidden\" name=\"id\" value=\"$group_id\"/>";
				  echo			"<a class='btn btn-danger btn-mini' href='./actions/delete.php?id=$group_id'><i class='icon-trash icon-white'></i></a>";
				  echo		"</form>"?>
		</td>
	</tr>
<?php }

// Close the DB
$conn->close();
?>
	</tbody>
</table>