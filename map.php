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

$sql_events = "SELECT posts.name, lat, lng FROM posts JOIN locations ON fk_location = locationID WHERE locationID = '12'";
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
	
	<script>
	function initMap() {
		var mapOptions = {
			zoom: 5,
			center: new google.maps.LatLng(48, 16),
			mapTypeId: 'roadmap'
		};
// (other types of maps: satellite hybrid terrain )
		var map = new google.maps.Map(document.getElementById('map'), mapOptions);

		// var barcelona = {lat: 41.385100, lng: 2.173400}; 
		// var vienna = {lat: 48,lng: 16};

		// var contentString = '<div id="content">'+
  //           '<div id="siteNotice">'+
  //           '<h1 id="firstHeading" class="firstHeading">Vienna</h1>'+
  //           '<div id="bodyContent">'+
  //           '<p>There should be some text about Vienna</p>' +
  //           '<img src="https://img.icons8.com/plasticine/2x/image.png" alt="" />' +
  //           '</div>'+
  //           '</div>';

  //       var infowindow = new google.maps.InfoWindow({
  //         content: contentString
  //       });
		<?php if($result->num_rows > 0) {
			$count = 5;
			while($row = $result->fetch_assoc()) {
				echo "marker$count = new google.maps.Marker({
					position: {lat: " .$row['lat']. ", lng: " .$row['lng']. "},
					map: map,
					title: '" .$row['name']. "'
				})";
				$count ++;
			}
		} ?>

		// marker2.addListener('click', function() {
  //         infowindow.open(map, marker2);
  //       });
	}
	</script>

	<div id="map"></div>
	<script async defer
		src="https://maps.googleapis.com/maps/api/js?&callback=initMap">
</script>

</div>



<!-- ********************** JavaScript starts here **********************-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>