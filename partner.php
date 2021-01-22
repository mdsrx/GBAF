<?php
/*
** PAGE DU PARTENAIRE
*/
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
// si pas connecté => redirection vers connexion
if (!isset($_SESSION['id_user'])) {
	header('Location: index.php');
	die();	
}

// Connexion à la BDD
require 'connect_database.php';

/*
** Récupération du partenaire
*/
if (isset($_GET['id'])) {
	$id_acteur = $_GET['id'];

	$req = $bdd->prepare('SELECT id_acteur, acteur, description, logo FROM acteurs WHERE id_acteur = :id_acteur');
	$req->execute(array(
		'id_acteur' => $id_acteur
	));
	$resultat = $req->fetch();
}
// si aucun acteur ne correspond à l'id -> redirection
if (!isset($resultat) || empty($resultat)) {
	header('Location: partners.php');
	die();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>GBAF - <?php echo $resultat['acteur']; ?></title>
</head>
<body>
	<?php
	include 'header.php';
	?>
	<section class="content-page">
		<div class="container">
			<section class="bloc-content partenaire">
				
				<!-- Affichage logo, acteur, description -->
				<?php
					if (isset($resultat)) {
						// affichage du logo
						echo '<div class="logo_fullwidth"><img src="img/partners/' . htmlspecialchars($resultat['logo']) . '" alt="Logo ' . htmlspecialchars($resultat['acteur']) . '"/></div>';

						// affichage du nom de l'acteur
						echo '<h1>' . htmlspecialchars($resultat['acteur']) . '</h1>';

						// affichage de la description
						echo '<p>' . nl2br(htmlspecialchars($resultat['description'])) . '</p>';
					}
				?>
				<!-- Espace Like / Dislike -->
				<div class="likes">
					<!-- Afficher le nombre de likes / dislikes -->
					<?php
						// récupération des votes de l'acteur
						$rep = $bdd->prepare('SELECT id_user, vote, id_acteur FROM votes WHERE id_acteur = ?');
						$rep->execute(array($id_acteur));
						$nbrLikes = 0;
						$nbrDislikes = 0;
						$liked = "";
						$disliked = "";
						while ($votes = $rep->fetch()) {
							// comptage du nbr de likes et dislikes
							if ($votes['vote'] == 'like') {
								$nbrLikes++;
								// si le vote a été fait par l'utilisateur connecté
								if ($votes['id_user'] == $_SESSION['id_user']) {
									$liked = "liked";
								}
							} else if ($votes['vote'] == 'dislike') {
								$nbrDislikes++;
								// si le vote a été fait par l'utilisateur connecté
								if ($votes['id_user'] == $_SESSION['id_user']) {
									$disliked = "disliked";
								}
							}
						}
						$rep->closeCursor();

						// récupération du nbr de commentaires
						$req = $bdd->prepare('SELECT * FROM posts WHERE id_acteur = ?');
						$req->execute(array($id_acteur));
						$comments = $req->fetch();
						$nbrComments = $req->rowCount();
						$req->closeCursor();
					?>
					<!-- Possibilité de voter via lien -->
					<div class="vote">
						<p>
							<img src="img/like.png" alt="Icône J'aime"/>
							<a href="likes.php?vote=like&idacteur=<?php echo $resultat['id_acteur']; ?>" class="<?php echo $liked; ?>">
								<em>
									J'aime (<?php echo $nbrLikes; ?>)
								</em>
							</a>
						</p>
					</div>
					<div class="vote">
						<p>
							<img src="img/dislike.png" alt="Icône Je n'aime pas"/>
							<a href="likes.php?vote=dislike&idacteur=<?php echo $resultat['id_acteur']; ?>" class="<?php echo $disliked; ?>">
								<em>
									Je n'aime pas (<?php echo $nbrDislikes; ?>)
								</em>
							</a>
						</p>
					</div>
				</div>
			</section>
			<section class="bloc-content comment">
				<h2>Commentaires (<?php echo $nbrComments; ?>)</h2>
				<p>
					<br/>
					<a href="#add_comment" class="button btn_add">Ajouter un commentaire ></a>
					<br/>
					<br/>
				</p>
				<!-- Espace commentaires -->
				<!-- Affichage des commentaires -->
				<ul>
					<?php
					// récupération des commentaires
					$reponse = $bdd->prepare('SELECT post, id_user, DATE_FORMAT(date_post, \'%d/%m/%Y %Hh%imin%ss\') AS dateCom FROM posts WHERE id_acteur = ? ORDER BY dateCom DESC');
					$reponse->execute(array($id_acteur));
					$nbrComments = 0;
					while ($donnees = $reponse->fetch()) {
						// si commentaire de l'utilisateur connecté
						if ($donnees['id_user'] == $_SESSION['id_user']) {
							$commented = true;
							$comment_user = $donnees['post'];
						}
						// récupération de l'auteur du commentaire
						$rep = $bdd->prepare('SELECT nom, prenom FROM membres WHERE id_user = ?');
						$rep->execute(array($donnees['id_user']));
						$user_infos = $rep->fetch();
						// affichage du commentaire
						echo '<li class="post"><h3>' . htmlspecialchars($user_infos['prenom']) . " " . $user_infos['nom'] . ' <em>' . $donnees['dateCom'] . '</em></h3><p>' . nl2br(htmlspecialchars($donnees['post'])) . '</p></li>';
						$rep->closeCursor();
						$nbrComments++;
					}
					if ($nbrComments === 0)
						echo '<p>Il n\'y a pour l\'instant aucun commentaires pour cet acteur.</p>';
					$reponse->closeCursor();
					?>
				</ul>
			</section>
			<section class="bloc-content">
				<?php if (isset($commented)) { ?>
				<!-- Mise à jour du commentaire -->
				<h2>Mettre à jour mon commentaire</h2>
				<form method="post" action="update_comment.php" class="add_comment">
					<input type="hidden" name="id_acteur" value="<?php echo $id_acteur; ?>"/>
					<input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user'] ?>"/>
					<p>
						<label for="commentaire">Votre commentaire :</label>
						<br/>
						<br/>
						<textarea id="commentaire" name="commentaire" placeholder="Ecrivez votre commentaire ici" required><?php echo $comment_user; ?></textarea>
					</p>
					<input type="submit" class="button" name="envoyer" value="Envoyer votre commentaire >" />
				</form>
				<?php } else { ?>
				<!-- Ajout d'un commentaire -->
				<h2>Ajouter un commentaire</h2>
				<form method="post" action="add_comment.php" class="add_comment">
					<input type="hidden" name="id_acteur" value="<?php echo $id_acteur; ?>"/>
					<input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user'] ?>"/>
					<p>
						<label for="commentaire">Votre commentaire :</label>
						<br/>
						<br/>
						<textarea id="commentaire" name="commentaire" placeholder="Ecrivez votre commentaire ici" required></textarea>
					</p>
					<input type="submit" class="button" name="envoyer" value="Envoyer votre commentaire >" />
				</form>
				<?php } ?>
			</section>
				<p>
					<a href="partners.php"><em>Retour à la liste des partenaires ></em></a>
				</p>
		</div>
	</section>
	<?php
	include 'footer.php';
	?>
</body>
</html>