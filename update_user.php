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
		if ($_GET['id']) {
		$id = $_GET['id'];
		$sql_request = "SELECT * FROM users WHERE userID = '$id'";
		$result = $connect->query($sql_request); 
		$data = $result->fetch_assoc(); 
	}
}
}
$connect->close(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>

<!-- TOP-NAVBAR section -->
<?php include "admin_topnav.php"; ?>

<!-- SIDEBAR section -->
<?php include "admin_sidebar.php"; ?>

<!-- CONTENT section -->
<div class="page-content">
	<div class="create-location create-post">
		<h3>Update User</h3>

		<div id="update"></div>
		<form action=""  method="post">
			<div class="form-group">
				<span>ID:</span>
				<input class="form-control" id="user_id" type= "text" name= "userID" value="<?php echo $data['userID']; ?>" readonly/>
			</div>			
			
			<div class="form-group">
				<span>Username:</span>
				<input class="form-control" id="user_name" type= "text" name= "username" value="<?php echo $data['username']; ?>" />
			</div>
			<div class="form-group">
				<span>Email:</span>
				<input class="form-control" id="user_mail" type= "text" name= "useremail" value="<?php echo $data['useremail']; ?>" />
			</div>				
			<div class="form-group">
<!-- 				<span>Password:</span> -->
				<input class="form-control" id="user_pass" type= "hidden" name= "user_pass" value="<?php echo $data['userpass']; ?>" />
			</div>						
			<div class="form-group">
				<span>Userpic:</span>
				<input class="form-control" id="user_pic" type= "text" name= "userpic" value="<?php echo $data['userpic']; ?>" />
			</div>
			<div class="form-group">
				<span>Admin/User</span>
				<input class="form-control" id="user_priv"type= "text" name= "userpriv" value="<?php echo $data['userpriv']; ?>" />
			</div>
			<div class="create-button-container">
				<a href= "manage_users.php"><button class="back-button" type="button">Back</button></a>
				<a href= "home.php"><button class="back-button" type="button">Home</button></a>
				<button id="submit-button" type="submit">Save</button>
			</div>			
		</form>
	</div>
</div>

<script>
$(document).ready(function() {
	$('#submit-button').click(function(e) {
		e.preventDefault();
		var user_id = $('#user_id').val();
		var new_username = $('#user_name').val();
		var new_useremail = $('#user_mail').val();
		var new_userpass = $('#user_pass').val();	
		var new_userpic = $('#user_pic').val();
		var new_userpriv = $('#user_priv').val();
		var array_to_send = {userid: user_id, username:new_username, useremail:new_useremail, userpass:new_userpass, userpic:new_userpic, userpriv:new_userpriv};
		$.ajax({
			url:'aj_update_user.php',
			method:"POST",
			data:{info_sent_to_php:array_to_send},
			success:function(data) {
				// console.log(data);
				if (data == 1) {
					$('#update').html('<span>User credentials are updated</span>');
					$('#update').css("background-color","green");	
				} else {
					$('#update').html(`<span class="text-danger">${data}</span>`);
				}	
			}
		})
	});
})

$(document).ready(function(){
	$('input').focus(function(){
		$('#update').empty();
		$('#update').css("background-color","transparent");		
	})
});
</script>






<!-- ********************** JavaScript starts here **********************-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>