<?php
	// se connecte à la base de donnée
	require_once "connexion_bdd.php";

	// vérifie que le formulaire vient d'être remplit
	if (isset($_POST['pseudo'])) {

		// si oui lancement d'une requete SQL pour vérifier si l'utilisateur est bien enregistré dans la bdd
		$req = $bdd->prepare("SELECT COUNT(*) AS nbrow FROM utilisateurs WHERE utilisateurs.pseudo=:var1 AND utilisateurs.mdp=:var2"); //préparation de la requête
		$req->bindValue('var1', $_POST['pseudo'], PDO::PARAM_STR); 
		$req->bindValue('var2', $_POST['mdp'], PDO::PARAM_STR); // définit les deux variable de la requête
		$req->execute();  // execute la requête
		$rep = $req->fetch(); // stocke dans une variable le résultat de la requête
		$req->closeCursor(); // ferme la requête

		// démare une session
		session_start();
		$_SESSION['login'] = $_POST['pseudo']; // stocke dans une variable de section le pseudo

		if ($rep['nbrow'] == 0) { // si la requête renvoie que les identifiants ne sont pas dans la bdd
			header("Location: visiteur.php"); // redirige vers la page visiteur
			exit;
		} else { // si les identifiants sont bien dans la bdd
			$_SESSION['co'] = true;  // créer une variable de session qui affirme que la personne a le droit d'accès à la page membre
			header("Location: membre.php"); // redirige vers la page membre
			exit;
		}
	} else {  // si non redirige vers la page de login
		header("Location: login.php");
		exit;
	}
?>