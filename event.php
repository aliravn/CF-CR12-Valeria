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

$sql_events = "SELECT posts.*, concat(address, ' ', city, ' ', zipcode, ' ', country) as location FROM posts JOIN locations ON fk_location = locationID WHERE poi_type = 'event' OR poi_type = 'place' ORDER BY created DESC";
$result = $connect->query($sql_events);

$connect->close(); 
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
<?php include "admin_topnav.php"; ?>


<?php 
if ($user_details['userpriv']==1){
	include "admin_sidebar.php";
} else {
	include "user_sidebar.php";
} 
?>

<!-- PAGE CONTENT section -->
<div class="page-content">
	<div class="container-fluid">
		<div class="row">
			<?php 
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo 
					"<div class='col-12 col-md-6 col-lg-4 p-3'>
						<div class='col-border'>
							<img class='img-fluid img-thumbnail' src=".$row['image'].">";
					if ($user_details['userpriv']==1){
						echo "<div class='button-container'>
						<a class='' href='update.php?id=" .$row['postID']."'><button class='manipulate-button' type='button'>Edit</button></a>
						<a class='' href='a_delete.php?id=" .$row['postID']."'><button class='manipulate-button' type='button'>Delete</button></a>
						</div>";
					}	
					echo "<p class='post-text post-title'>Title: ".$row['name']."</p>
						<p class='post-text'>Created on: ".$row['created']."</p>
							<span class='post-text'>Web: </span><a class='post-text post-link' href='".$row['homepage']."'target='_blank'>".$row['homepage']."</a>";
					if ($row['event_when'] != NULL){
						echo "<p class='post-text'>Date/Time: ".$row['event_when']."</p>
							<p class='post-text'> Ticket price: ".$row['price']."</p>";
					}
					if ($row['type'] != NULL) {
						echo "<p class='post-text'>Type: ".$row['type']."</p>";
					}
					echo 	
					"<p class='d-none d-md-block post-text'>Address: ".$row['location']."</p>";
					if ($row['phone'] != NULL) {
						echo "<p class='post-text'>Phone: ".$row['phone']."</p>";
					}
					if ($row['description'] != NULL) {
						echo "<p class='post-text'>About: ".$row['description']."</p>";
					}	
					echo "</div>	
					</div>";
				} 
			} else {
				echo "No Data Avaliable";
			}	
			?>
		</div>
	</div>
</div>

</div>

<!-- SIDE-NAVBAR section -->
<?php 
if ($user_details['userpriv']==1){
	include "admin_sidebar.php";
} else {
	include "user_sidebar.php";
} 
?>



<!-- ********************** JavaScript starts here **********************-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>