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
		$sql_request = "SELECT * FROM posts WHERE postID = '$id'";
		$result = $connect->query($sql_request); 
		$data = $result->fetch_assoc(); 

		$sql_location = "SELECT * FROM locations";
		$result = $connect->query($sql_location); 
		$location_list = [];
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$location_list[$row['locationID']] = $row['address'].', '.$row['city'].', '.$row['zipcode'].', '.$row['country'];
			}
		}
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

<?php include "admin_sidebar.php"; ?>
<!-- CONTENT section -->
<div class="page-content">
	<div class="create-location create-post">
		<h3>Update entry</h3>
		<form action="a_create.php"  method="post">
			<div class="form-group">
				<span>Title:</span>
				<input class="form-control" type= "text" name= "name" value="<?php echo $data['name']; ?>" />
			</div>
			<div class="form-group">
				<span>Where it was</span>
				<select class="form-control" name="fk_location">';
					<?php foreach($location_list as $locationID=>$full_address) {
                        echo "<option value=$locationID>$full_address</option>";
					} ?>
				</select>
			</div>
			<div class="form-group">
				<span>Teaser image:</span>
				<input class="form-control" type= "URL" name= "image" value="<?php echo $data['image']; ?>" placeholder="image URL" />
			</div>						
			<div class="form-group">
				<span>Homepage:</span>
				<input class="form-control" type= "text" name= "homepage" value="<?php echo $data['homepage']; ?>"placeholder="homepage"/>
			</div>
			<div class="form-group">
				<span>Type (only for estaurant / place): </span>
				<input class="form-control" type= "text" name= "type" value="<?php echo $data['type']; ?>" placeholder="cusine type / museum / gallery / etc"/>
			</div>
			<div class="form-group">
				<span>Type of entry</span>
				<select class="form-control" name= "poi_type">
					<option value="restaurant">Restaurant</option>
					<option value="event">Event</option>
					<option value="place">Place</option>
				</select>
			</div>
			<div class="form-group">
				<span>Phone</span>
				<input class="form-control" type= "text" name= "phone" value="<?php echo $data['phone']; ?>"placeholder="phone number"/>
			</div>
			<div class="form-group">
				<span>Description</span>
				<input class="form-control" type= "text" name= "description" value="<?php echo $data['description']; ?>" placeholder="description"/>
			</div>
			<div class="form-group">
				<span>Date and Time (only event): </span>
				<input class="form-control" type= "text" name= "event_when" value="<?php echo $data['event_when']; ?>" placeholder="event date & time" />
			</div>
			<div class="form-group">
				<span>Ticket price: </span>
				<input class="form-control" type= "text" name= "price" value="<?php echo $data['price']; ?>"placeholder="ticket price"/>
			</div>
			<div class="create-button-container">
				<a href= "home.php"><button class="back-button" type="button">Back</button></a>
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