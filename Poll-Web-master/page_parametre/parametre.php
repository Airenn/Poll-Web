<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/page-parametre.css"/>
        <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap-table/dist/css/bootstrap-table.min.css" rel="stylesheet" >
       
        <link href="../menu.css" rel="stylesheet">
        <script src="js/fonctions.js"></script>

        <title>Paramètre (Provisoire)</title>
    </head>

    <body>
        <?php
            session_start();
            require('php/fonctions.php');
            require('../menu.php'); 
        ?>
<div id="container">
        <nav>
        <?php
            gen_menu('parametre');
        ?>
        </nav>
        
        <section class="pair" id="couleur">
            <h1>Formatage de texte</h1>
            <form method="post">
                
           <div class="btn-group btn-group-justified" role="group" data-toggle="buttons">
                <label class="btn btn-primary active" style="border-bottom-left-radius:0;">
                    <input type="radio" name="radio-f-d-t" autocomplete="off" value="question" onchange="hide_and_seek('#div-mess,#div-phone,#form_r,#form_m,#form_p' ,'#form_q');" checked="on"/> Question
                </label>
                <label class="btn btn-primary">
                    <input type="radio" name="radio-f-d-t" autocomplete="off" value="reponse" onchange="hide_and_seek('#div-mess,#div-phone,#form_q,#form_m,#form_p','#form_r');"/> Réponses
                </label>
                <label class="btn btn-primary">
                    <input type="radio" name="radio-f-d-t" autocomplete="off" value="paragraphe" onchange="hide_and_seek('#div-mess,#form_q,#form_m,#form_r','#div-phone,#form_p');"/> Paragraphe
                </label>
                <label class="btn btn-primary" style="border-bottom-right-radius:0;">
                    <input type="radio" name="radio-f-d-t" autocomplete="off" value="nbmess" onchange="show_div_mess(); hide_and_seek('#form_q,#form_r,#form_p','#form_m');"/> Nombre de messages
                </label>
            </div>
                    
                
                <div id="tout-formulaire">

                     <div id="div-mess" style="display:none;" class="input-group">
                        <span class="input-group-addon"> 
                            Afficher le nombre de messages<br/><br/>
                            <input id="nbmessages" type="checkbox" name="checkbox" onchange="hide_checkbox('#nbmessages','#form_m');" checked="on">
                        </span>
                    </div>


                    <div id="div-phone" style="display:none;width:1100px;" class="input-group">
                        <span class="input-group-addon"> 
                            Numéro de téléphone<br/><br/>
                            <input id='numtel' type='text' name='tel'>
                        </span>
                    </div>




                    <span id="form_q"> <?php formulaire_couleur("form_question") ?> </span>

                    <span id="form_r" style="display:none;"> <?php formulaire_couleur("form_reponse") ?> </span>

                    <span id="form_m" style="display:none;"> <?php formulaire_couleur("form_nbmess") ?> </span>

                    <span id="form_p" style="display:none;"> <?php formulaire_couleur("form_paragraphe") ?> </span>


                    <span class="input-group-addon" style="border-bottom-left-radius:4px;border-top-right-radius:0;">
                        <div class="span6" style="text-align:center;">
                            <button type="submit" class="btn btn-default">Sauvegarder</button>
                        </div>
                    </span>
                    
                </div>
                
            </form>
            
            
            <div id="remote">
                <button type="button" class="btn btn-default btn-lg" id="bouton-left">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                </button>
                <button type="button" class="btn btn-default btn-lg" id="bouton-result">
                    <span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
                </button>
                <button type="button" class="btn btn-default btn-lg" id="bouton-right">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                </button>
            </div>
            
            
            <div class="div-button-section">
            </div>
        </section>
        <section id="background">
            <h1>Arrière-plan et barres progressives</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="btn-group-justified" role="group" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        <input type="radio" name="radio-a-b" autocomplete="off" value="arriere-plan" onchange="hide_and_seek('#barre-progressive','#arriere-plan');" checked="on"/>    Arrière-Plan
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="radio-a-b" autocomplete="off" value="barre-progressive" onchange="hide_and_seek('#arriere-plan','#barre-progressive');"/>       Barres progressives
                    </label>
                </div>
                <div id="arriere-plan">
                    <p> Type d'arrière plan : 
                        <label> Couleur :    <input type="radio" name="radio-a" value="color" onchange="hide_and_seek('#background-image','#background-color');" checked="on"/>     </label>
                        <label> Image :      <input type="radio" name="radio-a" value="image" onchange="hide_and_seek('#background-color','#background-image');"/>     </label><br/>
                        <label id="background-color">Couleur de l'arrière-plan :    <input type="color" name="arriere-plan-color"/>    </label>
                        <label id="background-image" style="display:none;">Image de l'arrière-plan : <input type="file" name="file" ng-disabled="disabled" accept="image/x-png, image/gif, image/jpeg"/>
                    </label>
                    </p>
                </div>
                <div id="barre-progressive" style="display:none;">
                    <label>Couleur de la barre progressive :    <input type="color" name="bar-color"/>              </label><br/>
                    <label>Afficher le hors-délai :             <input id="offline-checkbox" type="checkbox" name="hors-delai" onchange="hide_checkbox('#offline-checkbox','#offline-color');"/></label><br/>
                    <label id="offline-color" style="display:none;">Couleur de la barre hors-délai :<input type="color" name="offline-color"/><br/></label>
                </div>
                <input type="submit" name="button" value="Sauvegarder"/>
            </form>
        </section>
        
        <?php
            require('php/parametre.php');
        ?>
</div>        
         <script src="../bootstrap/dist/js/jquery.min.js"></script>
        <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../bootstrap-table/dist/js/bootstrap-table.min.js"></script>
        <script src="js/fonctions.js"></script>
    </body>
</html>