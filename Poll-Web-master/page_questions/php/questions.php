<?php
    $_GET['operation'] = 2;
    require_once('redirect.php');

    $questions = get_questions($_GET['operation']);

    if(isset($_GET['num_tel']) && isset($_GET['texte']) && trim($_GET['num_tel'])!="" && trim($_GET['texte'])!=""){
        $message = array();
        $message['num_tel'] = $_GET['num_tel'];
        $message['texte'] = $_GET['texte'];
        sort_message($message);
        unset($_GET);
        header('Location: '.$_SERVER['PHP_SELF']);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Questions</title>
        <link href="../../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../menu.css" rel="stylesheet">
    </head>
    
    <body>
        
        <?php 
            require('../../menu.php'); 
            gen_menu('questions');
        ?>
        
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="btn-question">
                Question <span class="caret" id="caret_question"></span>
            </button>
            <ul class="dropdown-menu" role="menu" id="ajax_drop">
                <?php create_dropdown($questions); ?>
            </ul>
        </div>
        
        <div class="btn-group" role="group" aria-label="...">
          <button type="button" class="btn btn-default" id="robot_masse">Activation du robot<br><em>Génération automatique</em></button>
        </div>
        
        <div class="btn-group" role="group" aria-label="...">
            <button type="button" class="btn btn-default" id="suppression_question">Réinitialiser la question<br><em>Supprime les messages</em></button>
        </div>
        
        <br/><br/>
        <div class="panel panel-default">
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
        
        
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Résultats</h3></div>
            <div class="panel-body">
                
                <div class="panel panel-default">
                    <div class="panel-body" id="ajax_bar">
                        
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-body" id="infos_messages">
                        <div class="btn-group" role="group" aria-label="...">
                            <button type="button" class="btn btn-primary messages" id="all_messages">Tout</button>
                            <button type="button" class="btn btn-success messages" id="valid_messages">Valide</button>
                            <button type="button" class="btn btn-default messages" id="multi_messages">Doublon</button>
                            <button type="button" class="btn btn-danger messages" id="wrong_messages">Erreur</button>
                            <button type="button" class="btn btn-warning messages" id="late_messages">Retard</button>
                        </div>
                        <br/><br/>
                        <table id="ajax_table" class="table">
                            
                        </table>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-body" id="ajax_bot">
                        
                    </div>
                </div>
                
            </div>
        </div>
    
        <script src="../../bootstrap/dist/js/jquery.min.js"></script>
        <script src="../../bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../js/questions.js"></script>
    </body>
</html>