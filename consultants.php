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
					<a class="nav-link" href="rapport1-admin.php">Rapport 2</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="projecten.php">Projecten</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="kosten.php">Kosten</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Log uit</a>
				</li>
			</ul>
		  </div>
		</nav>
	</header>
	<div class="container green">
		<form method="POST" action="" class="mt-5 p-4">
			<h2 class="text-white">Consultants CRUD</h2>
			<p class="text-white">Hier kunt u consultans aanmaken, bekijken, bijwerken en verwijderen.</p>
			<div class="form-group row">
				<div class="col-sm-12">
					<input name="create" type="submit" value="Create" class="btn mt-5 light-green text-white">
					<input name="read" type="submit" value="Read" class="btn mt-5 light-green text-white">
					<input name="update" type="submit" value="Update" class="btn mt-5 light-green text-white">
					<input name="delete" type="submit" value="Delete" class="btn mt-5 light-green text-white">						
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
	session_start();
	try {
		$database = new PDO("mysql:host=$dbhost;dbname=$dbname", $user,$pass);
		$database->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
		echo $e->getMessage();
		echo "Verbinding NIET gemaakt.";
	}					
	if(isset($_POST["read"]) ) {
		$query = "SELECT DISTINCT naam FROM gebruikers WHERE id != 1";
		$kosten = $database->prepare($query);
		try {
			$kosten->execute(array());
			$kosten->setFetchMode(PDO::FETCH_ASSOC);
			echo "<div class='container green mb-4 py-4'>";
			echo "<table class='table table-striped border table-light '>
					<thead>
						<tr>
							<th scope='col'>Consultants</th>
						</tr>
					</thead>";				
				foreach($kosten as $value) {
					echo 
						"<tr>
							<td>"; 
								print_r($value['naam']);
					echo  "</td>"; 
						"</tr>";	
				} 	
			echo "</table>";
			echo '<a href="consultans.php" class="btn mt-5 btn-light" role="button">Sluit</a>';
		}
		catch(PDOException $e) {
			echo "<script>alert('Er is iets mis gegaan.');</script>";
		}		
	}
	if(isset($_POST["create"]) ) {
		echo '<div class="container green">
				<form method="POST" action="" class="mb-5 p-4 text-white">
					<h4>Consultants toevoegen:</h4>
					<p>Voeg nieuwe consultants toe:</p>
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Kies een nieuwe gebruikersnaam:</label>
						<div class="col-sm-12">
							<input name="consultant" type="text" class="form-control" placeholder="..." required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Kies een nieuwe email:</label>
						<div class="col-sm-12">
							<input name="email" type="text" class="form-control" placeholder="..." required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Kies een nieuw wachtwoord:</label>
						<div class="col-sm-12">
							<input name="wachtwoord" type="text" class="form-control" placeholder="..." required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-12">
							<input name="create2" type="submit" value="Aanmaken" class="btn mt-5 btn-success text-white">
							<a href="projecten.php" class="btn mt-5 btn-light" role="button">Annuleren</a>							
						</div>
					</div>
				</form>
			</div>';		
	}
	if(isset($_POST["create2"]) ) {
		$consultant = $_POST["consultant"];
		$email = $_POST["email"];
		$wachtwoord = $_POST["wachtwoord"];
		$query = "INSERT INTO gebruikers (naam, email ,wachtwoord, soort) values (?,?,?,?)";
		$insert = $database->prepare($query);
		$data = array("$consultant", "$email", "$wachtwoord", "consultant");
		try {
			$insert->execute($data);		
			echo '<div id="alert" class="container mt-5"><div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<p>Het account is succesvol aangemaakt.</p></div></div>';
			echo '<div class="container mt-1"><div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<p>De gebruikersnaam: '; echo $consultant; echo ".";
			echo '</div></div>';
			echo '<div class="container mt-1"><div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<p>het emailadres: '; echo $email; echo ".";
			echo '</div></div>';
			echo '<div class="container mt-1"><div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<p>Met als wachtwoord: '; echo $wachtwoord; echo ".";
			echo '</div></div>';
		}
		catch(PDOException $e) {
			echo "<script>alert('Er is iets mis gegaan.');</script>";
		}	
	}
	if(isset($_POST["update"]) ) {
		echo '<div class="container green">
			<form method="POST" action="" class="p-4">
				<h4 class="text-white">Consultants aanpassen</h4>
				<p class="text-white">Kies een consultant om aan te passen.</p>
				<div class="form-group row">
					<div class="col-sm-12">
						<p class="text-white">Consultants:</p><select class="form-control col-sm-12" name="consultant" required>';
							echo '<option></option>';
								$query = "SELECT DISTINCT naam FROM gebruikers";
								$omschrijvingen = $database->prepare($query);
								try {
									$omschrijvingen->execute(array());
									$omschrijvingen->setFetchMode(PDO::FETCH_ASSOC);
									$options = array();
									foreach($omschrijvingen as $value) {
										$omschrijving = $value["naam"];
										array_push($options, $omschrijving);
									}
								}
								catch(PDOException $e) {
									echo "<script>alert('Er is iets mis gegaan.');</script>";
								}
								foreach($options as $option) {
									echo '<option>';
										print_r($option);
									echo '</option>';	
								}
							echo '</select>';
					echo '<input name="update2" type="submit" value="Kies" class="btn mt-5 btn-success">
						<a href="kosten.php" class="btn mt-5 btn-light" role="button">Annuleren</a>	
					</div>
				</div>
			</form>
		</div>';
	}
	if(isset($_POST["update2"]) ) {
		$consultantAanpassen = $_POST["consultant"];
		$_SESSION["consultant-aanpassen"] = $consultantAanpassen;
		echo '<div class="container green">
				<form method="POST" action="" class="mb-5 p-4 text-white">
					<h4>Consultants aanpassen:</h4>
					<p>Kies een nieuwe consultant met een mail en wachtwoord:</p>
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Kies een nieuwe consultant:</label>
						<div class="col-sm-12">
							<input name="consultant" type="text" class="form-control" placeholder="..." required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Kies een nieuwe email:</label>
						<div class="col-sm-12">
							<input name="email" type="text" class="form-control" placeholder="..." required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Kies een nieuw wachtwoord:</label>
						<div class="col-sm-12">
							<input name="wachtwoord" type="text" class="form-control" placeholder="..." required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-12">
							<input name="update3" type="submit" value="Aanpassen" class="btn mt-5 btn-success text-white">
							<a href="projecten.php" class="btn mt-5 btn-light" role="button">Annuleren</a>							
						</div>
					</div>
				</form>
			</div>';	
	}
	if(isset($_POST["update3"]) ) {
		$consultantAanpassen = $_SESSION["consultant-aanpassen"];
		$consultant = $_POST["consultant"];
		$email = $_POST["email"];
		$wachtwoord = $_POST["wachtwoord"];
		$query = "UPDATE gebruikers SET naam='$consultant', email='$email', wachtwoord='$wachtwoord' WHERE naam='$consultantAanpassen'";
		$insert = $database->prepare($query);
		$data = array();
		try {
			$insert->execute($data);		
			echo '<div id="alert" class="container mt-5"><div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<p>U heeft succesvol de consultant '; echo "$consultantAanpassen"; echo ' aangepast.</p></div></div>';
			echo '<div class="container mt-1"><div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<p>De nieuwe consultant: '; echo $consultant; echo ".";
			echo '</div></div>';
			echo '<div class="container mt-1"><div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<p>De nieuwe email: '; echo $email; echo ".";
			echo '</div></div>';
			echo '<div class="container mt-1"><div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<p>Het nieuwe wachtwoord: '; echo $wachtwoord; echo ".";
			echo '</div></div>';
		}
		catch(PDOException $e) {
			echo "<script>alert('Er is iets mis gegaan.');</script>";
		}	
	}
	if(isset($_POST["delete"]) ) {
		echo '<div class="container green">
			<form method="POST" action="" class="p-4">
				<h4 class="text-white">Consultants verwijderen</h4>
				<p class="text-white">Kies een consultant om te verwijderen.</p>
				<div class="form-group row">
					<div class="col-sm-12">
						<p class="text-white">Conultants:</p><select class="form-control col-sm-12" name="consultant" required>';
							echo '<option></option>';
								$query = "SELECT DISTINCT naam FROM gebruikers";
								$consultants = $database->prepare($query);
								try {
									$consultants->execute(array());
									$consultants->setFetchMode(PDO::FETCH_ASSOC);
									$options = array();
									foreach($consultants as $value) {
										$consultant = $value["naam"];
										array_push($options, $consultant);
									}
								}
								catch(PDOException $e) {
									echo "<script>alert('Er is iets mis gegaan.');</script>";
								}
								foreach($options as $option) {
									echo '<option>';
										print_r($option);
									echo '</option>';	
								}
							echo '</select>';
					echo '<input name="delete2" type="submit" value="Kies" class="btn mt-5 btn-success">
						<a href="projecten.php" class="btn mt-5 btn-light" role="button">Annuleren</a>	
					</div>
				</div>
			</form>
		</div>';
	}
	if(isset($_POST["delete2"]) ) {
		$consultant = $_POST["consultant"];
		$query = "DELETE FROM gebruikers WHERE naam = '$consultant'";
		$insert = $database->prepare($query);
		$data = array();
		try {
			$insert->execute($data);		
			echo '<div id="alert" class="container mt-5"><div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<p>U heeft succesvol de consultant verwijderd.</p></div></div>';
			echo '<div class="container mt-1"><div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<p>De verwijderde consultant: '; echo $consultant; echo ".";
			echo '</div></div>';
		}
		catch(PDOException $e) {
			echo "<script>alert('Er is iets mis gegaan.');</script>";
		}			
	}
?>
				
				
				
				
				
				
				
				
				
				
				
				