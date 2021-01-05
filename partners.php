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
		<!--
			...
		-->
	</div>
	<?php
	include 'footer.php';
	?>
</body>
</html>