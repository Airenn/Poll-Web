<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8"/>
		<title>Poll</title>
		<link rel="stylesheet" type="text/css" href="css/accueil.css"/>
        <link href="../menu.css" rel="stylesheet">

        <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap-table/dist/css/bootstrap-table.min.css" rel="stylesheet" >
	</head>
	<body>
	
		<?php
			require('php/connexion.php');
			require('php/fonctions.php');
            require('../menu.php'); 
            gen_menu('accueil');
        ?>
        
		<div id="background">
			<input id="create" type="button" value="Créer Questionnaires" />
			<input id="import" type="button" value="Importer Questionnaire" />
            <div id="liste">
			     <div id="titre" ><span>Questionnaires</span><span>Options</span></div>
    
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
		  </div>
		  
		  
		<script src="../bootstrap/dist/js/jquery.min.js"></script>
        <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../bootstrap-table/dist/js/bootstrap-table.min.js"></script>
        <script src="js/fonctions.js"></script>
		<script src="js/passage_get.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	</body>
</html>