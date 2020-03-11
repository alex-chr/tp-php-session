<?php
	echo "page membre<br/>";

	require_once "connexion_bdd.php"; // connecte à la bdd

	if (isset($_POST['com'])) {  // si la personne a appuyé sur le bouton supprimer
		$del = $bdd->prepare("DELETE FROM `commentaires` WHERE `textCom`=:var1"); // envoie une requête SQL pour supprimer le commentaire
		$del->bindValue('var1', $_POST['com'], PDO::PARAM_STR);
		$del->execute();
		$del->closeCursor();
	}

	if (isset($_POST['comModif']) and isset($_POST['id'])) {  // si la personne a appuyé sur le bouton modifier
		$update = $bdd->prepare("UPDATE `commentaires` SET `textCom`=:var1 WHERE `idCommentaires`=:var2");
		$update->bindValue('var1', $_POST['comModif'], PDO::PARAM_STR);
		$update->bindValue('var2', $_POST['id'], PDO::PARAM_STR);
		$update->execute();  // envoie une requête SQL pour modifier le commentaire avec la valeur de l'input
		$update->closeCursor();
	}

	session_start();  // lance la session

	if ($_SESSION['co'] == true) {  // vérifie que la personne à le droit d'accès à cette page
		if (isset($_SESSION['compteur'])) { // si la variable de section pour compter existe déjà
			$_SESSION['compteur']++; // alors cette variable va gagner +1
		} else {
			$_SESSION['compteur'] = 1; // si non elle la définit à 1
		}

		// Affiche les données de la section
		echo "Bonjour ".$_SESSION['login'];
		echo "<br/>Vous êtes venu ".$_SESSION['compteur']." fois sur cette page.<br/><br/>Commentaires :<br/>";

		// envoie une requête SQL qui va chercher les commentaires de l'utilisateur
		$select = $bdd->prepare("SELECT `textCom`,`idCommentaires` FROM `commentaires` WHERE commentaires.utilisateur_pseudo=:var1 ");
		$select->bindValue('var1', $_SESSION['login'], PDO::PARAM_STR);
		$select->execute();
		while ($donnee = $select->fetch()) { // pour chaque ligne de donnée récupérée
			echo "<form style='display: inline' method='POST' action='membre.php'>
					<input style='display: none' name='id' value='".$donnee['idCommentaires']."'>
					<input type='text' name='comModif' value='".$donnee['textCom']."'>
					<button>Modifier</button>
				</form>"; // affiche le com dans un input pour le modifier
			echo " <form style='display: inline' method='POST' action='membre.php'>
						<input style='display: none' name='com' type='text' value='".$donnee['textCom']."'/>
						<button>Supprimer</button>
					</form><br/>"; // affiche le bouton pour supprimer le com
		}
		$select->closeCursor();

		echo "<br/>
			<a href='deconnexion.php'>Déconnexion !</a>"; // affiche le bouton de déconnexion
	} else {  // si la personne n'a pas accès la redirige
		header('Location: login.php');
	}

?>