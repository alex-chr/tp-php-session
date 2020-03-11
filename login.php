<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<body>

	<!-- Formulaire de connexion -->
	<form method="post" action="traitement.php">
		<label>Pseudo : </label>
		<input type="text" name="pseudo" required>
		<br/>
		<label>Mot de passe : </label>
		<input type="password" name="mdp" required>
		<br/>
		<button type="submit">Valider</button>
	</form>
</body>
</html>