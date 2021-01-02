<?php
/*
** PAGE D'INSCRIPTION
*/
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>GBAF - Inscription</title>
</head>
<body>
	<?php
	include 'header.php';
	?>
	<div class="content-page">
		<div class="container">
			<div class="bloc-content">
				<!-- Inscription -->
				<h2>Inscription</h2>
				<form method="post" action="inscription.php">
					<p>
						<label for="lastname">Nom</label>
						<input type="text" name="lastname" maxlength="255" required />
					</p>
					<p>
						<label for="firstname">Prénom</label>
						<input type="text" name="firstname" maxlength="255" required />
					</p>
					<p>
						<label for="username">Username</label>
						<input type="text" name="username" maxlength="255" required />
					</p>
					<p>
						<label for="pass">Mot de passe</label>
						<input type="password" name="pass" maxlength="255" required />
					</p>
					<p>
						<label for="passconfirm">Confirmer le mot de passe</label>
						<input type="password" name="passconfirm" maxlength="255" required />
					</p>
					<p>
						<label for="question">Question secrète</label>
						<input type="text" name="question" maxlength="255" required />
					</p>
					<p>
						<label for="answer">Réponse secrète</label>
						<input type="text" name="answer" maxlength="255" required />
					</p>
					<input type="submit" class="button" name="inscription" value="S'inscrire >" />
				</form>			
			</div>
		</div>
	</div>
	<?php
	include 'footer.php';
	?>
</body>
</html>