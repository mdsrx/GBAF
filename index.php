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
	<div class="content-page">
		<div class="container">
			<div class="bloc-content">
				<!-- Connexion -->
				<h2>Connexion</h2>
				<form method="post" action="connexion.php">
					<p>
						<label for="username">Username</label>
						<input type="text" name="username" maxlength="255" autocomplete="username" required />
					</p>
					<p>
						<label for="pass">Mot de passe</label>
						<input type="password" name="pass" maxlength="255" autocomplete="current-password" required />
					</p>
					<input type="submit" name="connexion" value="Se connecter >" class="button" />
				</form>
				<p>
					<a href="forgottenpass.php"><em>Mot de passe oublié ?</em></a>
				</p>
			</div>
			<div class="bloc-content">
				<!-- Inscription -->
				<h2>Première visite ?</h2>
				<p>Pour profiter de nos services, créez dès à présent un compte sur l'extranet de GBAF.</p>
				
				<p>
					<button class="button"><a href="inscription.php">S'inscrire ></a></button>
				</p>
			</div>
		</div>
	</div>
	<?php
	include 'footer.php';
	?>
</body>
</html>