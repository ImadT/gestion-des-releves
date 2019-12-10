<?php
/*
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
	
?>

<?php
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
?>

<?php

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


		$sqlreleve = "REPLACE INTO releve (categorieAbonnement, secteur , tourne, ordre, numeroCompteur, numeroContrat, ancienIndex, chiffres14, anneeReleve, moisReleve) VALUES ('".$categorieAbonnement."','".$secteur."','".$tourne."','".$ordre."','".$numeroCompteur."','".$numeroContrat."','".$ancienIndex."','".$chiffres14."','".$anneeReleve."','".$moisReleve."')";



		if(mysqli_query($mysqli, $sqlreleve)){
			echo "Records inserted successfully.";
		} else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
		}


		$ligne=fgets($file);

	}

	mysqli_close($mysqli);

*/
?>