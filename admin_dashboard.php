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
var_dump($result);
?>

<!-- TOP-NAVBAR section -->
<?php include "admin_topnav.php"; ?>

<!-- PAGE CONTENT section -->
<div id="page-content"> 
	<div class="container-fluid">
		<div class="row">
			<?php 
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo 
					"<div class='col-12 col-md-6 col-lg-3 p-2'>
						<div class='col-border'>
							<img class='img-fluid img-thumbnail' src=".$row['image'].">
							<h4>".$row['name']."</h4>
							<p>".$row['event_when']."</p>
							<div class='text-container d-none d-md-block'>
								<p>".$row['location']."</p>
							</div>
						</div>	
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