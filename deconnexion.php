<?php
session_start();

if (isset($_SESSION['id_user']) && isset($_SESSION['username'])) {
	$_SESSION = array();
	session_destroy();
}
header('Location: index.php');
?>