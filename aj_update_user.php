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
		if (isset($_POST['info_sent_to_php'])) {
			$data_from_form = $_POST['info_sent_to_php'];
			// var_dump($data_from_form);
			$id = mysqli_real_escape_string($connect, $data_from_form['userid']);
			$new_username = mysqli_real_escape_string($connect, $data_from_form['username']);
			$new_useremail = mysqli_real_escape_string($connect, $data_from_form['useremail']);
			$new_userpass = mysqli_real_escape_string($connect, $data_from_form['userpass']);
			$new_userpic = mysqli_real_escape_string($connect, $data_from_form['userpic']);
			$new_userpriv = mysqli_real_escape_string($connect, $data_from_form['userpriv']);
			$new_userstatus = mysqli_real_escape_string($connect, $data_from_form['userstatus']);

			$sql_request = "UPDATE users SET `username` = '$new_username', `useremail` = '$new_useremail', `userpass` = '$new_userpass', `userpic` = '$new_userpic', `userpriv` = '$new_userpriv', `userstatus` = '$new_userstatus' WHERE userID = '$id'";

			if($connect->query($sql_request) === TRUE) {
				echo TRUE;
			} else {
				echo "Error while updating record : ". $connect->error;
			}
		}
	}
}
$connect->close();

?>