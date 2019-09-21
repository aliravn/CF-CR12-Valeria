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
		if ($_GET['id']) {
		$id = $_GET['id'];
		$sql_request = "SELECT * FROM users WHERE userID = '$id'";
		$result = $connect->query($sql_request); 
		$data = $result->fetch_assoc(); 
	}
}
}
$connect->close(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
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
<div class="page-content">
	<div class="create-location create-post">
		<h3>Update User</h3>
		<form action="a_user_update.php"  method="post">
			<div class="form-group">
				<span>ID:</span>
				<input class="form-control" type= "text" name= "postID" value="<?php echo $data['userID']; ?>" />
			</div>			
			
			<div class="form-group">
				<span>Title:</span>
				<input class="form-control" type= "text" name= "name" value="<?php echo $data['username']; ?>" />
			</div>
			<div class="form-group">
				<span>Email:</span>
				<input class="form-control" type= "text" name= "useremail" value="<?php echo $data['useremail']; ?>" />
			</div>				
			<div class="form-group">
				<span>Password:</span>
				<input class="form-control" type= "text" name= "useremail" value="<?php echo $data['userpass']; ?>" />
			</div>						
			<div class="form-group">
				<span>Userpic:</span>
				<input class="form-control" type= "text" name= "userpic" value="<?php echo $data['userpic']; ?>" />
			</div>
			<div class="form-group">
				<span>Admin/User</span>
				<input class="form-control" type= "text" name= "userpriv" value="<?php echo $data['userpriv']; ?>" />
			</div>
			<div class="create-button-container">
				<a href= "manage_users.php"><button class="back-button" type="button">Back</button></a>
				<a href= "home.php"><button class="back-button" type="button">Home</button></a>
				<button type="submit">Save</button>
			</div>			
		</form>
	</div>
</div>	
<!-- ********************** JavaScript starts here **********************-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>