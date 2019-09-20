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

if ($user_details['userpriv']==1 && $_GET['id']) {
	$id = $_GET['id'];
	$sql_delete = "DELETE FROM posts WHERE postID = '$id'" ;

	if($connect->query($sql_delete) === TRUE) {
		header("Location: home.php");
		exit;
	}
} else if ($user_details['userpriv'] != 1) {
	echo "you have no rights to perform this action";
} else {
	echo "Error while updating record : ". $connect->error;
}

$connect->close();
?>

