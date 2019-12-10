<?php

	function select() {
		//otherwise you can access it as $GLOBALS['data']
		global $reference, $numeroCompteur;

		$mysqli = new mysqli("localhost", "root", "", "radeeta");
							
		// Check connection
		if($mysqli === false){
		    die("ERROR: Could not connect. " . mysqli_connect_error());
		}
									
		mysqli_set_charset($mysqli,"utf8");
									
		$sql = "select categorieAbonnement, secteur , tourne, ordre,numeroCompteur from releve where HeureReleve is NULL";
									
		if ($result = mysqli_query($mysqli, $sql)) {
									
			if($row1 = mysqli_fetch_array($result)){
				$reference=(String)"'".$row1['categorieAbonnement']."-".(String)$row1['secteur']."-".(String)$row1['tourne']."-".(String)$row1['ordre']."'";

				$numeroCompteur = (String)"'".$row1['numeroCompteur']."'";
			}
		}
		mysqli_close($mysqli);					
	}

	// la charge du browser
	if((!isset($_POST['Suivant'])) && (!isset($_POST['Precedent'])) && (!isset($_POST['Valide']))) {
		select();
	}	


	// valider code
	if (isset($_POST['Valide'])){
		$index = $_POST['index'];
		$_anomalie = $_POST['anomalie'];
		$anomalie = substr($_anomalie, 3,2);
		$_annotation = $_POST['annotation'];
		$annotation = substr($_annotation, 0, 2);
		$numero = $_POST['Nu_Cpt'];
		$date = date('dmy');
		$_time = time();
		$time = date("His",$_time);

		$insert = "UPDATE releve SET NouveauIndex=".$index.", Anomalie='".$anomalie."',Annotation='".$annotation."', DateReleve='".$date."', HeureReleve='".$time."' WHERE NumeroCompteur = ".$numero;


		$mysqli = new mysqli("localhost", "root", "", "radeeta");

		// Check connection
		if($mysqli === false){
		    die("ERROR: Could not connect. " . mysqli_connect_error());
		}

		mysqli_set_charset($mysqli,"utf8");

		if(mysqli_query($mysqli, $insert)){
			echo "<br>Records inserted successfully.";
		} else{
			echo "<br>ERROR: Could not able to execute $insert. " . mysqli_error($mysqli);
		}
	
		mysqli_close($mysqli);

		//pour ne pas avoir les champs reference et numerocompteur vide dans la page
		$reference=$_POST['referencee'];
		$numeroCompteur=$_POST['Nu_Cpt'];
	}

	// suivant code
	if (isset($_POST['Suivant'])){

		$mysqli = new mysqli("localhost", "root", "", "radeeta");

		// Check connection
		if($mysqli === false){
		    die("ERROR: Could not connect. " . mysqli_connect_error());
		}

		$id_sql = "SELECT id from releve where NumeroCompteur = ".$_POST['Nu_Cpt'];
		$count_sql = "SELECT COUNT(id) from releve";

		if (($result1 = mysqli_query($mysqli, $id_sql)) && ($result3 =mysqli_query($mysqli, $count_sql))) {			
			if(($row1 = mysqli_fetch_array($result1)) && ($row3 = mysqli_fetch_array($result3))){
				$id = $row1['id'];
				if($id = $row3[0]) {
					exit("c'est la derniere reference");
				}
			}
		}

		$suivant_sql = "SELECT categorieAbonnement, secteur , tourne, ordre,numeroCompteur from releve WHERE id = ".($id+1);

		if ($result2 = mysqli_query($mysqli, $suivant_sql)) {			
			if($row2 = mysqli_fetch_array($result2)){
				$reference=(String)"'".$row2['categorieAbonnement']."-".(String)$row2['secteur']."-".(String)$row2['tourne']."-".(String)$row2['ordre']."'";

				$numeroCompteur = (String)"'".$row2['numeroCompteur']."'";
			}
		}
		mysqli_close($mysqli);
	}

	// precedent code
	if(isset($_POST['Precedent'])){
		$mysqli = new mysqli("localhost", "root", "", "radeeta");

		// Check connection
		if($mysqli === false){
		    die("ERROR: Could not connect. " . mysqli_connect_error());
		}

		$id_sql = "SELECT id from releve where NumeroCompteur = ".$_POST['Nu_Cpt'];

		if ($result1 = mysqli_query($mysqli, $id_sql)) {			
			if($row1 = mysqli_fetch_array($result1)){
				$id = $row1['id'];
				if($id == 1){
					exit("C'est la derniere reference");
				}
			}
		}

		$precedent_sql = "SELECT categorieAbonnement, secteur , tourne, ordre,numeroCompteur from releve WHERE id = ".($id-1);

		if ($result2 = mysqli_query($mysqli, $precedent_sql)) {			
			if($row2 = mysqli_fetch_array($result2)){
				$reference=(String)"'".$row2['categorieAbonnement']."-".(String)$row2['secteur']."-".(String)$row2['tourne']."-".(String)$row2['ordre']."'";

				$numeroCompteur = (String)"'".$row2['numeroCompteur']."'";
			}
		}
		mysqli_close($mysqli);
	}

?>