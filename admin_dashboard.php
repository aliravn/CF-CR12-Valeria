<!--*************************************************************************
	up to here is home.php with session check, <body> and user/admin switch 
*****************************************************************************-->
<?php 
	if(!isset($_SESSION['user'])) {
		header("Location: index.php");
		exit;
	}
?>

<!-- TOP-NAVBAR section -->
<?php include "admin_topnav.php"; ?>

<!-- PAGE CONTENT section -->
<div id="page-content"> </div>

<!-- SIDE-NAVBAR section -->
<?php include "admin_sidebar.php"; ?>