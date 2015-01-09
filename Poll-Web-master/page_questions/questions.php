<?php
    require_once('php/redirect.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"></meta>
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
                <div class="panel-heading"><h3 class="panel-title">Questionnaire : <?php echo get_operation($_GET['operation'])['nom']; ?> </h3></div>
                <div class="panel-body">

                    <div id="btn-centre">
                        <div class="btn-group" role="group" aria-label="...">
                          <button type="button" class="btn btn-default" id="robot_masse">Activation du robot<br><em>Génération automatique</em></button>
                        </div>

                        <div class="btn-group" role="group" aria-label="...">
                            <button type="button" class="btn btn-default" data-toggle="modal" id="reinit_quest" data-target="#modal_suppr_messages">Réinitialiser la question<br><em>Supprime les messages</em></button>
                            
                            <div class="modal fade" id="modal_suppr_messages">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title">Réinitialisation de la question</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Supprimer tous les messages pour cette question ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" id="suppression_question" data-dismiss="modal">Oui</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon" id="input_texte_question">
                            Question
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="btn-question">
                                <span class="caret" id="caret_question"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" id="ajax_dropdown">
                                <?php create_dropdown($_GET['operation']); ?>
                            </ul>
                        </span>
                        
                        <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1" name="question_texte" id="question_texte" value="">
                        
                        <span class="input-group-addon" id="modification_texte_question">
                            <div class="btn-group" role="group" aria-label="..." title="Valider le changement de nom" id="ajax_modif_nom">
                                <?php create_input("button", "validation_modification", "modal_nom_question"); ?>
                            </div>
                            
                            <div class="modal fade" id="modal_nom_question">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title">Changement de nom</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Changer le nom de la question ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" id="changement_nom" data-dismiss="modal">Oui</button>
                                            <button type="button" class="btn btn-danger" id="conservation_nom" data-dismiss="modal">Non</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="btn-group" role="group" aria-label="..." title="Supprimer la question" id="ajax_suppr_quest">
                                <?php create_input("button", "effacer_question", "modal_suppr_question"); ?>
                            </div>
                            
                            <div class="modal fade" id="modal_suppr_question">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title">Supprimer la question</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Supprimer la question ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" id="valid_effacer_question" data-dismiss="modal">Oui</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Non</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                    
                    <div class="input-group" id="info_question">
                        <span class="input-group-addon informations_question"> 
                            <br><div>Numéro</div><br>
                            <span id="ajax_modif_num">
                                <?php create_input("input", "input_num_question"); ?>
                            </span>

                            <div class="btn-group" role="group" aria-label="..." title="Valider le changement de numero" id="ajax_num_btn">
                                <?php create_input("button", "validation_numero", "modal_num_question"); ?>
                            </div>
                            
                            <div class="modal fade" id="modal_num_question">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h4 class="modal-title">Modification du numéro de la question</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Changer le numéro de la question ?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" id="valid_change_num_question" data-dismiss="modal">Oui</button>
                                            <button type="button" class="btn btn-danger" id="conservation_num" data-dismiss="modal">Non</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                
                        <span class="input-group-addon informations_question">
                            Question fermée<br><br>
                            <input type="checkbox" aria-label="..." id="input_close_question">
                        </span>
                        
                        <span class="input-group-addon informations_question" id="ajax_multi_quest">
                            Réponses multiples<br><br>
                            <input type="checkbox" aria-label="..." id="input_multi_question">
                            <input type="checkbox" aria-label="..." disabled id="input_multi_question_hidden">
                        </span>
                    </div>
                    
                    <div class="input-group">
                        <span class="input-group-addon" id="ajouter-question">
                            <div class="btn-group" role="group" aria-label="...">
                                <button type="button" class="btn btn-default" id="btn-ajouter-question">Ajouter une question</button>
                            </div>
                        </span>
                    </div>

                    <br/>
                    <div class="panel-group" id="accordion_envoi" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default" id="panel_envoi">
                            <div class="panel-heading" role="tab" id="heading_envoi">
                                <h3 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion_envoi" href="#collapse_envoi" aria-expanded="true" aria-controls="collapse_envoi">
                                        Envoi d'un message
                                    </a>
                                </h3>
                            </div>
                            <div id="collapse_envoi" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_envoi">
                                <div class="panel-body">

                                        <div class="input-group">
                                            <span class="input-group-addon" id="input_telephone">Téléphone</span>
                                            <input type="text" class="form-control" placeholder="+33612345678" aria-describedby="basic-addon1" name="num_tel" id="num_tel" value="">
                                        </div>
                                        <br/>
                                        <div class="input-group">
                                            <span class="input-group-addon" id="input_texte_sms">Texte SMS</span>
                                            <input type="text" class="form-control" placeholder="1A" aria-describedby="basic-addon1" name="texte" id="texte" value="">
                                        </div>
                                        <br/>
                                        <div class="btn-group" role="group" aria-label="...">
                                          <button type="button" class="btn btn-default" id="robot_unitaire">Envoyer</button>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default" id="panel_resultats">
                        <div class="panel-heading" role="tab" id="heading_resultats">
                            <h3 class="panel-title">
                                Résultats
                            </h3>
                        </div>

                        <div class="panel-body">

                            <div class="panel panel-default" id="panel_bar">
                                <div class="panel-body" id="ajax_bar">

                                </div>
                            </div>

                            <div class="panel panel-default" id="panel_table">
                                <div class="panel-body">
                                    <div class="btn-group" role="group" aria-label="..." id="categories_messages_boutons">
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
                                                <th style="text-align:center;"><button type="button" disabled="disabled" class="btn btn-default">Téléphone</button></th>
                                                <th style="text-align:center;"><button type="button" disabled="disabled" class="btn btn-default">Message</button></th>
                                                <th style="text-align:center;"><button type="button" class="btn btn-default" id="btn_reception">Réception</button></th>
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
        <script src="../bootbox/bootbox.min.js"></script>
        <script src="../bootstrap-table/dist/js/bootstrap-table.min.js"></script>
        <script src="js/questions.js"></script>
    </body>
</html>