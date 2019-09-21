<?php
session_start();
if(!isset($_SESSION['user'])) {
	header("Location: index.php");
	exit;
} else {
	require_once 'db_connect.php';

	$sql_user = "SELECT * FROM users WHERE userID=".$_SESSION['user'];
	$result = $connect->query($sql_user);
	$user_details = mysqli_fetch_array($result, MYSQLI_ASSOC);

	if ($user_details['userpriv'] != 1) {
		header("Location: home.php");
		exit;
	} else {
		$sql_request = "SELECT * FROM users";
		$result = $connect->query($sql_request); 
	}
}
$connect->close(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Manage Users</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<!-- TOP-NAVBAR section -->
<?php include "admin_topnav.php"; ?>

<!-- SIDEBAR section -->
<?php include "admin_sidebar.php"; ?>

<!-- CONTENT section -->
<div class="page-content manage-user-page">

	<a href="p_create.php">
		<button class="btn btn-success" id="add-user-button" type="button">Add user</button>
	</a>



	<table  border="1" cellspacing= "0" cellpadding="0" class="table">
		<thead>
			<tr>
				<th>#</th>
				<th>userID</th>
				<th>username</th>
				<th>useremail</th>
				<th>userpic</th>
				<th>regdate</th>
				<th>userpriv</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$count = 1;
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo  
					"<tr>
						<td>$count</td>
						<td>" .$row['userID']."</td>
						<td>" .$row['username']."</td>
						<td>" .$row['useremail']."</td>
						<td>" .$row['userpic']."</td>
						<td>" .$row['regdate']."</td>
						<td>" .$row['userpriv']."</td>
						<td class='manipulate-button-container'>
						<a class='' href='update_user.php?id=" .$row['userID']."'><button class='user-manipulate-button' type='button'>Edit</button></a>
						<a class='' href='#?id=" .$row['media_lib_ID']."'><button class='user-manipulate-button' type='button'>Delete</button></a>
						</td>
					</tr>";
					$count++;
				}
			} else  {
				echo  "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
			}
			?>
		</tbody>
	</table>

</div>	
<!-- ********************** JavaScript starts here **********************-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>