<?php
    $_GET['operation'] = 2;
    require_once('php/redirect.php');

    $questions = get_questions($_GET['operation']);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Questions</title>
        <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap-table/dist/css/bootstrap-table.min.css" rel="stylesheet" >
        <link href="../menu.css" rel="stylesheet">
        <link href="css/questions.css" rel="stylesheet">
    </head>
    
    <body>
        
        <?php 
            require('../menu.php'); 
            gen_menu('questions');
        ?>
        <div id="background_panel">
            <div class="panel panel-default" id="center_panel">
                <div class="panel-body">
                    <div class="btn-group" id="btn-gauche">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="btn-question">
                            <em>Choix de la question</em><br><span class="caret" id="caret_question"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <?php create_dropdown($questions); ?>
                        </ul>
                    </div>

                    <div id="btn-droite">
                        <div class="btn-group" role="group" aria-label="...">
                          <button type="button" class="btn btn-default" id="robot_masse">Activation du robot<br><em>Génération automatique</em></button>
                        </div>
                        
                        <div class="btn-group" role="group" aria-label="...">
                            <button type="button" class="btn btn-default" id="ferme_question">Clôturer la question<br><em>Votes entrants en retard</em></button>
                        </div>

                        <div class="btn-group" role="group" aria-label="...">
                            <button type="button" class="btn btn-default" id="suppression_question">Réinitialiser la question<br><em>Supprime les messages</em></button>
                        </div>
                    </div>


                    <br/><br/>
                    <div class="panel panel-default" id="panel_envoi">
                        <div class="panel-heading"><h3 class="panel-title">Envoi d'un message</h3></div>
                        <div class="panel-body">

                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Téléphone</span>
                                    <input type="text" class="form-control" placeholder="+33612345678" aria-describedby="basic-addon1" name="num_tel" id="num_tel" value="">
                                </div>
                                <br/>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Texte SMS</span>
                                    <input type="text" class="form-control" placeholder="1A" aria-describedby="basic-addon1" name="texte" id="texte" value="">
                                </div>
                                <br/>
                                <div class="btn-group" role="group" aria-label="...">
                                  <button type="button" class="btn btn-default" id="robot_unitaire">Envoyer</button>
                                </div>

                        </div>
                    </div>

                    <div class="panel panel-default" id="panel_resultats">
                        <div class="panel-heading"><h3 class="panel-title">Résultats</h3></div>
                        <div class="panel-body">

                            <div class="panel panel-default" id="panel_bar">
                                <div class="panel-body" id="ajax_bar">

                                </div>
                            </div>

                            <div class="panel panel-default" id="panel_table">
                                <div class="panel-body">
                                    <div class="btn-group" role="group" aria-label="...">
                                        <button type="button" class="btn btn-default messages_categ" id="Tout">Tout</button>
                                        <button type="button" class="btn btn-success messages_categ" id="Valide">Valide</button>
                                        <button type="button" class="btn btn-primary messages_categ" id="Doublon">Doublon</button>
                                        <button type="button" class="btn btn-danger messages_categ" id="Erreur">Erreur</button>
                                        <button type="button" class="btn btn-warning messages_categ" id="Retard">Retard</button>
                                    </div>
                                    <br/><br/>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;"><button type="button" disabled="disabled" class="btn btn-default">Numéro de téléphone</button></th>
                                                <th style="text-align:center;"><button type="button" disabled="disabled" class="btn btn-default">Message</button></th>
                                                <th style="text-align:center;"><button type="button" class="btn btn-default" id="btn_reception">Date de réception</button></th>
                                            </tr>
                                        </thead>
                                        <tbody id="ajax_table">

                                        </tbody>
                                    </table>
                                    <div id="ajax_pagination">
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <script src="../bootstrap/dist/js/jquery.min.js"></script>
        <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../bootstrap-table/dist/js/bootstrap-table.min.js"></script>
        <script src="js/questions.js"></script>
    </body>
</html>