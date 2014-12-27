<html>
<head>
    <meta charset="utf-8"/>
    <title>Poll</title>
	<link rel="stylesheet" type="text/css" href="css/accueil.css"/>
</head>

    <?php
		require('connexion.php');
    ?>
	
	<div id="title"><h1>Poll</h1></div>
	
	<div id="menu">
		<ul>
			<li><a href="acceuil.php" title="Liste de tous les questionnaires">Questionnaires</a></li>
			<li><a href="questions.php" title="Afficher/modifier les questions de votre questionnaire">Questions</a></li>
			<li><a href="page-paramètre.php" title="Paramétrer vos questionnaires">Paramètres</a></li>
		</ul>
	</div>
		
	<div id="liste">Questionnaires</div>

</html>