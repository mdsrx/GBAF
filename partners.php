<?php
/*
** PAGE DES PARTENAIRES
*/
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if (!isset($_SESSION['id_user'])) {
	header('Location: index.php');
	die();	
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>GBAF - Acteurs & Partenaires</title>
</head>
<body>
	<?php
	include 'header.php';
	?>
	<div class="container">
		<div class="bloc-content presentation">
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
		</div>
		<div class="bloc-content">
			<!-- Affichage des partenaires -->
			<h2>Acteurs et Partenaires</h2>
			<?php
				/*
				** Récupération des partenaires dans la BDD
				*/
			?>
		</div>
	</div>
	<?php
	include 'footer.php';
	?>
</body>
</html>