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

if ($user_details['userpriv'] == 1) {
	if ($_POST) {
		$id = $_POST['postID'];
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

		$sql_request = "UPDATE posts SET `name` = '$post_title', `fk_location` = '$post_location', `image` = '$post_image', `homepage` = '$post_homepage', `type` = '$post_type', `poi_type` = '$post_poi_type', `phone` = '$post_phone', `description` = '$post_description', `event_when` = '$post_datetime', `price` = '$post_price' WHERE postID = '$id'";

		if($connect->query($sql_request) === TRUE) {
			header("Location: home.php");

			// echo "
			// <div class='confirmation-message'>
			// 	<p>Record has beed successfully updated</p>
			// 	<a href='p_create.php?id=$id'><button type='button'>Add more</button></a>
			// 	<a href='index.php'><button type='button'>Go Home</button></a>
			// </div>
			// ";
		} else {
			echo "Error while updating record : ". $connect->error;
		}
	}
} else if ($user_details['userpriv'] == 1) {
	echo "you have no rights to perform this action";
} else {
	echo "smth went wrong";
}

$connect->close();

?>