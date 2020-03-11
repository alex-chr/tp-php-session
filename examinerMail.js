var inputValue = []; // créer une variable en tableau
function verifMail() {

	// remplit le tableau avec les valeurs des input rentrer dans le formulaire
	for (var i = 0; i < 3; i++) {
		inputValue[i] = document.getElementsByTagName('input')[i].value;
	}
	
	// vérifie que toute les variable sont remplit
	if (inputValue['0'] != "" && inputValue['1'] != "" && inputValue['2'] != "") {
		if (inputValue['1'].includes(".com") == true && inputValue['1'].includes("@") == true ) { // vérifie que dans l'input du mail est inclu le @ et le .com
			return true; // return true pour valider l'envoie du formulaire
		} else {
			document.getElementsByTagName('div')['0'].innerHTML = "L’adresse mail n’est pas correcte"; // si non renvoie un message d'erreur
			return false; // renvoie false pour ne pas envoyer le formulaire
		}
	} else {
		document.getElementsByTagName('div')['0'].innerHTML = "Le formulaire n'est pas entièrement complété";
		return false;
	}
}