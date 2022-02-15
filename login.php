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
		<form method="POST" action="" class="mt-5 p-4 green text-white">
			<h2 class="mb-5">Login:</h2>
			<div class="form-group row">
				<label for="staticEmail" class="col-sm-2 col-form-label">Email:</label>
				<div class="col-sm-10">
					<input name="email" type="text" class="form-control" id="inputPassword" placeholder="...">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">Wachtwoord:</label>
				<div class="col-sm-10">
					<input name="wachtwoord" type="password" class="form-control" id="inputPassword" placeholder="...">
					<input name="login" type="submit" value="Login" class="btn mt-4 light-green float-right">
				</div>
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
	if(isset($_POST["login"]) ) {
		$email = $_POST["email"];
		$password = $_POST["wachtwoord"];
		if(empty($_POST["email"]) || empty($_POST["wachtwoord"])) {
			echo "<script>alert('Geen wachtwoord of email ingevuld.')</script>";
		} else {
			$query = "SELECT * FROM gebruikers WHERE email = :email AND wachtwoord = :wachtwoord";
			$statement = $database->prepare($query);
			$statement->execute(array('email' => $_POST["email"],'wachtwoord' 
			=> $_POST["wachtwoord"]));
			$count = $statement->rowCount();
			if($count > 0) {
				foreach($statement as $value) {			
					session_start();
					$_SESSION["email"] = $_POST["email"];
					$_SESSION["naam"] = $value['naam'];
					$_SESSION['id'] = $value['id'];
					if($value['soort'] == "admin") {
						header('Location: homepage-admin.php');
					}
					if($value['soort'] == "consultant") {
						header('Location: homepage-consultant.php');
					}
				}
			} else {
				echo "<script>alert('Gerbuikersnaam of wachtwoord is onjuist')</script>";
			}
		}
		
	}
?>
				
				
				
				
				
				
				
				
				
				
				
				