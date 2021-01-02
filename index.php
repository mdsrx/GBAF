<?php
/*
** PAGE D'ACCUEIL
*/
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>GBAF - Accueil</title>
</head>
<body>
	<?php
	include 'header.php';
	?>
	<div class="container">
		<div class="bloc-content">
			<!-- Connexion -->
			<h2>Connexion</h2>
			<form method="post" action="connexion.php">
				<label for="username">Username</label>
				<br>
				<input type="text" name="username" maxlength="255" required />
				<br>
				<label for="pass">Mot de passe</label>
				<br>
				<input type="password" name="pass" maxlength="255" required />
				<br>
				<p>
					<a href="forgottenpass.php"><em>Mot de passe oublié ?</em></a>
				</p>
				<input type="submit" name="connexion" value="Se connecter >" />
			</form>			
		</div>
		<div class="bloc-content">
			<!-- Inscription -->
			<h2>Première visite ?</h2>
			<p>Pour profiter de nos services, créez dès à présent un compte sur l'extranet de GBAF.</p>
			
			<p>
				<a href="inscription.php"><button>S'inscrire ></button></a>
			</p>
		</div>
	</div>
	<?php
	include 'footer.php';
	?>
</body>
</html>