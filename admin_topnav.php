<?php 
	if(!isset($_SESSION['user'])) {
		header("Location: index.php");
		exit;
	}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top py-0">
<!-- 	<abbr title="Take me home, please =^.^="> -->
	<a class="navbar-brand" href="dashboard_ex.php">
		<img class="img-fluid d-block" width="100" src="img/logoCodingCat1.png" alt="">
	</a>
	<span class="nav-text-color nav-text-font mr-auto">Collecting impressions...</span>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse ml-5" id="navbarSupportedContent">
		<ul class="navbar-nav ml-auto">
			<li class="nav-item active">
				<a class="nav-link nav-text-color" href="#">LINK1<span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link nav-text-color" href="#">LINK2</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle nav-text-color" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">DROPDOWN</a>
				<div class="dropdown-menu thumbnail-color" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="#">TBA</a>
					<a class="dropdown-item" href="#">TBA</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#">TBA</a>
			</div>
			</li>
		</ul>
<!--        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" id="search-field" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0" id="search-button" type="submit">Search</button>
        </form> -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a href="logout.php?logout" class="nav-link nav-text-color">Logout<i class="fa fa-sign-out sidebar-link fa-fw"></i></a>
			</li>
		</ul>
	</div>
</nav>
