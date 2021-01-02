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
	<div class="container">
		<div class="bloc-content">
			<!-- Inscription -->
			<h2>Inscription</h2>
			<form method="post" action="inscription.php">
				<label for="lastname">Nom</label>
				<br>
				<input type="text" name="lastname" maxlength="255" required />
				<br>
				<label for="firstname">Prénom</label>
				<br>
				<input type="text" name="firstname" maxlength="255" required />
				<br>
				<label for="username">Username</label>
				<br>
				<input type="text" name="username" maxlength="255" required />
				<br>
				<label for="pass">Mot de passe</label>
				<br>
				<input type="password" name="pass" maxlength="255" required />
				<br>
				<label for="passconfirm">Confirmer le mot de passe</label>
				<br>
				<input type="password" name="passconfirm" maxlength="255" required />
				<br>
				<label for="question">Question secrète</label>
				<br>
				<input type="text" name="question" maxlength="255" required />
				<br>
				<label for="answer">Réponse secrète</label>
				<br>
				<input type="text" name="answer" maxlength="255" required />
				<br>
				<input type="submit" name="inscription" value="S'inscrire >" />
			</form>			
		</div>
	</div>
	<?php
	include 'footer.php';
	?>
</body>
</html>