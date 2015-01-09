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
			require_once('php/connexion.php');
			require_once('php/fonctions.php');
            require('../menu.php'); 
            require_once('../page_questions/php/fonctions.php'); 
            gen_menu('accueil');
        ?>
        
		<div id="background_panel">
            <div class="panel panel-default" id="center_panel">
                <div class="panel-heading"><h3 class="panel-title">Liste des questionnaires</h3></div>
				<div class="panel-body">
					<div id="background">
						<input id="create" type="button" class="btn btn-default" value="Créer Questionnaires" />
						<input id="import" type="button" class="btn btn-default" value="Importer Questionnaire" />
						<div id="selected_question">
							<span id="titre_questionnaire_selected">Questionnaire selectionné : </span>
							<span id="id_questionnaire_selected">aucun</span>
						</div>						
						<div id="liste">
							<div id="titre" ><span>Nom</span><span>Date prevu</span><span>Options</span></div>

								<?php
									AfficheQuestionnaires();
								?>
								
						</div>
					</div>
				</div>
			</div>
		</div>
		  
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>  
		<script src="../bootstrap/dist/js/jquery.min.js"></script>
        <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../bootstrap-table/dist/js/bootstrap-table.min.js"></script>
        <script src="../bootbox.min.js"></script>
        <script src="js/fonctions.js"></script>
		<script src="js/passage_get.js"></script>
		
	</body>
</html>