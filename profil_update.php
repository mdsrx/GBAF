<?php

// Connexion à la BDD
require 'connect_database.php';

/*
** MISE A JOUR DES INFOS DANS LA BASE
*/
if (isset($_POST['id_user']) && isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['username']) && isset($_POST['pass']) && isset($_POST['question']) && isset($_POST['answer'])) {

	$id_user = $_POST['id_user'];
	$nom = htmlspecialchars($_POST['lastname']);
	$prenom = htmlspecialchars($_POST['firstname']);
	$username = htmlspecialchars($_POST['username']);
	$pass = htmlspecialchars($_POST['pass']);
	$question = htmlspecialchars($_POST['question']);
	$reponse = htmlspecialchars($_POST['answer']);

	// check password
	$req = $bdd->prepare('SELECT password FROM membres WHERE id_user = :id_user');
	$req->execute(array(
		'id_user' => $id_user
	));
	$resultat = $req->fetch();
	if ($pass == $resultat['password']) {
		$pass_hache = $pass; 
	} else {
		$pass_hache = password_hash($pass, PASSWORD_DEFAULT);
	}

	// mise à jour des infos
	$req = $bdd->prepare('UPDATE membres SET nom = :nom, prenom = :prenom, username = :username, password = :password, question = :question, reponse = :reponse WHERE id_user = :id_user');
	$req->execute(array(
		'nom' => $nom,
		'prenom' => $prenom,
		'username' => $username,
		'password' => $pass_hache,
		'question' => $question,
		'reponse' => $reponse,
		'id_user' => $id_user
	));
	$req->closeCursor();

	// mise à jour des variables de session
	session_start();
	$_SESSION['firstname'] = $prenom;
	$_SESSION['lastname'] = $nom;
	$_SESSION['username'] = $username;


	header('Location: profil.php?update=0');
} else {
	header('Location: profil.php');
}


?>