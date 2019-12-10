<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>administration</title>

	<link rel="stylesheet" type="text/css" href="administrationStyle.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="body">
	<div class="container">
		<img src="1.png" height="90" width="250">

		<form method="post" class="md-form" action = "administration.php">


			<input type="submit" name="chargerFichierInput" value="Charger le fichier input" class="input inputLeft">
			<input type="submit" name="telechargerFichierOutput" value="Telecharger le fichier Output" class="input inputRight">

			<?php

			// cas du click sur chargerFichierInput
				if(isset($_POST['chargerFichierInput'])) {


					$mysqli = new mysqli("localhost", "root", "", "radeeta");

					// Check connection
					if($mysqli === false){
					    die("ERROR: Could not connect. " . mysqli_connect_error());
					}
				 
					// Print host information
					echo "Connect Successfully. Host info: " . mysqli_get_host_info($mysqli);


						
					//ouvrir le fichier
					$file= fopen("SEC001.txt", "r");


					$ligne=fgets($file);

					while($ligne) {
						$categorieAbonnement= substr($ligne, 0, 3);
						$secteur= substr($ligne, 3, 3);
						$tourne= substr($ligne, 6, 3);
						$ordre= substr($ligne, 9, 3);
						$numeroCompteur= substr($ligne, 12, 11);
						$numeroContrat= substr($ligne, 23, 7);
						$ancienIndex= (int)substr($ligne, 30, 8);
						$nombreRoues= substr($ligne, 58, 2);
						$anneeReleve= substr($ligne, 64, 4);
						$moisReleve= substr($ligne, 68, 2);


							
						$sqlIdentifyGeography= "REPLACE INTO identifgeography (secteur, tourne, ordre) VALUES ('" .$secteur."','" .$tourne. "','" .$ordre. "')";
						$sqlCompteur= "REPLACE INTO compteur (NumeroCompteur ,NombreRoues) VALUES ('" .$numeroCompteur. "','" .$nombreRoues. "')";
						$sqlContrat= "REPLACE INTO contrat (NumeroContrat) VALUES ('" .$numeroContrat. "')";
						$sqlPeriode= "REPLACE INTO periode (MoisReleve ,AnneeReleve) VALUES ('" .$moisReleve. "','" .$anneeReleve. "')";

						if(mysqli_query($mysqli, $sqlIdentifyGeography)){
							echo "Records inserted successfully.";
						} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
						}
						
						if(mysqli_query($mysqli, $sqlCompteur)){
							echo "Records inserted successfully.";
						} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
						}		
						
						if(mysqli_query($mysqli, $sqlContrat)){
							echo "Records inserted successfully.";
						} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
						}

						if(mysqli_query($mysqli, $sqlPeriode)){
							echo "Records inserted successfully.";
						} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
						}
						
						
						//passer a la ligne suivante
						$ligne=fgets($file);


					}

					fclose($file);
					mysqli_close($mysqli);






					$mysqli = new mysqli("localhost", "root", "", "radeeta");

					// Check connection
					if($mysqli === false){
					    die("ERROR: Could not connect. " . mysqli_connect_error());
					}
				 
					// Print host information
					echo "Connect Successfully. Host info: " . mysqli_get_host_info($mysqli)."<br>";

					mysqli_set_charset($mysqli,"utf8");


						
					//ouvrir le fichier
					$annotation= fopen("An01.txt", "r");
					$anomalie= fopen("An02.txt", "r");

					//lire du fichier An02
					$__anomalie=(string)fgets($anomalie);
					$_anomalie=substr($__anomalie, 0, strpos($__anomalie,"\r"));

					while ($_anomalie) {
						$__annotation=(string)fgets($annotation);
						
						$_annotation=substr($__annotation, 0, strpos($__annotation,"\r"));
						while ($_annotation) {
							if((substr($_annotation, 0, 2) == substr($_anomalie, 0, 2))) {

								$sql = "REPLACE INTO anomalie_annotation (anomalie ,annotation) VALUES (\"" .$_anomalie. "\",\"" .$_annotation. "\")";

								if(mysqli_query($mysqli, $sql)){
									echo "Records inserted successfully.";
								} else{
									echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
								}	
								
								break;
							}

							$__annotation=(string)fgets($annotation);
							$_annotation=substr($__annotation, 0, strpos($__annotation,"\r"));

						}

						//il faut rendre le curseur au debut du fichier annotation
						fseek($annotation, 0); // rewind($annotation);
						
						


					    $__anomalie=fgets($anomalie);
					    $_anomalie=substr($__anomalie, 0, strpos($__anomalie,"\r"));
					}


					fclose($annotation);
					fclose($anomalie);

					mysqli_close($mysqli);






					$mysqli = new mysqli("localhost", "root", "", "radeeta");

					// Check connection
					if($mysqli === false){
					    die("ERROR: Could not connect. " . mysqli_connect_error());
					}
				 
					// Print host information
					echo "Connect Successfully. Host info: " . mysqli_get_host_info($mysqli)."<br>";

					mysqli_set_charset($mysqli,"utf8");


					$file = fopen("SEC001.txt", "r");


					$ligne=fgets($file);

					while($ligne) {
						$categorieAbonnement= substr($ligne, 0, 3);
						$secteur= substr($ligne, 3, 3);
						$tourne= substr($ligne, 6, 3);
						$ordre= substr($ligne, 9, 3);
						$numeroCompteur= substr($ligne, 12, 11);
						$numeroContrat= substr($ligne, 23, 7);
						$ancienIndex= (int)substr($ligne, 30, 8);
						$anneeReleve= substr($ligne, 64, 4);
						$moisReleve= substr($ligne, 68, 2);
						$chiffres14= substr($ligne, 70, 14);
						$nombreRoues= substr($ligne, 58, 2);


						$sqlreleve = "REPLACE INTO releve (categorieAbonnement, secteur , tourne, ordre, numeroCompteur, numeroContrat, ancienIndex, chiffres14, anneeReleve, moisReleve , NombreRoues) VALUES ('".$categorieAbonnement."','".$secteur."','".$tourne."','".$ordre."','".$numeroCompteur."','".$numeroContrat."','".$ancienIndex."','".$chiffres14."','".$anneeReleve."','".$moisReleve."','".$nombreRoues."')";



						if(mysqli_query($mysqli, $sqlreleve)){
							echo "Records inserted successfully.";
						} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
						}


						$ligne=fgets($file);

					}
					mysqli_close($mysqli);
	
				}

				// convertir les donnees en fichier output
				if(isset($_POST['telechargerFichierOutput'])) {
					$mysqli = new mysqli("localhost", "root", "", "radeeta");

					// Check connection
					if($mysqli === false){
					    die("ERROR: Could not connect. " . mysqli_connect_error());
					}
				 
					// Print host information
					echo "Connect Successfully. Host info: " . mysqli_get_host_info($mysqli);

					//supprimer le fichier "SEC001_1.txt"
					unlink("SEC001_1.txt");

					//ouvrir le fichier
					$file= fopen("SEC001_1.txt", "w");

					$sqlReleveOutput = "Select * from releve";

					//parcourir la table releve
					$form = "%3s%3s%3s%3s%11s%7s%8.d%8.d%6s%6s%2s%2s%2s%4s%2s%14s\n";

					if ($result = mysqli_query($mysqli, $sqlReleveOutput)) {	
						while($row = mysqli_fetch_array($result)){

							$ligne = sprintf($form , $row['CategorieAbonnement'] , $row['secteur'] , $row['tourne'] , $row['ordre'] , $row['NumeroCompteur'] , $row['NumeroContrat'] , (int)$row['AncienIndex'] , (int)$row['NouveauIndex'] , $row['HeureReleve'] , $row['DateReleve'] , $row['NombreRoues'] , $row['Annotation'] , $row['Anomalie'] , $row['AnneeReleve'] , $row['MoisReleve'] , $row['chiffres14']);

							fwrite($file, $ligne);
						}
					}

					fclose($file);

					mysqli_close($mysqli);
				}

			?>
		</form>		
	</div>

</body>
</html>