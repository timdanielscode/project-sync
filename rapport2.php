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
		echo "Verbinding NIET gemaakt.";
	}			
	echo '<div class="container green">
		<form method="POST" class="mt-5 p-4">
			<h2 class=" text-white">Rapport 2</h2>
			<p class="text-white">U kunt hier een kostenoverzicht bekijken van de kosten per project.</p>
			<div class="form-group row">
				<div class="col-sm-12">
					<p class="text-white">Project:</p><select class="form-control col-sm-12" name="project" required>';
						echo '<option></option>';
							$query = "SELECT DISTINCT project FROM projectomschrijving";
							$consultants = $database->prepare($query);
							try {
								$consultants->execute(array());
								$consultants->setFetchMode(PDO::FETCH_ASSOC);
								$options = array();
								foreach($consultants as $value) {
									$consultant = $value["project"];
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
						echo '<input name="submit" type="submit" value="Kies" class="btn mt-5 btn-success">
					<a href="rapport1.php" class="btn mt-5 btn-light" role="button">Annuleren</a>					
				</div>
			</div>
		</form>
	</div>';
	
	if(isset($_POST["submit"]) ) {
		session_start();
		$project = $_POST["project"];
		$naam = $_SESSION["naam"];
		$query = "SELECT projectkosten.consultant,projectkosten.project,kostenomschrijving.kostencode,projectkosten.omschrijving,projectkosten.datum,projectkosten.kosten FROM projectkosten INNER JOIN kostenomschrijving ON projectkosten.omschrijving = kostenomschrijving.omschrijving WHERE projectkosten.project = '$project' ORDER BY projectkosten.consultant, projectkosten.project, projectkosten.kostencode";
		$query2 = "SELECT SUM(kosten) FROM projectkosten WHERE project = '$project'";
		$projecten = $database->prepare($query);
		$bedragTotaal = $database->prepare($query2);
		try {
			$projecten->execute(array());
			$bedragTotaal->execute(array());
			$projecten->setFetchMode(PDO::FETCH_ASSOC);
			$bedragTotaal->setFetchMode(PDO::FETCH_ASSOC);
			echo "<div class='container green mb-4 py-4'>";
			echo "<table class='table table-striped border table-light '>
					<thead>
						<tr>
							<th scope='col'>Consultant</th>
							<th scope='col'>Projectnaam</th>
							<th scope='col'>Kostencode</th>
							<th scope='col'>Omschijving</th>
							<th scope='col'>Datum</th>
							<th scope='col'>Bedrag</th>
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
							print_r($value["kostencode"]); 
					echo "</td>";  
					echo "<td>"; 
							print_r($value["omschrijving"]); 
								
					echo "</td>"; 
					echo "<td>"; 
							print_r($value["datum"]); 
					echo "</td>";
					echo "<td>"; 	
							print_r($value["kosten"]); echo ",-";
					echo "</td>"; 
						"</tr>";	
				} 	
				foreach($bedragTotaal as $value) {
					$totaal = $value['SUM(kosten)'];
					echo "<tr></td><td></td><td></td><td><td><b>TOTAAL</b></td><td></td><td><b>$totaal,-</b></td></tr></table></div>";
				}	
		}
		catch(PDOException $e) {
			echo "<script>alert('Er is iets mis gegaan.');</script>";
		}		

	}
?>
				
				
				
				
				
				
				
				
				
				
				
				