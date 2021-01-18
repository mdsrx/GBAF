<?php
/*
** PAGE DE PARAMETRES DU COMPTE
*/
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
// retour à l'accueil si pas connecté
if (!isset($_SESSION['id_user'])) {
	header('Location: index.php');
	die();	
} else {
	$id_user = $_SESSION['id_user'];
	// Connexion à la BDD
	require 'connect_database.php';
	
	// récupérer dans la base les infos de l'utilisateur
	$req = $bdd->prepare('SELECT id_user, nom, prenom, username, password, question, reponse FROM membres WHERE id_user = :id_user');
	$req->execute(array(
	    'id_user' => $id_user));
	$resultat = $req->fetch();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>GBAF - Paramètres du compte</title>
</head>
<body>
	<?php
	include 'header.php';
	?>
	<div class="content-page">
		<div class="container">
			<div class="bloc-content">
				<!-- Informations de l'utilisateur -->
				<h2>Paramètres du compte</h2>
				<div class="confirmation">
					<?php
					if (isset($_GET['update']) && $_GET['update'] == '0') {
						echo '<p>Informations mises à jour.</p>';
					}
					?>
				</div>
				<form method="post" action="profil_update.php">
					<p>
						<input type="hidden" name="id_user" value="<?php echo $resultat['id_user']; ?>">
					</p>
					<p>
						<label for="lastname">Nom</label>
						<input type="text" name="lastname" maxlength="255" value="<?php echo $resultat['nom'] ?>" required />
					</p>
					<p>
						<label for="firstname">Prénom</label>
						<input type="text" name="firstname" maxlength="255" value="<?php echo $resultat['prenom'] ?>" required />
					</p>
					<p>
						<label for="username">Username</label>
						<input type="text" name="username" maxlength="255" value="<?php echo $resultat['username'] ?>" required />
					</p>
					<p>
						<label for="pass">Mot de passe</label>
						<input type="password" name="pass" maxlength="255" value="<?php echo $resultat['password'] ?>" required />
					</p>
					<p>
						<label for="question">Question secrète</label>
						<input type="text" name="question" maxlength="255" value="<?php echo $resultat['question'] ?>" required />
					</p>
					<p>
						<label for="answer">Réponse secrète</label>
						<input type="text" name="answer" maxlength="255" value="<?php echo $resultat['reponse'] ?>" required />
					</p>
					<input type="submit" class="button" name="inscription" value="Mettre à jour les informations >" />
				</form>			
			</div>
		</div>
	</div>
	<?php
	include 'footer.php';
	?>
</body>
</html>