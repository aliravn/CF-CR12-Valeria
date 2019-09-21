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

$sql_events = "SELECT name, image, lat, lng FROM posts JOIN locations ON fk_location = locationID";
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


<!-- SIDEBAR section -->
<?php
if ($user_details['userpriv']==1){
	include "admin_sidebar.php";
} else {
	include "user_sidebar.php";
}
?>

<!-- PAGE CONTENT section -->
<div class="page-content">

	<div id="map"></div>

</div>



<!-- ********************** JavaScript starts here **********************-->
<script>
function initMap() {
	var mapOptions = {
		zoom: 2.5,
		center: new google.maps.LatLng(48.056010, 64.997570),
		mapTypeId: 'roadmap'
	};

	var map = new google.maps.Map(document.getElementById('map'), mapOptions);

	<?php if($result->num_rows > 0) {
		$count = 1;
		while($row = $result->fetch_assoc()) {
			echo "
			marker$count = new google.maps.Marker({
			position: {lat: " .$row['lat']. ", lng: " .$row['lng']. "},
			map: map,
			title: '" .$row['name']. "'
			});";
			$count ++;
		}
	} 
	?>
}
</script>
<script async defer	src="https://maps.googleapis.com/maps/api/js?&callback=initMap"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>