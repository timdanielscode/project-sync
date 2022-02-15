<!-- 97044742 -->
<!-- Tim Daniëls -->
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">	
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<header class="bg-info">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand"><h1>Sync</h1></a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="homepage-admin.php">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="rapport1-admin.php">Rapport 1</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="rapport2.php">Rapport 2</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="projecten.php">Projecten</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="kosten.php">Kosten</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="consultants.php">Consultants</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Log uit</a>
				</li>
			</ul>
		  </div>
		</nav>
	</header>
	<div class="container green text-white p-4 rounded mt-5">	
		<div class="row">
			<div class="col-12">	
				<?php session_start(); $naam = $_SESSION["naam"]; echo "<h4>U bent ingelogd als: <span class='text-capitalize'>$naam</span></h4>"; ?>
				<p>Als admin kunt rapport 1 bekijken. Hierin staan kosten van consultants per project. U kunt ook rapport 2 bekijken. Hierin staan kosten per project per consultant. Er is ook een mogelijkheid om CRUD toe te passen op de tabellen: projecten, kosten en consultants.</p>
			</div>
		</div>
	</div>
</body>
</html>

				
				
				
				
				
				
				
				
				
				
				
				