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
					<a class="nav-link" href="consultants.php">Consultants</a>
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
			<h2 class="text-white">Kosten CRUD</h2>
			<p class="text-white">Hier kunt u kosten aanmaken, bekijken, bijwerken en verwijderen.</p>
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
		$query = "SELECT kostencode, omschrijving FROM kostenomschrijving";
		$kosten = $database->prepare($query);
		try {
			$kosten->execute(array());
			$kosten->setFetchMode(PDO::FETCH_ASSOC);
			echo "<div class='container green mb-4 py-4'>";
			echo "<table class='table table-striped border table-light '>
					<thead>
						<tr>
							<th scope='col'>Kostencode</th>
							<th scope='col'>Projectnaam</th>
						</tr>
					</thead>";				
				foreach($kosten as $value) {
					echo 
						"<tr>
							<td>"; 
								print_r($value['kostencode']);
					echo  "</td>"; 
					echo "<td>"; 
								print_r($value['omschrijving']);
					echo  "</td>"; 
						"</tr>";	
				} 	
			echo "</table>";
			echo '<a href="kosten.php" class="btn mt-5 btn-light" role="button">Sluit</a>';
		}
		catch(PDOException $e) {
			echo "<script>alert('Er is iets mis gegaan.');</script>";
		}		
	}
	if(isset($_POST["create"]) ) {
		echo '<div class="container green">
				<form method="POST" action="" class="mb-5 p-4 text-white">
					<h4>Kosten aanmaken:</h4>
					<p>Voeg nieuwe kosten toe met een kostencode:</p>
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Kies een nieuwe kostencode:</label>
						<div class="col-sm-12">
							<input name="kostencode" type="text" class="form-control" placeholder="..." required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Kies een nieuwe kostenomschrijving:</label>
						<div class="col-sm-12">
							<input name="omschrijving" type="text" class="form-control" placeholder="..." required>
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
		$omschrijving = $_POST["omschrijving"];
		$kostencode = $_POST["kostencode"];
		$query = "INSERT INTO kostenomschrijving (kostencode, omschrijving) values (?,?)";
		$insert = $database->prepare($query);
		$data = array("$kostencode", "$omschrijving");
		try {
			$insert->execute($data);		
			echo '<div id="alert" class="container mt-5"><div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<p>U heeft succesvol nieuwe kosten toegevoegd.</p></div></div>';
			echo '<div class="container mt-1"><div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<p>De kostencode die u heeft toegevoegd: '; echo $kostencode; echo ".";
			echo '</div></div>';
			echo '<div class="container mt-1"><div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<p>De kostenomschrijving die u heeft toegevoegd: '; echo $omschrijving; echo ".";
			echo '</div></div>';
		}
		catch(PDOException $e) {
			echo "<script>alert('Er is iets mis gegaan.');</script>";
		}	
	}
	if(isset($_POST["update"]) ) {
		echo '<div class="container green">
			<form method="POST" action="" class="p-4">
				<h4 class="text-white">Kosten aanpassen</h4>
				<p class="text-white">Kies een kostenomschrijving om aan te passen.</p>
				<div class="form-group row">
					<div class="col-sm-12">
						<p class="text-white">kosten:</p><select class="form-control col-sm-12" name="kosten" required>';
							echo '<option></option>';
								$query = "SELECT omschrijving FROM kostenomschrijving";
								$omschrijvingen = $database->prepare($query);
								try {
									$omschrijvingen->execute(array());
									$omschrijvingen->setFetchMode(PDO::FETCH_ASSOC);
									$options = array();
									foreach($omschrijvingen as $value) {
										$omschrijving = $value["omschrijving"];
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
		$kosten = $_POST["kosten"];
		$_SESSION["kosten"] = $kosten;
		echo '<div class="container green">
				<form method="POST" action="" class="mb-5 p-4 text-white">
					<h4>Kosten toevoegen:</h4>
					<p>Voeg een nieuwe kostencode en kostenomschrijving toe:</p>
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Kies een nieuwe kostencode:</label>
						<div class="col-sm-12">
							<input name="kostencode" type="text" class="form-control" placeholder="..." required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-12 col-form-label">Kies een nieuwe kostenomschrijving:</label>
						<div class="col-sm-12">
							<input name="omschrijving" type="text" class="form-control" placeholder="..." required>
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
		$kosten = $_SESSION["kosten"];
		$kostencode = $_POST["kostencode"];
		$omschrijving = $_POST["omschrijving"];
		$query = "UPDATE kostenomschrijving SET kostencode='$kostencode', omschrijving='$omschrijving' WHERE omschrijving='$kosten'";
		$insert = $database->prepare($query);
		$data = array();
		try {
			$insert->execute($data);		
			echo '<div id="alert" class="container mt-5"><div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<p>U heeft succesvol de kostenomschrijving '; echo "$kosten"; echo ' aangepast.</p></div></div>';
			echo '<div class="container mt-1"><div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<p>De nieuwe kostencode: '; echo $kostencode; echo ".";
			echo '</div></div>';
			echo '<div class="container mt-1"><div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<p>De nieuwe kostenomschrijving: '; echo $omschrijving; echo ".";
			echo '</div></div>';
					$_SESSION = array();
		}
		catch(PDOException $e) {
			echo "<script>alert('Er is iets mis gegaan.');</script>";
		}	
	}
	if(isset($_POST["delete"]) ) {
		echo '<div class="container green">
			<form method="POST" action="" class="p-4">
				<h4 class="text-white">Kosten verwijderen</h4>
				<p class="text-white">Kies een kostenomschrijving om te verwijderen.</p>
				<div class="form-group row">
					<div class="col-sm-12">
						<p class="text-white">Kosten:</p><select class="form-control col-sm-12" name="omschrijving" required>';
							echo '<option></option>';
								$query = "SELECT omschrijving FROM kostenomschrijving";
								$consultants = $database->prepare($query);
								try {
									$consultants->execute(array());
									$consultants->setFetchMode(PDO::FETCH_ASSOC);
									$options = array();
									foreach($consultants as $value) {
										$consultant = $value["omschrijving"];
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
		$omschrijving = $_POST["omschrijving"];
		$query = "DELETE FROM kostenomschrijving WHERE omschrijving = '$omschrijving'";
		$insert = $database->prepare($query);
		$data = array();
		try {
			$insert->execute($data);		
			echo '<div id="alert" class="container mt-5"><div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<p>U heeft succesvol het project verwijderd.</p></div></div>';
			echo '<div class="container mt-1"><div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<p>Het verwijderde project: '; echo $omschrijving; echo ".";
			echo '</div></div>';
		}
		catch(PDOException $e) {
			echo "<script>alert('Er is iets mis gegaan.');</script>";
		}			
	}
?>
				
				
				
				
				
				
				
				
				
				
				
				