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
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>GBAF - <?php echo $resultat['acteur']; ?></title>
</head>
<body>
	<?php
	include 'header.php';
	?>
	<div class="content-page">
		<div class="container">
			<div class="bloc-content partenaire">
				
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
			</div>
			<div class="bloc-content">
				<h2>Commentaires</h2>
				<!-- Espace commentaires -->
			</div>
			<p>
				<a href="partners.php"><em>Retour à la liste des partenaires ></em></a>
			</p>
		</div>
	</div>
	<?php
	include 'footer.php';
	?>
</body>
</html>