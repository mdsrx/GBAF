<?php
/*
** PAGE DE MOT DE PASSE OUBLIE
*/
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>GBAF - Mot de passe oublié</title>
</head>
<body>
	<?php
	include 'header.php';
	?>
	<div class="container">
		<div class="bloc-content">
			<!-- Connexion -->
			<h2>Mot de passe oublié</h2>
			<form method="post" action="forgottenpass.php">
				<label for="username">Username</label>
				<br>
				<input type="text" name="username" maxlength="255" required />
				<br>
				<input type="submit" name="connexion" value="Afficher ma question secrète >" />
			</form>			
		</div>
	</div>
	<?php
	include 'footer.php';
	?>
</body>
</html>