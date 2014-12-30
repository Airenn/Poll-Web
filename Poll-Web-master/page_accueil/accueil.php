<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8"/>
		<title>Poll</title>
		<link rel="stylesheet" type="text/css" href="css/accueil.css"/>
		<link rel="stylesheet" href="../page_parametre/css/page-parametre.css"/>
		<link rel="stylesheet" href="../page_parametre/css/bootstrap.css"/>
		<link rel="stylesheet" href="../page_parametre/css/bootstrap.min.css"/>
        <link href="../menu.css" rel="stylesheet">

		<script src="../page_parametre/js/jquery.js"></script>
		<script src="../page_parametre/js/bootstrap.min.js"></script>
		<script src="../page_parametre/js/jquery.easing.min.js"></script>
		<script src="../page_parametre/js/classie.js"></script>
		<script src="../page_parametre/js/fonctions.js"></script>
	</head>
	<body>
	
		<?php
			require('php/connexion.php');
			require('php/fonctions.php');
            require('../menu.php'); 
            gen_menu('accueil');
        ?>
        
		<div id="liste">
			<input id="create" type="button" value="Créer Questionnaires" />
			<input id="import" type="button" value="Importer Questionnaire" />
			<div><span>Questionnaires</span><span>Options</span></div>
    
	<!--
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
              Questionnaire n°1
            </a>
          </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">-->
            <?php
                AfficheQuestionnaires();
            ?>
		<!--
        </div>
      </div>
    </div>-->
		</div>
	</body>
</html>