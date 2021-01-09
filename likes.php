<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
// si pas connecté => redirection vers connexion
if (!isset($_SESSION['id_user'])) {
	header('Location: index.php');
	die();	
}
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

if (isset($_GET['idacteur']) && isset($_GET['vote'])){

	$id_user = $_SESSION['id_user'];
	$id_acteur = intval($_GET['idacteur']);
	$vote = htmlspecialchars($_GET['vote']);

	// vérification que l'acteur correspondant à l'id existe
	$resp = $bdd->prepare('SELECT acteur FROM acteurs WHERE id_acteur = ?');
	$resp->execute(array($id_acteur));
	$acteur = $resp->fetch();
	$resp->closeCursor();

	// vérification du vote
	if (($vote == "like" || $vote == "dislike") && !empty($acteur)) {
		// l'acteur existe et le vote est correct
		// vérifier si l'utilisateur a déjà voté pour cet acteur
		$req = $bdd->prepare('SELECT id_user, id_acteur, vote FROM votes WHERE id_acteur = :id_acteur AND id_user = :id_user');
		$req->execute(array(
			'id_acteur' => $id_acteur,
			'id_user' => $id_user
		));
		$resultat = $req->fetch();
		$req->closeCursor();
		if (empty($resultat)) {
			// l'utilisateur n'a pas voté pour cet acteur
			$new_vote = $bdd->prepare('INSERT INTO votes(id_user, id_acteur, vote) VALUES (:id_user, :id_acteur, :vote)');
			$new_vote->execute(array(
				'id_user' => $id_user,
				'id_acteur' => $id_acteur,
				'vote' => $vote
			));
		} else {
			// l'utilisateur a déjà voté pour cet acteur
			// si clic sur déjà voté, annulation du vote
			if ($resultat['vote'] == $vote)
				$vote = 'novote';
			$up_vote = $bdd->prepare('UPDATE votes SET vote = :vote WHERE id_user = :id_user AND id_acteur = :id_acteur');
			$up_vote->execute(array(
				'vote' => $vote,
				'id_user' => $id_user,
				'id_acteur' => $id_acteur
			));
		}
		header('Location: partner.php?id=' . $id_acteur);
		die();
	} else {
		//echo "Vote incorrect ou l'acteur n'existe pas";
	}
}

// redirection vers page des partenaires
header('Location: partners.php');
?>