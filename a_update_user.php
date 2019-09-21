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
		if ($_POST) {
		$id = $_POST['userID'];
		$username = $_POST['username'];
		$usermail = $_POST['useremail'];
		$password = $_POST['userpass'];
		$userpic = $_POST['userpic'];
		$userpriv = $_POST['userpriv'];		

		$sql_request = "UPDATE users SET `username` = '$username', `useremail` = '$usermail', `userpass` = '$password', `userpic` = '$userpic', `userpriv` = '$userpriv' WHERE userID = '$id'";

			if($connect->query($sql_request) === TRUE) {
				header("Location: manage_users.php");

			// echo "
			// <div class='confirmation-message'>
			// 	<p>Record has beed successfully updated</p>
			// 	<a href='manage_users.php?id=$id'><button type='button'>Back</button></a>
			// 	<a href='home.php'><button type='button'>Home</button></a>
			// </div>
			// ";
			} else {
				echo "Error while updating record : ". $connect->error;
			}
		}
	}
}
$connect->close();

?>