<?php
	require_once "connexion_bdd.php";  // se connecte à la bdd

	if (isset($_POST['psd'])) { // vérifie que la personne a bien remplit le formulaire

		// envoie une requête qui vérifie que le pseudo n'est pas déjà dans la bdd
		$req = $bdd->prepare("SELECT COUNT(*) AS nbrow FROM `utilisateurs` WHERE utilisateurs.pseudo =:var1 ");
		$req->bindValue('var1', $_POST['psd'], PDO::PARAM_STR);
		$req->execute();
		$rep = $req->fetch();
		$req->closeCursor();

		// si le pseudo choisie n'est pas dans la bdd
		if ($rep['nbrow'] == 0) {

			// envoie une requête pour insérer l'utilisateur dans la bdd
			$insert = $bdd->prepare("INSERT INTO `utilisateurs`(`pseudo`, `mail`, `mdp`) VALUES (:var1,:var2,:var3)");
			$insert->bindValue('var1', $_POST['psd'], PDO::PARAM_STR);
			$insert->bindValue('var2', $_POST['mail'], PDO::PARAM_STR);
			$insert->bindValue('var3', $_POST['pass'], PDO::PARAM_STR);
			$insert->execute();

			//débute la section
			session_start();
			$_SESSION['login'] = $_POST['psd']; // définit la variable de section login sur la variable pseudo

			header("Location: membre.php"); // puis redirige vers la page membre
			exit;

		} else { // si le pseudo choisi est déjà dans la base de donnée
			echo "Le pseudo saisi n’est pasdisponible. Essayer  un autre pseudo"; // affiche un message d'erreur
			header('refresh:4;url=visiteur.php'); // redirige vers la page visiteur après 4 secondes
			exit;
		}

	} else {
		header("Location: login.php"); // si non redirige vers la page login
		exit;
	}
?>