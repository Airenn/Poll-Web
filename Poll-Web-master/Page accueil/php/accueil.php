<html>
<head>
    <meta charset="utf-8"/>
    <title>Poll</title>
	<link rel="stylesheet" type="text/css" href="../css/accueil.css"/>
    <link rel="stylesheet" href="../../page-parametre/css/page-parametre.css"/>
    <link rel="stylesheet" href="../../page-parametre/css/bootstrap.css"/>
    <link rel="stylesheet" href="../../page-parametre/css/bootstrap.min.css"/>

    <script src="../../page-parametre/js/jquery.js"></script>
    <script src="../../page-parametre/js/bootstrap.min.js"></script>
    <script src="../../page-parametre/js/jquery.easing.min.js"></script>
    <script src="../../page-parametre/js/classie.js"></script>
    <script src="../../page-parametre/js/fonctions.js"></script>
</head>

    <?php
		require('connexion.php');
		require('fonctions.php');
    ?>
	
	<div id="title"><h1>Poll</h1></div>
	
	<div id="menu">
		<ul>
			<li><a href="accueil.php" title="Liste de tous les questionnaires">Questionnaires</a></li>
			<li><a href="../../page_questions/php/questions.php" title="Afficher/modifier les questions de votre questionnaire">Questions</a></li>
			<li><a href="../../page-parametre/page-parametre.php" title="Paramétrer vos questionnaires">Paramètres</a></li>
		</ul>
	</div>
        
    <div id="liste">
			<input id="create" type="button" value="Créer Questionnaires" />
			<input id="import" type="button" value="Importer Questionnaire" />
			<!--<div><span>Questionnaires</span><span>Options</span></div>-->
    </div>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              Questionnaire n°1
            </a>
          </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <?php
                AfficheQuestionnaires();
            ?>
        </div>
      </div>
    </div>  

</html>