<!-- up to here is home.php with session check, <body> and user/admin switch -->

<?php 
	if(!isset($_SESSION['user'])) {
		header("Location: index.php");
		exit;
	}
?>

<!-- TOP-NAVBAR section -->
<?php include "admin_topnav.php"; ?>

<!-- PAGE CONTENT section -->
<div id="page-content"> 
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-md-6 col-lg-3 p-2">
				<div class="col-border">
					<img class="img-fluid img-thumbnail d-none d-md-block" src="img/place_sensoji.jpg">
					<h4>NAME</h4>
					<p>DATE</p>
					<div class="text-container d-none d-md-block">
						<p>ADDRESS</p>
					</div>
				</div>	
			</div>

			<div class="col-12 col-md-6 col-lg-3 p-2">
				<div class="col-border">
					<img class="img-fluid img-thumbnail d-none d-md-block" src="img/place_sensoji.jpg">
					<h4>NAME</h4>
					<p>DATE</p>
					<div class="text-container d-none d-md-block">
						<p>ADDRESS</p>
					</div>
				</div>	
			</div>

			<div class="col-12 col-md-6 col-lg-3 p-2">
				<div class="col-border">
					<img class="img-fluid img-thumbnail d-none d-md-block" src="img/place_sensoji.jpg">
					<h4>NAME</h4>
					<p>DATE</p>
					<div class="text-container d-none d-md-block">
						<p>ADDRESS</p>
					</div>
				</div>	
			</div>

			<div class="col-12 col-md-6 col-lg-3 p-2">
				<div class="col-border">
					<img class="img-fluid img-thumbnail d-none d-md-block" src="img/place_sensoji.jpg">
					<h4>NAME</h4>
					<p>DATE</p>
					<div class="text-container d-none d-md-block">
					<p>ADDRESS</p>
				</div>
			</div>	
		</div>
	</div>
</div>

</div>

<!-- SIDE-NAVBAR section -->
<?php include "admin_sidebar.php"; ?>