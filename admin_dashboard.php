<!-- up to here is home.php with session check, <body> and user/admin switch -->

<?php

require_once "db_connect.php";

if(!isset($_SESSION['user'])) {
	header("Location: index.php");
	exit;
}
// WHERE poi_type = 'event'
$sql_request = "SELECT posts.*, concat(address, ' ', city, ' ', zipcode, ' ', country) as location FROM posts JOIN locations ON fk_location = locationID ORDER BY created";
$result = $connect->query($sql_request);
?>

<!-- TOP-NAVBAR section -->
<?php include "admin_topnav.php"; ?>

<!-- PAGE CONTENT section -->
<div id="page-content">
<!-- 	<h3>RECENT POSTS</h3> -->
	<div class="container-fluid">
		<div class="row">
			<?php 
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo 
					"<div class='col-12 col-md-6 col-lg-4 p-3'>
						<div class='col-border'>
							<img class='img-fluid img-thumbnail' src=".$row['image'].">
							<p class='post-text post-title'>Title: ".$row['name']."</p>
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
<?php include "admin_sidebar.php"; ?>