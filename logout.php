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
						<a class="nav-link" href="javascript:history.back(1)">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="kostendeclaratieformulier.php">kostendeclaratieformulier</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="rapport1.php">Rapport 1</a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<div class="container green mt-5 p-4 text-white text-center">
		<form method="POST" action="">
			<h2 class="text-white">Weet u zeker dat u uit wilt loggen?</h2>
			<div class="form-group row">
				<div class="col-sm-12">
					<input name="submit" type="submit" value="Uitloggen" class="btn mt-5 btn-success">
					<a href="logout.php.php" class="btn mt-5 btn-light" role="button">Annuleren</a>								
				</div>
			</div>
		</form>
	</div>
</body>	
<?php 
	$dbhost = 'localhost';
	$dbname = 'project_sync';
	$user = '';
	$pass = "";
	try {
		$database = new PDO("mysql:host=$dbhost;dbname=$dbname", $user,$pass);
		$database->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
		echo $e->getMessage();
		echo "Verbinding NIET gemaakt.";
	}			
	if(isset($_POST["submit"]) ) {
		header('Location: homepage.php');
		$_SESSION = array();
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
		session_destroy();
	}
?>		
				
				
				
				
				
				
				
				
				