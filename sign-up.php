
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
				<a class="nav-link" href="homepage.php">Home</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="login.php">Login</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="sign-up.php">Aanmelden</a>
			  </li>
			</ul>
		  </div>
		</nav>
	</header>
	<div class="container">
		<form method="POST" name="formulier" class="mt-5 p-4 green text-white">
			<h2 class="p-4">Aanmelden:</h2>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Naam:</label>
				<div class="col-sm-10">
					<input name="naam" type="text" class="form-control" placeholder="..." required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Email:</label>
				<div class="col-sm-10">
					<input name="email" type="email" class="form-control" placeholder="..." required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Wachtwoord:</label>
				<div class="col-sm-10">
					<input name="wachtwoord" type="password" class="form-control" placeholder="..." required>
					<input name="submit" type="submit" value="Aanmelden" class="btn mt-4 light-green float-right">
				</div>
			</div>
			<div class="form-group row">
				<a href="login.php" class="col-sm-12 text-white">Heb je al een account?</a>
			</div>
		</form>
	</div>
</body>
</html>
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
	}			
	if(isset($_POST["submit"]) ) {
		$query = "INSERT INTO gebruikers (naam,email,wachtwoord,soort) values (?,?,?,?)";
		$insert = $database->prepare($query);
		$data = array("$_POST[naam]", "$_POST[email]", "$_POST[wachtwoord]", "consultant");
		try {
			$insert->execute($data);
			echo "<script>alert('uw heeft zich aangemeld');</script>";
			header('Location: login.php');
		}
		catch(PDOException $e) {
			echo "<script>alert('Er is iets mis gegaan.');</script>";
		}	
	}
?>
				
				
				
				
				
				
				
				
				
				
				
				