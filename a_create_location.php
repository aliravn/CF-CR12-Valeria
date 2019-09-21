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
		$loc_zip = $_POST['zipcode'];
		$loc_country = $_POST['country'];
		$loc_city = $_POST['city'];
		$loc_address = $_POST['address'];

		$sql_request = "INSERT INTO locations (`zipcode`, `country`, `city`, `address`) VALUES ('$loc_zip', '$loc_country', '$loc_city', '$loc_address')";

		if($connect->query($sql_request) === TRUE) {
			echo "
			<div class='confirmation-message'>
				<p>Record has beed successfully added to the database</p>
				<a href='create.php?id=$id'><button type='button'>Add more</button></a>
				<a href='home.php'><button type='button'>Home</button></a>
			</div>
			";
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