<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Radeeta 2</title>

	<script type="text/javascript" src= "script.js"></script>

	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
<body>

	<div class= "container">
		<img src="1.png" height="90" width="250">
		<div class= "center">
			<form method="post" action = "code.php">
				<?php
				// inclure le fichier "index.php" qui contient les raisonnements
				include("index.php");			
					
				?>	
					<label for= "reference">référence:</label>
					<input type="text" id="reference" class="field left" readonly name="referencee" value="<?php  echo $reference; ?>" />
				<br>
				
					<label for= "Num_Cpt">Num_Cpt:</label>
					<input type="text" id="Num_Cpt" class="field left" readonly name="Nu_Cpt" value="<?php echo $numeroCompteur; ?>" />
				<br>

					<label for= "index">Index:</label><input type= "number" id= "index" name= "index" size="5">
		            <input type="checkbox" value="Patente"> Patente<br>
		        <br>
		        	<label for= "annotation">Annotation:</label>
		        	<select id= "annotation" name= "annotation" onchange="getAnomalieByAnotation()">
		        		<option>Selectionner une Annotation</option>
						<?php
							$mysqli = new mysqli("localhost", "root", "", "radeeta");
						
							// Check connection
							if($mysqli === false){
							    die("ERROR: Could not connect. " . mysqli_connect_error());
							}
						
							mysqli_set_charset($mysqli,"utf8");
						
							$sql = "select DISTINCT annotation from anomalie_annotation";
						
							if ($result = mysqli_query($mysqli, $sql)) {
						
								while ($row = mysqli_fetch_array($result)) {
									echo "<option>".$row[0]."</option>";
								}
							}
						
							mysqli_close($mysqli);
						?>

		            </select>
		            <br>

		            <label for= "Anomalie">Anomalie</label>
			        <select id= "Anomalie" name= "anomalie">
			        	<script type="text/javascript">

			        		<?php
			        	
								$mysqli = new mysqli("localhost", "root", "", "radeeta");
						
								// Check connection
								if($mysqli === false){
								    die("ERROR: Could not connect. " . mysqli_connect_error());
								}
						
								mysqli_set_charset($mysqli,"utf8");
						
								$sql = "select anomalie from anomalie_annotation";
						
								if ($result = mysqli_query($mysqli, $sql)) {
									$arrayAnomalie = array();
								
						
									while ($row = mysqli_fetch_array($result)) {
										array_push($arrayAnomalie,$row[0]); 
									}
								}
						
								mysqli_close($mysqli);
							?>

			        		const anomalie =<?php echo '["'.implode('","',$arrayAnomalie). '"];'; ?>

			        	    function getAnomalieByAnotation() {
			        			var annot = document.getElementById("annotation").value;
			        			let con = 0;
			        			let num = 0;
			        			/*vider la balise option*/
			        			var select = document.getElementById("Anomalie");
			        			while(select.options.length) {
			        				select.remove(0);
			        			}
			        			/*recharger la balise option*/
			        			if(annot != "Selectionner une Annotation") {
			        				while(con < anomalie.length) {
				        				var a = annot.split("-")[0];
				        				let bool1 = anomalie[con].startsWith(a.substr(0,2));
				        				if(bool1) {
				        					/*
				        					document.getElementById("Anomalie").option[num].text.innerHTML = anomalie[con];
				        					*/
				        					var x = document.getElementById("Anomalie");
				        					var c = document.createElement("option");
				        					c.text = anomalie[con];

				        					x.options.add(c,num);

				        					num++;
				        				}
				        				con++;
			        				}
			        			}
			        		}
			        	</script>
			        	<option></option>
		            </select>
		            <div id= "block2">
			
						<input type="submit" id="Precedent" name="Precedent" value="Precedent">
						<input type="submit" id="Valide" name="Valide" value="Valide">
						<input type="submit" id="Suivant" name="Suivant" value="Suivant">

						<p id= "secteur">1/23</p>
					</div>
            </form>
		<div>
		<p id= "saison">2018/2019</p>

	</div>
	
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script type="text/javascript" src= "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>