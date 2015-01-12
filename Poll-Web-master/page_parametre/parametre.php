<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/page-parametre.css"/>
        <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap-table/dist/css/bootstrap-table.min.css" rel="stylesheet" >
       
        <link href="../menu.css" rel="stylesheet">

        <title>Paramètre (Provisoire)</title>
    </head>

    <body>
        <?php
            session_start();
            require('php/fonctions.php');
            require('../menu.php');
            require('php/parametre.php');
        ?>

        <nav>
        <?php
            gen_menu('parametre');
        ?>
        </nav>
        
            
        <div id="tout-formulaire">
            <form method="post">

            <div id="background_panel">
                <div class="panel panel-default center-panel" id="panel-texte">
                    <div class="panel-heading" id="head-texte">
                        <h3 class="panel-title">Formatage de texte</h3>
                    </div>

                    <div class="panel-body" id="body-texte">

                       <div class="btn-group btn-group-justified" role="group" data-toggle="buttons" style="width:100%;">
                            <label class="btn btn-info active" id="question-bouton">
                                <input type="radio" name="radio-f-d-t" autocomplete="off" value="question" onchange="hide_and_seek('#div-mess,#div-phone,#form_r,#form_m,#form_p','#form_q');" checked/> Question
                            </label>
                            <label class="btn btn-info" id="reponses-bouton">
                                <input type="radio" name="radio-f-d-t" autocomplete="off" value="reponse" onchange="hide_and_seek('#div-mess,#div-phone,#form_q,#form_m,#form_p','#form_r');"/> Réponses
                            </label>
                            <label class="btn btn-info" id="paragraphe-bouton">
                                <input type="radio" name="radio-f-d-t" autocomplete="off" value="paragraphe" onchange="hide_and_seek('#div-mess,#form_q,#form_m,#form_r','#div-phone,#form_p');"/> Paragraphe
                            </label>
                            <label class="btn btn-info" id="nb-messages-bouton">
                                <input type="radio" name="radio-f-d-t" autocomplete="off" value="nbmess" onchange="show_div_mess(); hide_and_seek('#form_q,#form_r,#form_p','#form_m');"/> Nombre de messages
                            </label>
                        </div>




                         <div id="div-mess" style="display:none;width:70%;" class="input-group">
                            <span class="input-group-addon" style="border:1px solid #cccccc;"> 
                                Afficher le nombre de messages<br/><br/>
                                <input id="nbmessages" type="checkbox" name="checkbox" onchange="hide_checkbox('#nbmessages','#form_m');" checked="on">
                            </span>
                        </div>


                        <div id="div-phone" style="display:none;width:70%;" class="input-group">
                            <span class="input-group-addon" style="border:1px solid #cccccc;">
                                Numéro de téléphone<br/><br/>
                                <div style="width:200px;margin-left:auto;margin-right:auto;">
                                    <div>
                                        <input style="text-align:center;width:200px;border-top-left-radius:4px;border-top-right-radius:4px;border-bottom-left-radius:4px;border-bottom-right-radius:4px;" id='numtel' type='text' name='tel' class="form-control" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </span>
                        </div>




                        <span id="form_q"> <?php formulaire_couleur("form_question") ?> </span>

                        <span id="form_r" style="display:none;"> <?php formulaire_couleur("form_reponse") ?> </span>

                        <span id="form_m" style="display:none;"> <?php formulaire_couleur("form_nbmess") ?> </span>

                        <span id="form_p" style="display:none;"> <?php formulaire_couleur("form_paragraphe") ?> </span>


                        <span class="input-group-addon" style="border-radius:0;border:1px solid #cccccc;">
                            <div class="span6" style="text-align:center;">
                                <button type="submit" class="btn btn-info">Sauvegarder</button>
                            </div>
                        </span>

                    </div>

                </div>
            </form><br/><br/>


            <form method="post" enctype="multipart/form-data">
                <div class="panel panel-default center-panel" id="panel-arriere-plan">
                    <div class="panel-heading" id="head-arriere-plan">

                        <h3 class="panel-title">Arrière-plan &#38; Barres progressives</h3>
                    </div>



                    <div class="panel-body" id="body-arriere-plan">

                        <div id="block-a-p-b-p" class="center-block">
                            <div id="radio-a-p-b-p" class="btn-group btn-group-justified" role="group" data-toggle="buttons" style="width:100%;">
                                <label class="btn btn-info active" id="arriere-plan-bouton">
                                    <input type="radio" name="radio-a-b" autocomplete="off" value="arriere-plan" onchange="hide_and_seek('#barre-progressive','#arriere-plan');" checked="on"/> Arrière-plan
                                </label>
                                <label class="btn btn-info" id="barres-bouton">
                                    <input type="radio" name="radio-a-b" autocomplete="off" value="barre-progressive" onchange="hide_and_seek('#arriere-plan','#barre-progressive');"/> Barres progressives
                                </label>
                            </div>
                        </div>



                        <div id="arriere-plan">

                            <div id="choix_arriere_plan" class="input-group">
                                <span class="input-group-addon" style="border:1px solid #cccccc;border-bottom:none;"> 
                                    <strong>Type d'arrière-plan</strong><br/><br/>

                                    <label>Couleur <input type="radio" name="radio-a" value="color" onchange="hide_and_seek('#background-image','#background-color');" checked="on"/>
                                    </label><br/>
                                    <label> Image <input type="radio" name="radio-a" value="image" onchange="hide_and_seek('#background-color','#background-image');"/>
                                    </label><br/>
                                </span>
                            </div>


                            <div id="background-color">
                                <span class="input-group-addon" style="border:solid 1px #cccccc;border-top:none;"> 
                                    <input style="width:30%;" type="color" class="form-control center-block" aria-describedby="basic-addon1" name="arriere-plan-color">
                                </span>
                            </div>

                            <div id="background-image" style="display:none;">
                                <span class="input-group-addon" style="border:solid 1px #cccccc;border-top:none;">
                                    <div style="width:25%;margin-left:auto;margin-right:auto;">
                                        <div>
                                            <input type="file" name="file" ng-disabled="disabled" accept="image/x-png, image/gif, image/jpeg"/>
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>

                        <div id="barre-progressive" style="display:none;">
                            <div id="choix_barre_progressive">
                                <span class="input-group-addon" style="border:1px solid #cccccc;"> 
                                    Couleur de la barre progressive<br/><br/>
                                    <input style="width:30%;" type="color" class="form-control center-block" aria-describedby="basic-addon1" name="bar-color"/>
                                </span>
                            </div>

                            <span class="input-group-addon" style="border:1px solid #cccccc;border-bottom:none;"> 
                                Afficher le hors délai<br/><br/>
                                <input id="offline-checkbox" type="checkbox" name="hors-delai" onchange="hide_checkbox('#offline-checkbox','#offline-color');">
                            </span>

                            <div>
                                <span class="input-group-addon" style="border:1px solid #cccccc;border-top:none;"> 
                                    <div id="offline-color" style="display:none;">
                                    Couleur de la barre hors délai<br/><br/>
                                    <input style="width:30%;" type="color" class="form-control center-block" aria-describedby="basic-addon1" name="offline-color"/>
                                    </div>
                                </span>
                            </div>
                        </div>

                        <span class="input-group-addon" id="save_barres" style="border-radius:0;border:1px solid #cccccc;">
                            <div class="span6" style="text-align:center;">
                                <button type="submit" class="btn btn-info">Sauvegarder</button>
                            </div>
                        </span>
                    </div>
                </div>
                </div>
            </form>
        </div>


        <div id="remote">
            <button type="button" class="btn btn-default disabled" id="bouton-reponse" data-toggle="button" aria-pressed="false" autocomplete="off">
                    Afficher réponses
            </button>
            <button type="button" class="btn btn-default btn-lg disabled" id="bouton-left">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </button>
            <button type="button " class="btn btn-default btn-lg disabled" id="bouton-result">
                <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
            </button>
            <button type="button" class="btn btn-lg" id="bouton-right">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            </button>
        </div>
            
            
       
        <script src="../bootstrap/dist/js/jquery.min.js"></script>
        <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../bootstrap-table/dist/js/bootstrap-table.min.js"></script>
        <script src="js/fonctions.js"></script>
    </body>
</html>