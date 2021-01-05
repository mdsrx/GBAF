<?php
/*
** PAGE DE CONNEXION
*/

/*
** CONNEXION A LA BASE DE DONNEES
*/

// Connexion à la BDD MySQL sous WAMP
// affiche un message d'erreur si connexion échouée
try {
	$bdd = new PDO('mysql:host=localhost;dbname=gbaf;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());
}

//vérification des variables $_POST
if (isset($_POST['username']) && isset($_POST['pass'])) {

	$username = htmlspecialchars($_POST['username']);
	$pass = htmlspecialchars($_POST['pass']);

	//  Récupération de l'utilisateur et de son pass hashé
	$req = $bdd->prepare('SELECT id_user, password, prenom, nom FROM membres WHERE username = :username');
	$req->execute(array(
	    'username' => $username));
	$resultat = $req->fetch();

	// Comparaison du pass envoyé via le formulaire avec la base
	$isPasswordCorrect = password_verify($pass, $resultat['password']);

	if (!$resultat) {
		header('Location: index.php?connexion=0');
		die();
	} else {
		if ($isPasswordCorrect) {
			//echo "Vous êtes connectés.";

			// variables de session
			session_start();
			$_SESSION['id_user'] = $resultat['id_user'];
			$_SESSION['firstname'] = $resultat['prenom'];
			$_SESSION['lastname'] = $resultat['nom'];
			$_SESSION['username'] = $username; 

			header('Location: partners.php');
			die();
		}
	}
}

header('Location: index.php?connexion=0');

?>