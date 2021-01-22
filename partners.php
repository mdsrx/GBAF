<?php
/*
** PAGE DES PARTENAIRES
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

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="img/LOGO_GBAF_ROUGE.png">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>GBAF - Acteurs & Partenaires</title>
</head>
<body>
	<?php
	include 'header.php';
	?>
	<section class="content-page">
		<div class="container">
			<section class="bloc-content presentation">
				<h1>Qu'est-ce que GBAF ?</h1>
				<p>
					<strong>Le Groupement Banque-Assurance Français (GBAF)</strong> est une fédération représentant les 6 grands groupes français (BNP Paribas, BPCE, Crédit Agricole, Crédit Mutuel-CIC, Société Générale, La Banque Postale).
				</p>
				<p>
					Le GBAF est le représentant de la profession bancaire et des assureurs sur tous les axes de la réglementation financière française. Sa mission est de promouvoir l’activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des pouvoirs publics.
				</p>
				<h2>Quel est le but de cet extranet ?</h2>
				<p>
					Afin de renseigner au mieux les clients, le GBAF vous propose un point d’entrée unique, répertoriant un grand nombre d’informations sur les partenaires et acteurs du groupe GBAF ainsi que sur les produits et services bancaires et financiers.
				</p>
				<p>
					Vous avez la possibilité de rechercher les informations dont vous avez besoin et de laisser un avis sur les partenaires et acteurs du secteur bancaire, tels que les associations ou les financeurs solidaires.
				</p>
				<img src="img/GBAF-illustration.jpg" alt="Illustration de GBAF"/>
			</section>
			<section class="bloc-content">
				<!-- Affichage des partenaires -->
				<h2>Acteurs et Partenaires</h2>
				<ul>
					<?php
						/*
						** Récupération des partenaires dans la BDD
						*/
						$reponse = $bdd->query('SELECT id_acteur, acteur, description, logo FROM acteurs ORDER BY id_acteur');
						while ($donnees = $reponse->fetch()) {
							// élément de liste
							echo '<li>';

							// affichage du logo
							echo '<div class="logo_partner"><img src="img/partners/' . htmlspecialchars($donnees['logo']) . '" alt="Logo ' . htmlspecialchars($donnees['acteur']) .  '" /></div>';

							// affichage du nom de l'acteur
							echo '<div class="text_partner"><h3>' . htmlspecialchars($donnees['acteur']) . '</h3>';

							// affichage de la description limitée à une phrase
							echo '<p>' . substr(htmlspecialchars($donnees['description']), 0, strpos(htmlspecialchars($donnees['description']), ".", 1) + 1) . ' [...]</p>';

							// affichage du nombe de likes / dislikes
							$rep = $bdd->prepare('SELECT vote FROM votes WHERE id_acteur = ?');
							$rep->execute(array($donnees['id_acteur']));
							$nbrLikes = 0;
							$nbrDislikes = 0;
							while ($votes = $rep->fetch()) {
								// comptage du nbr de likes et dislikes
								if ($votes['vote'] == 'like')
									$nbrLikes++;
								else if ($votes['vote'] == 'dislike')
									$nbrDislikes++;
							}
							$rep->closeCursor();

							// récupération du nbr de commentaires
							$req = $bdd->prepare('SELECT * FROM posts WHERE id_acteur = ?');
							$req->execute(array($donnees['id_acteur']));
							$comments = $req->fetch();
							$nbrComments = $req->rowCount();
							$req->closeCursor();

							?>
							<div class="likes_display">
								<div class="vote">
									<p>
										<img src="img/like.png" alt="Icône J'aime"/>
										(<?php echo $nbrLikes; ?>)
									</p>
								</div>
								<div class="vote">
									<p>
										<img src="img/dislike.png" alt="Icône Je n'aime pas"/>
										(<?php echo $nbrDislikes; ?>)
									</p>
								</div>
								<div class="vote">
									<p>
										<img src="img/comment.png" alt="Icône Commentaires"/>
										(<?php echo $nbrComments; ?>)
									</p>
								</div>
							</div>
							<?php
							// affichage du lien vers la page partner
							echo '<a class="button" href="partner.php?id=' . $donnees['id_acteur'] . '">Afficher la suite ></a></div>';

							echo '</li>';
						}

						$reponse->closeCursor();
					?>
				</ul>
			</section>
		</div>
	</section>
	<?php
	include 'footer.php';
	?>
</body>
</html>