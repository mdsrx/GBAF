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
	<div class="content-page">
		<div class="container">
			<div class="bloc-content">
				<!-- Connexion -->
				<h2>Mot de passe oublié</h2>
				<form method="post" action="forgottenpass.php">
					<p>
						<label for="username">Username</label>
						<input type="text" name="username" maxlength="255" required />
					</p>
					<input type="submit" name="connexion" class="button" value="Afficher ma question secrète >" />
				</form>			
			</div>
		</div>
	</div>
	<?php
	include 'footer.php';
	?>
</body>
</html>