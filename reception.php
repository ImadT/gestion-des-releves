<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Reception</title>

	<link rel="stylesheet" type="text/css" href="receptionStyle.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="body">
	<div class="container">
		<img src="1.png" height="90" width="250">

		<form method="post" action = "reception.php">
			<input type="button" name="administration" value="Administration" class="input inputLeft" onclick="window.location.href = 'http://localhost/projet2/administration.php'">
			<input type="button" name="utilisateur" value="Utilisateur" class="input inputRight" onclick="window.location.href = 'http://localhost/projet2/code.php'">			
		</form>		
	</div>


</body>
</html>