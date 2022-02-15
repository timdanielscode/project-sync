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
						<a class="nav-link" href="homepage-consultant.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="rapport1.php">Rapport 1</a>
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
			<h2 class="text-white">Projectkosten declareren</h2>
			<p class="text-white">Hier kunt u uw kosten doorvoeren en declareren. Bekijk ook uw eigen kosten. Zie ook de kosten per project.</p>
			<div class="form-group row">
				<div class="col-sm-12">
					<input name="invoer" type="submit" value="Invoeren" class="btn mt-5 light-green text-white">
					<input name="eigen-kosten" type="submit" value="Eigen kosten" class="btn mt-5 light-green text-white">
					<input name="overzicht-per-project" type="submit" value="Overzicht per project" class="btn mt-5 light-green text-white">									
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
	if(isset($_POST["invoer"]) ) {
		echo '<div class="container green">
				<form method="POST" action="" class="mb-5 p-4 text-white">
					<h4>Projectkosten invoeren:</h4>
					<p>Een aantal regels waarin wordt vastgesteld of er kosten kunnen worden gedeclareerd:</p>
					<ul class="list-group text-dark">
						<li class="list-group-item">OV-reiskosten worden 100% vergoed.</li>
						<li class="list-group-item">Reiskosten eigen auto worden over de 10 kilometers vergoed a 50 eurocent per kilometer.</li>
						<li class="list-group-item">Reiskosten onder de 10 kilometer mag je niet declareren.</li>
						<li class="list-group-item">Reiskosten boven de 100 kilometer mag je niet declareren. Hiervoor Heb je speciale toestemming nodig.</li>
						<li class="list-group-item">Boeken worden t/m 100 euro vergoed.</li>
						<li class="list-group-item">Laptops worden t/m 1000 euro vergoed.</li>
					</ul>
					<div class="form-group">
						<label class="col-form-label">Projectnaam:</label>';
						echo '<select class="form-control col-sm-12" name="projectnaam" required>';
						echo '<option></option>';
							$query = "SELECT project FROM projectomschrijving";
							$projecten = $database->prepare($query);
							try {
								$projecten->execute(array());
								$projecten->setFetchMode(PDO::FETCH_ASSOC);
								$options = array();
								foreach($projecten as $value){
									$project = $value["project"];
									array_push($options, $project);
								}
							}
							catch(PDOException $e) {
								echo "<script>alert('Er is iets mis gegaan.');</script>";
							}
							foreach($options as $option){
								echo '<option>';
									print_r($option);
								echo '</option>';	
							}
						echo '</select>';
					echo '</div>
					<div class="form-group">
						<label class="col-form-label">Omschrijving:</label>';
						echo '<select class="form-control col-sm-12" name="omschrijving" required>';
						echo '<option></option>';
							$query = "SELECT omschrijving FROM kostenomschrijving";
							$projectkosten = $database->prepare($query);
							try {
								$projectkosten->execute(array());
								$projectkosten->setFetchMode(PDO::FETCH_ASSOC);
								$options = array();
								foreach($projectkosten as $value){
									$arrayProjectkosten = $value["omschrijving"];
									array_push($options, $arrayProjectkosten);
								}
							}
							catch(PDOException $e) {
								echo "<script>alert('Er is iets mis gegaan.');</script>";
							}
							foreach($options as $option){
								echo '<option>';
									print_r($option);
								echo '</option>';	
							}
						echo '</select>';
					echo '</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Kosten:</label>
						<div class="col-sm-12">
							<input name="kosten" type="text" class="form-control" placeholder="..." required>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-12">
							<input name="doorvoeren" type="submit" value="Kosten doorvoeren" class="btn mt-5 btn-success text-white">
							<a href="kostendeclaratieformulier.php" class="btn mt-5 btn-light" role="button">Annuleren</a>							
						</div>
					</div>
				</form>
			</div>';
	}
	if(isset($_POST["doorvoeren"]) ) {
		session_start();
		$naam = $_SESSION["naam"];
		$projectnaam = $_POST["projectnaam"];
		$omschrijving = $_POST["omschrijving"];
		$datum = date_create("now");
		$datum = date_format($datum, "d-m-Y");
		$kosten = $_POST["kosten"];
		$declaratie = $kosten;
		$_SESSION["kosten"] = $kosten;
		$_SESSION["declaratie"] = $declaratie;
		$km = "N.v.t.";
		$query = "SELECT kostencode FROM kostenomschrijving WHERE omschrijving = '$omschrijving'";
		$kostencode = $database->prepare($query);
		try {
			$kostencode->execute(array());
			$kostencode->setFetchMode(PDO::FETCH_ASSOC);
			foreach($kostencode as $value){
				$kostencode = $value["kostencode"];
			}
		}
		catch(PDOException $e) {
			echo "<script>alert('Er is iets mis gegaan.');</script>";
		}
		if($kostencode == "200" && $kosten > 100 || $kostencode == "400" && $kosten > 1000 || $kostencode == "300" || $kostencode == "500" || $kostencode == "600") {
			$declaratie = "0.00";
		}
		$query = "INSERT INTO projectkosten (consultant,project,omschrijving,kilometers,kosten,declaratie,datum) values (?,?,?,?,?,?,?)";
		$insert = $database->prepare($query);
		$_SESSION["kostencode"] = $kostencode;
		$data = array("$naam", "$projectnaam", "$omschrijving", "$km", "$kosten", "$declaratie", "$datum");
		try {
			$insert->execute($data);		
			if($kostencode == "100" || $kostencode == "200" || $kostencode == "300" || $kostencode == "400" || $kostencode == "500" || $kostencode == "600") {
				echo '<div class="container mt-5"><div class="alert alert-success alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<p>De kosten zijn succesvol berekend.</p></div></div>';
				echo '<div class="container mt-1"><div class="alert alert-success alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<p>De kosten die u heeft verstuurd zijn: '; echo $kosten; echo ' euro.</p>';
				echo '</div></div>';
				echo '<div class="container mt-1"><div class="alert alert-success alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<p>Het bedrag dat u kunt declareren is: '; echo $declaratie; echo ' euro.</p>';
				echo '</div></div>';
			} 
		}
		catch(PDOException $e) {
			echo "<script>alert('Er is iets mis gegaan.');</script>";
		}	
	}
	if(isset($_POST["doorvoeren"]) && $omschrijving == "reiskosten-auto" || isset($_POST["doorvoeren"]) && $omschrijving == "reiskosten-overig") {
		echo '<div class="container green">
				<form method="POST" class="mb-5 p-4 text-white">
					<h4>Km doorvoeren:</h4>
					<p>Reiskosten eigen auto worden over de tien kilometers vergoed a 50 eurocent per kilometer.</p>
					<div class="form-group">
						<label class="col-form-label">Aantal km:</label>';
						echo '<input name="kilometers" type="text" class="form-control" placeholder="..." required="true"';
					echo '</div>
					<div class="form-group row">
						<div class="col-sm-12">
							<input name="doorekenen" type="submit" value="Kosten doorekenen" class="btn mt-5 btn-success text-white">
							<a href="kostendeclaratieformulier.php" class="btn mt-5 btn-light role="button">Annuleren</a>								
						</div>
					</div>
				</form>
			</div>';
	}
	if(isset($_POST["doorekenen"]) ) {
		session_start();
		$km = $_POST["kilometers"];
		$naam = $_SESSION["naam"];
		$kosten = $_SESSION["kosten"];
		$kostencode = $_SESSION["kostencode"];
		$declaratie = $kosten;
		if($km < "10" || $km > "100") {
			$declaratie = "0.00";
		}
		if($kostencode == "101" && $km > "10" && $km < "100") {
			$declaratie = $km * 0.50;
		}
		$query = "UPDATE projectkosten SET kilometers='$km', kosten='$kosten', declaratie='$declaratie' ORDER BY id DESC LIMIT 1";
		$insert = $database->prepare($query);
		$data = array();
		try {
			$insert->execute($data);
				echo '<div class="container mt-5"><div class="alert alert-success alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<p>De kosten zijn succesvol doorberekend.</p></div></div>';
				echo '<div class="container mt-1"><div class="alert alert-success alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<p>De kosten die u heeft verstuurd zijn: '; echo $kosten; echo ' euro.</p>';
				echo '</div></div>';
				echo '<div class="container mt-1"><div class="alert alert-success alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<p>Het aantal kilometers die u heeft verstuurd zijn: '; echo $km; echo ' kilometers.</p>';
				echo '</div></div>';
				echo '<div class="container mt-1"><div class="alert alert-success alert-dismissible">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<p>Het bedrag dat u kunt declareren is: '; echo $declaratie; echo ' euro.</p>';
				echo '</div></div>';
		}
		catch(PDOException $e) {
			echo "<script>alert('Er is iets mis gegaan.');</script>";
		}		
	}
	if(isset($_POST["eigen-kosten"]) ) {
		session_start();
		$naam = $_SESSION["naam"];
		$query = "SELECT consultant, project, omschrijving, kilometers, kosten, declaratie, datum FROM projectkosten WHERE consultant = '$naam' ORDER BY project";
		$query2 = "SELECT SUM(kosten),SUM(declaratie),SUM(kilometers) FROM projectkosten WHERE consultant = '$naam'";
		$query3 = "SELECT SUM(declaratie) FROM projectkosten WHERE consultant = '$naam'";
		$projecten = $database->prepare($query);
		$totaal = $database->prepare($query2);
		try {
			$projecten->execute(array());
			$totaal->execute(array());
			$projecten->setFetchMode(PDO::FETCH_ASSOC);
			$totaal->setFetchMode(PDO::FETCH_ASSOC);
			echo "<div class='container green mb-4 py-4'>
			<h4 class='pl-4 text-white'>Overzicht eigen kosten:</h4>
			<p class='mb-5 pl-4 text-white'>Dit is een tabel met een overzicht van eigen kosten. Hier is te zien wat uw kosten zijn. De declaraties staan er ook bij beschreven.</p>";
			echo "<table class='table table-striped border table-light'>
					<thead>
						<tr>
							<th scope='col'>Consultant</th>
							<th scope='col'>Project</th>
							<th scope='col'>Omschijving</th>
							<th scope='col'>km</th>
							<th scope='col'>Kosten</th>
							<th scope='col'>Te declareren</th>
							<th scope='col'>Datum</th>
						</tr>
					</thead>";				
				foreach($projecten as $value) {	
						echo 
							"<tr>
								<td>"; 
									print_r($value['consultant']); 
						echo  "</td>"; 
						echo "<td>";
									print_r($value['project']); 

						echo  "</td>"; 
						echo "<td>";
									print_r($value["omschrijving"]); 
						echo "</td>";  
						echo "<td>"; 
									print_r($value["kilometers"]); 
						echo "</td>"; 
						echo "<td>"; 
									print_r($value["kosten"]);
									echo ",-";								
						echo "</td>";
						echo "<td>"; 
									print_r($value["declaratie"]);	
									echo ",-";
						echo "</td>"; 
						echo "<td>"; 
									print_r($value["datum"]);											
						echo "</td>"; 
							"</tr>";	

					} 
					
				foreach($totaal as $value) {
					$totaalKosten = $value['SUM(kosten)'];
					$totaalDeclaratie = $value['SUM(declaratie)'];
					$totaalKilometers = $value['SUM(kilometers)'];
					echo "<tr><td></td><td></td><td><b>TOTAAL</b></td><td><b>$totaalKilometers KM</b></td><td><b>$totaalKosten,-</b></td><td><b>$totaalDeclaratie,-</b></td><td></td></tr>
					</table>
					<a href='kostendeclaratieformulier.php' class='btn mt-2 px-5 btn-light align-self-center'>Sluit</a>
					</div>";
				}	
				
		}
		catch(PDOException $e) {
			echo "<script>alert('Er is iets mis gegaan.');</script>";
		}		
	}
	if(isset($_POST["overzicht-per-project"]) ) { 
		echo '<div class="container green">
				<form method="POST" action="" class="mb-5 p-4 text-white">
					<h4>Overzicht per project:</h4>
					<p>Om een overzicht te zien van alle kosten moet u een project kiezen waarvan u de kosten wilt bekijken.</p>
					<div class="form-group">
						<label class="col-form-label">Kies een project:</label>';
						echo '<select class="form-control col-sm-12" name="project" required>';
						echo '<option></option>';
							$query = "SELECT DISTINCT project FROM projectkosten";
							$project = $database->prepare($query);
							try {
								$project->execute(array());
								$project->setFetchMode(PDO::FETCH_ASSOC);
								$options = array();
								foreach($project as $value){
									$arrayProjectNaam = $value["project"];
									array_push($options, $arrayProjectNaam);
								}
							}
							catch(PDOException $e) {
								echo "<script>alert('Er is iets mis gegaan.');</script>";
							}
							foreach($options as $option){
								echo '<option>';
									print_r($option);
								echo '</option>';	
							}
						echo '</select>';
					echo '</div>
					<div class="form-group row">
						<div class="col-sm-12">
							<input name="doorgaan" type="submit" value="Doorgaan" class="btn mt-5 btn-success text-white">
							<a href="kostendeclaratieformulier.php" class="btn mt-5 btn-light role="button">Annuleren</a>								
						</div>
					</div>
				</form>
			</div>';
	}
	if(isset($_POST["doorgaan"]) ) {
		$project = $_POST["project"];
		$query = "SELECT DISTINCT consultant FROM projectkosten WHERE project = '$project'";
		$projecten = $database->prepare($query);
		try {
			$projecten->execute(array());
			$projecten->setFetchMode(PDO::FETCH_ASSOC);
			echo "<div class='container green mb-4 py-4'>
			<h4 class='pl-4 text-white'>Overzicht betrokkenen $project:</h4>
			<p class='pl-4 text-white'>Hier is een overzicht te zien van consultants die betrokken zijn bij het project $project.</p>";
			echo "<table class='table table-striped border table-light '>
				<thead>
					<tr>
						<th scope='col'>Consultant</th>
					</tr>
				</thead>";	
				foreach($projecten as $value) {
					echo "<tr>
							<td>"; 
								print_r($value['consultant']); 
					echo  "</td>"; 
						"</tr>";	
				} 		
		}
		catch(PDOException $e) {
			echo "<script>alert('Er is iets mis gegaan.');</script>";
		}	
	}
?>
				
				
				
				
				
				
				
				
				
				
				
				