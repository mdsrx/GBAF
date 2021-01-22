<?php
/*
** PAGE D'ACCUEIL
*/
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if (isset($_SESSION['id_user']) && isset($_SESSION['username'])) {
	header('Location: partners.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="img/LOGO_GBAF_ROUGE.png">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>GBAF - Accueil</title>
</head>
<body>
	<?php
	include 'header.php';
	?>
	<section class="content-page">
		<div class="container">
			<section class="bloc-content">
				<!-- Connexion -->
				<h2>Connexion</h2>
				<div class="error">
					<?php
					if (isset($_GET['connexion']) && $_GET['connexion'] == '0') {
						echo '<p>Le pseudo ou le mot de passe est incorrect.</p>';
					}
					?>
				</div>
				<form method="post" action="connexion.php">
					<p>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" maxlength="255" autocomplete="username" required />
					</p>
					<p>
						<label for="pass">Mot de passe</label>
						<input type="password" id="pass" name="pass" maxlength="255" autocomplete="current-password" required />
					</p>
					<input type="submit" name="connexion" value="Se connecter >" class="button" />
				</form>
				<p>
					<a href="forgottenpass.php"><em>Mot de passe oublié ?</em></a>
				</p>
			</section>
			<section class="bloc-content">
				<!-- Inscription -->
				<h2>Première visite ?</h2>
				<p>Pour profiter de nos services, créez dès à présent un compte sur l'extranet de GBAF.</p>
				
				<p>
					<a class="button" href="inscription.php">S'inscrire ></a>
				</p>
			</section>
		</div>
	</section>
	<?php
	include 'footer.php';
	?>
</body>
</html>