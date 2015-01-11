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
			require_once('../php/connexion.php');
			require_once('../php/fonctions.php');
            require('../menu.php');
            gen_menu('accueil');
        ?>
        
		<div id="background_panel">
            <div class="panel panel-primary" id="center_panel">
                <div class="panel-heading" id="operation_heading"><h3 class="panel-title">Liste des questionnaires</h3></div>
				<div class="panel-body" id="operation_body">
                    <div id="ajax_page_questionnaire">
                    <?php Affichepage(); ?>
                    </div>
				</div>
			</div>
		</div>
		  
		<script src="../bootstrap/dist/js/jquery.min.js"></script>
        <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../bootstrap-table/dist/js/bootstrap-table.min.js"></script>
        <script src="../bootbox/bootbox.min.js"></script>
        <script src="js/fonctions.js"></script>
		<script src="js/passage_get.js"></script>
		
	</body>
</html>
