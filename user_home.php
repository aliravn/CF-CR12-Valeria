<!--*************************************************************************
	up to here is home.php with session check, <body> and user/admin switch 
*****************************************************************************-->

<?php include "admin_topnav.php"; ?>

<div class="login-cred">
	<div class="login-name">
		Hi <span><?php echo $user_details['username']; ?></span>
	</div>
	<div class="logout">
		<a href="logout.php?logout" class="btn">Sign Out</a>
	</div>
</div>