<?php
/*
** CONNEXION A LA BASE DE DONNEES
*/
$sqlHost     = 'localhost'; 		
$sqlUser     = 'root';			
$sqlPassword = '';				
$dbName      = 'gbaf';  	

$bdd = new PDO('mysql:host='.$sqlHost.';dbname='.$dbName.';charset=utf8',$sqlUser,$sqlPassword) or die($bdd->errorInfo());

?>

