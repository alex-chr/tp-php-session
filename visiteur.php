<?php
	echo "page visiteur <br/>";

	require_once "connexion_bdd.php";

	session_start();

	if (isset($_SESSION['login'])) {

		$req = $bdd->prepare("SELECT COUNT(*) AS nbrow FROM utilisateurs WHERE utilisateurs.pseudo=:var1");
		$req->bindValue('var1', $_SESSION['login'], PDO::PARAM_STR);
		$req->execute();
		$rep = $req->fetch();
		$req->closeCursor();

		if ($rep['nbrow'] == 0) {
			echo "Le pseudo saisi n’existe pas.<br/>";
		} else {
			echo "Le mot de passe saisi n’est pas correct.<br/>";
		}

		echo "<br/>Bonjour ";
		echo $_SESSION['login'];
		echo "<br/><br/>";
		echo "
		<form onsubmit='return verifMail()' method='post' action='inscription.php'>
			<label>Pseudo : </label>
			<input type='text' name='psd' require>
			<br/>
			<label>Mail : </label>
			<input type='text' name='mail' require>
			<br/>
			<label>Mot de passe : </label>
			<input type='text' name='pass' require>
			<br/>
			<button>Valider</button>
		</form>
		<br/><br/>
		<div style='color : red'></div>";

	} else {
		header("Location: login.php");
		exit;
	}
?>

<script type="text/javascript" src="examinerMail.js"></script>