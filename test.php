<?php

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



/*					
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


*/

?>