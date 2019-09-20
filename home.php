<?php
	ob_start();
	session_start();
	require_once 'db_connect.php';

	if( !isset($_SESSION[ 'user' ]) ) {
		header("Location: index.php");
		exit;
	}

	$result_sql_user = mysqli_query($connect, "SELECT * FROM users WHERE userID=".$_SESSION['user']);
	$user_details = mysqli_fetch_array($result_sql_user, MYSQLI_ASSOC);
	// var_dump($userRow);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<?php 
if ($user_details['userpriv']==1){
	include "admin_dashboard.php";
} else { 
	include "user_home.php";
} 
?>

	<div class="login-cred">
		<div class="login-name">
			Hi <span><?php echo $user_details['username']; ?></span>
		</div>
		<div class="logout">
			<a href="logout.php?logout" class="btn">Sign Out</a>
		</div>
	</div>
			
<div class="page-wrapper">

<?php if($user_details['userrole' ]==1){ ?>
	<a href="create.php">
		<button class="btn btn-success" id="add-item-button" type="button">Add new media</button>
	</a>

	<a href="create_author.php">
		<button class="btn btn-success" id="add-item-button" type="button">Add new author</button>
	</a>

<!-- 	<script>
		$("#add-item-form-container").hide();
		$("#add-item-button").click(function(e){
			e.preventDefault();
			$("#add-item-form-container").show();
			$("#add-item-button").hide();
		})
	</script> -->

	<table  border="1" cellspacing= "0" cellpadding="0" class="table">
		<thead>
			<tr>
				<th>#</th>
				<th>ISBN</th>
				<th>Title</th>
				<th>Author</th>
				<th>Cover</th>
				<th>Summary</th>
				<th>Date Published</th>
				<th>Publisher</th>
				<th>Media Type</th>
				<th>Availability</th>
				<th>Manipulate</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql_request = "SELECT media_lib_ID, isbn_code, title, concat(first_name, ' ', last_name) as author, cover_image, short_description, publish_date, media_type, media_status, name, publisher_ID FROM media JOIN authors ON authors.author_ID = media.fk_author JOIN publishers ON publishers.publisher_ID = media.fk_publisher ORDER BY title";
			$result = $connect->query($sql_request); 

			$count = 1;
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo  
					"<tr>
						<td>$count</td>
						<td>" .$row['isbn_code']."</td>
						<td>" .$row['title']."</td>
						<td>" .$row['author']."</td>
						<td class='cover-container'><img class='img-thumbnail img-fluid img-size' src=" .$row['cover_image']." alt='some image'/></td>
						<td>" .$row['short_description']."</td>
						<td class='publish-date-container'>" .$row['publish_date']."</td>
						<td><a href='p_publisher.php?id=".$row['publisher_ID']."'/>".$row['name']."</a></td>
						<td>" .$row['media_type']."</td>
						<td class='status-container'>" .$row['media_status']."</td>
					<td class='manipulate-button-container'>
						<a class='' href='p_update.php?id=" .$row['media_lib_ID']."'><button class='home-manipulate-button' type='button'>Edit</button></a>
						<a class='' href='delete.php?id=" .$row['media_lib_ID']."&userrole=".$userRow['userrole']."'><button class='home-manipulate-button' type='button'>Delete</button></a>
						<a class='' href='p_show_media.php?id=" .$row['media_lib_ID']."'><button class='home-manipulate-button' type='button'>Details</button></a>
					</td>
					</tr>";
					$count++;
				}
			} else  {
				echo  "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
			}
			?>
		</tbody>
	</table>
<?php } ?> <!-- this is the end of our ADMIN PAGE -->

</div>


<!-- ********************** JavaScript starts here **********************-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

<?php $connect->close(); ?>