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
		$post_title = $_POST['name'];
		$post_location = $_POST['fk_location'];
		$post_image = $_POST['image'];
		$post_homepage = $_POST['homepage'];
		$post_type = $_POST['type'];
		$post_poi_type = $_POST['poi_type'];
		$post_phone = $_POST['phone'];
		$post_description = $_POST['description'];
		$post_datetime = $_POST['event_when'];
		$post_price = $_POST['price'];

		$sql_request = "INSERT INTO posts (`name`, `fk_location`, `image`, `homepage`, `type`, `poi_type`, `phone`, `description`, `event_when`, `price`) VALUES ('$post_title', '$post_location', '$post_image', '$post_homepage', '$post_type', '$post_poi_type', '$post_phone', '$post_description', '$post_datetime', '$post_price')";

			if($connect->query($sql_request) === TRUE) {
				header("Location: home.php");

			// echo "
			// <div class='confirmation-message'>
			// 	<p>Record has beed successfully added to the library</p>
			// 	<a href='p_create.php?id=$id'><button type='button'>Add more</button></a>
			// 	<a href='index.php'><button type='button'>Go Home</button></a>
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