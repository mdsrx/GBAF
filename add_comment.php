<?php

// Connexion à la BDD
require 'connect_database.php';

// vérification variables $_POST
if (isset($_POST['id_acteur']) && isset($_POST['id_user']) && isset($_POST['commentaire'])) {
	$id_acteur = $_POST['id_acteur'];
	$id_user = $_POST['id_user'];
	$commentaire = htmlspecialchars($_POST['commentaire']);

	// ajout dans la base de données
	$req = $bdd->prepare('INSERT INTO posts(id_user, id_acteur, post) VALUES (:id_user, :id_acteur, :post)');
	$req->execute(array(
		'id_user' => $id_user,
		'id_acteur' => $id_acteur,
		'post' => $commentaire
	));
	$req->closeCursor();
}

header('Location: partner.php?id=' . $id_acteur);

?>