<!--*************************************************************************
	up to here is home.php with session check, <body> and user/admin switch 
*****************************************************************************-->
<?php 
	if(!isset($_SESSION['user'])) {
		header("Location: index.php");
		exit;
	}
?>

<?php include "admin_topnav.php"; ?>

<?php include "user_sidebar.php"; ?>