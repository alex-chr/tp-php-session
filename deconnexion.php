<?php
	session_start();  // lance la section
	session_unset();  // détruit les variable de section
	session_destroy(); // détruit la section
	header("Location: login.php"); // redirige vers la page de login
?>