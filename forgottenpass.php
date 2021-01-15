<?php
/*
** PAGE DE MOT DE PASSE OUBLIE
*/

// Connexion à la BDD
require 'connect_database.php';

// l'utilisateur a entré son username
if (isset($_POST['username'])) {
	// récupération de la question secrète de l'utilisateur
	$username = htmlspecialchars($_POST['username']);
	$req = $bdd->prepare('SELECT username, question FROM membres WHERE username = :username');
	$req->execute(array(
		'username' => $username
	));
	$resultat = $req->fetch();
	if ($resultat)
		$user_exists = true;
	else
		$user_exists = false;
	$req->closeCursor();
}

// l'utilisateur a entré sa réponse secrète
if (isset($_POST['reponse']) && isset($_POST['username']) && isset($_POST['question'])) {
	// vérification de la réponse
	$username = htmlspecialchars($_POST['username']);
	$reponse = htmlspecialchars($_POST['reponse']);
	$question = htmlspecialchars($_POST['question']);
	$req = $bdd->prepare('SELECT reponse, question FROM membres WHERE username = :username');
	$req->execute(array(
		'username' => $username
	));
	$resultat = $req->fetch();
	if ($reponse == $resultat['reponse'])
		$answer_correct = true;
	else
		$answer_correct = false;
	$req->closeCursor();
}

// l'utilisateur a entré un nouveau mot de passe
if (isset($_POST['pass']) && isset($_POST['pass_confirm']) && isset($_POST['username'])) {
	// mise à jour du mot de passe
	$username = htmlspecialchars($_POST['username']);
	$pass = htmlspecialchars($_POST['pass']);
	$pass_confirm = htmlspecialchars($_POST['pass_confirm']);

	$answer_correct = true;

	if ($pass != $pass_confirm) {
		$password_correct = false;
	} else {
		$password_correct = true;
		// hachage du mot de passe
		$pass_hache = password_hash($pass, PASSWORD_DEFAULT);
		$req = $bdd->prepare('UPDATE membres SET password = :pass WHERE username = :username');
		$req->execute(array(
			'pass' => $pass_hache,
			'username' => $username
		));
	}

}
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
				<!-- Mot de passe oublié -->
				<h2>Mot de passe oublié</h2>
				<div class="confirmation">
					<?php
					if (isset($password_correct) && $password_correct) {
						echo '<p>Mot de passe mis à jour.</p><button class="button"><a href="index.php">Se connecter ></a></button>';
					}
					?>
				</div>
				<div class="error">
					<?php
					if (isset($user_exists) && !$user_exists) {
						echo '<p>L\'utilisateur n\'existe pas</p>';
					}
					if (isset($answer_correct) && !$answer_correct) {
						echo '<p>La réponse secrète n\'est pas correcte.</p>';
					}
					if (isset($password_correct) && !$password_correct) {
						echo '<p>Les deux mots de passe ne sont pas identiques.</p>';
					}
					?>
				</div>
				<form method="post" action="forgottenpass.php">
					<?php
						if ((!isset($_POST['username']) && !isset($_POST['reponse'])) || (isset($user_exists) && !$user_exists)) {
					?>
					<p>
						<label for="username">Username</label>
						<input type="text" name="username" maxlength="255" required />
					</p>
					<input type="submit" name="afficherquestion" class="button" value="Afficher ma question secrète >" />
					<?php
						}
						if ((isset($_POST['username']) && !isset($_POST['reponse']) && !isset($_POST['pass']) && $user_exists) || (isset($answer_correct) && !$answer_correct)) {
					?>
					<p>
						<label for="username">Username</label>
						<input type="text" name="username" value="<?php echo $username; ?>" readonly />
					</p>
					<p>
						<label for="question">Question secrète</label>
						<input type="text" name="question" maxlength="255" value="<?php echo $resultat['question']; ?>" readonly />
					</p>
					<p>
						<label for="reponse">Reponse secrète</label>
						<input type="text" name="reponse" maxlength="255" required />
					</p>
					<input type="submit" name="confirmerreponse" class="button" value="Confirmer ma réponse secrète >" />
					<?php
						}
						if ((isset($_POST['reponse']) && $answer_correct) || (isset($password_correct) && !$password_correct)) {
					?>
					<p>
						<label for="username">Username</label>
						<input type="text" name="username" value="<?php echo $username; ?>" readonly />
					</p>
					<p>
						<label for="pass">Nouveau mot de passe</label>
						<input type="password" name="pass" maxlength="255" required />
					</p>
					<p>
						<label for="pass_confirm">Confirmer nouveau mot de passe</label>
						<input type="password" name="pass_confirm" maxlength="255" required />
					</p>
					<input type="submit" name="confirmerreponse" class="button" value="Valider >" />
					<?php
						}
					?>
				</form>			
			</div>
		</div>
	</div>
	<?php
	include 'footer.php';
	?>
</body>
</html>