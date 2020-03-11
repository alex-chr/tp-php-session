<?php
	try { // essaye de se connecté à la bdd
		$bdd = new PDO("mysql:host=localhost; dbname=portfolio", 'root', '');
		$bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOexecption $e) {
		echo "non connecté";
	}
?>