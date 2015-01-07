

var element = document.getElementById("entrez_question"),
	table_reponses = document.getElementById('table_reponses'),
	boutons = document.getElementById('boutons');

function question() {

	var question= prompt("Entrez votre question : "); 
	
	if(question != null && question != ""){
		
			var saisie = document.form.entrez_question.value = question;
			
	}
	else if(question == null){

			document.form.entrez_question.value = "Entrez votre question ici !";
	}
	else if(question == ""){

			alert("Vous n'avez pas entrer de question");
	}

}
	

function dupliquerLigne(numLigne){
	//idTable: identifiant du tableau
	// numLigne : N° de la ligne à dupliquer
	table_reponses.insertRow(-1);

	for(var i=0; i<table_reponses.rows[numLigne].cells.length; i++){
		table_reponses.rows[table_reponses.rows.length-1].insertCell(-1);
		table_reponses.rows[table_reponses.rows.length-1].cells[i].innerHTML = table_reponses.rows[numLigne].cells[i].innerHTML;
	}
}

boutons.on('click', function () {

	supprimerLigne(this.parentNode.rowIndex);
});

function supprimerLigne(numLigne){

	console.log(numLigne);
	table_reponses.deleteRow(numLigne);

		for(var i = 0; i<table_reponses.rows[numLigne].cells.length; i++){
				table_reponses.rows[table_reponses.rows.length-1].deleteCell(numLigne);
				table_reponses.rows[table_reponses.rows.length-1].cells[i].innerHTML = table_reponses.rows[numLigne].cells[i].innerHTML;
		}

		
}





			
 