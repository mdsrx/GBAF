<?php

// Connexion à la BDD
require 'connect_database.php';

// vérification variables $_POST
if (isset($_POST['id_acteur']) && isset($_POST['id_user']) && isset($_POST['commentaire'])) {
	$id_acteur = $_POST['id_acteur'];
	$id_user = $_POST['id_user'];
	$commentaire = htmlspecialchars($_POST['commentaire']);

	// mise à jour du commentaire
	$req = $bdd->prepare('UPDATE posts SET post = :post, date_post = NOW() WHERE id_user = :id_user AND id_acteur = :id_acteur');
	$req->execute(array(
		'post' => $commentaire,
		'id_user' => $id_user,
		'id_acteur' => $id_acteur
	));
}
header('Location: partner.php?id=' . $id_acteur);

?>