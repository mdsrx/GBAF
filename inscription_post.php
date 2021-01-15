<?php

// Connexion à la BDD
require 'connect_database.php';

/*
** VERIFICATION des variables $_POST
*/
if (isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['passconfirm']) && isset($_POST['question']) && isset($_POST['answer'])) {

	$lastname = htmlspecialchars($_POST['lastname']);
	$firstname = htmlspecialchars($_POST['firstname']);
	$username = htmlspecialchars($_POST['username']);
	$pass = htmlspecialchars($_POST['pass']);
	$passconfirm = htmlspecialchars($_POST['passconfirm']);
	$question = htmlspecialchars($_POST['question']);
	$answer = htmlspecialchars($_POST['answer']);

	// Vérifier que les deux mots de passe correspondent
	if ($_POST['pass'] != $_POST['passconfirm']) {
		//echo 'Les mots de passe ne correspondent pas.';
		header('Location: inscription.php?pass=0');
		die();
	}

	// Vérifier que le pseudo n'existent pas déjà dans la base de données
	$req = $bdd->query("SELECT username FROM membres WHERE username ='". $username . "'");
	
	while ($donnees = $req->fetch()) {
		// pseudo déjà utilisé
		//echo 'Pseudonyme déjà existant.';
		header('Location: inscription.php?pseudo=0');
		die();
	}
	$req->closeCursor();

	// Hachage du mot de passe
	$pass_hache = password_hash($pass, PASSWORD_DEFAULT);

	/*
	** Ajout à la base de données
	*/
	$req = $bdd->prepare('INSERT INTO membres(nom, prenom, username, password, question, reponse) VALUES (:lastname, :firstname, :username, :pass, :question, :answer)');
	$req->execute(array(
		'lastname' => $lastname,
		'firstname' => $firstname,
		'username' => $username,
		'pass' => $pass_hache,
		'question' => $question,
		'answer' => $answer
	));
	$req->closeCursor();

	//echo 'Vous êtes inscrits.';
}

// Redirection vers la page d'accueil
header('Location: index.php');

?>