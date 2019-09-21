<?php
session_start();
if(!isset($_SESSION['user'])) {
	header("Location: index.php");
	exit;
}

require_once 'db_connect.php';

$sql_user = "SELECT * FROM users WHERE userID=".$_SESSION['user'];
$result = $connect->query($sql_user);
$user_details = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<!-- TOP-NAVBAR section -->


<?php 
if ($user_details['userpriv'] == 1) {

include "admin_topnav.php";

echo 
'<div class="page-content create-page">
	<div class="create-location">
		<h3>Add Location</h3>
		<form action="a_create.php"  method="post">
			<div class="form-group">
				<span>ZIP</span>
				<input class="form-control" type= "text" name= "zipcode" placeholder="ZIPcode / PLZ"/>
			</div>
			<div class="form-group">
				<span>Country</span>
				<input class="form-control" type= "text" name="country" placeholder="country"/>
			</div>
			<div class="form-group">
				<span>City</span>
				<input class="form-control" type="text" name="city" placeholder="City" />
			</div>
			<div class="form-group">
				<span>Address</span>
				<input class="form-control" type ="text" name= "address" placeholder="street, house no" />
			</div>
		
			<div class="create-button-container">
				<a href= "home.php"><button class="back-button" type="button">Back</button></a>
				<button type="submit">Save</button>
			</div>
		</form>
	</div>
	<div class="create-location">
		<h3>Add Location</h3>
		<form action="a_create.php"  method="post">
			<div class="form-group">
				<span>ZIP</span>
				<input class="form-control" type= "text" name= "zipcode" placeholder="ZIPcode / PLZ"/>
			</div>
			<div class="form-group">
				<span>Country</span>
				<input class="form-control" type= "text" name="country" placeholder="country"/>
			</div>
			<div class="form-group">
				<span>City</span>
				<input class="form-control" type="text" name="city" placeholder="City" />
			</div>
			<div class="form-group">
				<span>Address</span>
				<input class="form-control" type ="text" name= "address" placeholder="street, house no" />
			</div>
		
			<div class="create-button-container">
				<a href= "home.php"><button class="back-button" type="button">Back</button></a>
				<button type="submit">Save</button>
			</div>
		</form>
	</div>	
</div>';

include "admin_sidebar.php";



	// $sql_location = "SELECT * FROM locations";
	// $result = $connect->query($sql_location); 
	// $locations_list = [];
	// if($result->num_rows > 0) {
	// 	while($row = $result->fetch_assoc()) {
	// 		$locations_list[$row['location_ID']] = {$row['address'], $row['last_name'].' '.$row['last_name'].' '.$row['last_name'];
	// 	}
	// }	

	// $id = $_GET['id'];
	// $sql_delete = "DELETE FROM posts WHERE postID = '$id'" ;

	// if($connect->query($sql_delete) === TRUE) {
	// 	header("Location: home.php");
	// 	exit;
} else if ($user_details['userpriv'] != 1) {
	echo "you have no rights to perform this action";
} else {
	echo "Error while updating record : ". $connect->error;
}




$connect->close(); 
?>
<!-- ********************** JavaScript starts here **********************-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>