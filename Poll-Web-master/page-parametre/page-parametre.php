<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/page-parametre.css"/>
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/classie.js"></script>
        <script src="js/fonctions.js"></script>

</head>
        <title>Paramètre (Provisoire)</title>
    </head>

    <body>
        <?php
            session_start();
            require('php/fonctions.php');
        ?>
        <nav>
            <a class="lien-entete" href="#">Nom du QCM</a>
            <ul>
                <li class="liste-entete">
                    <a class="lien-entete" href="page-public.php" target="_blank">Afficher la page public</a>
                </li>
                <li class="liste-entete">
                    <a class="lien-entete" href="#arriere-plan">Arrière-Plan</a>
                </li>
                <li class="liste-entete">
                    <a class="lien-entete" href="#couleur">Formatage de texte</a>
                </li>
            </ul>
        </nav>
        <section class="pair" id="couleur">
            <h1>Formatage de texte</h1>
            <form method="post">
                
                <div class="btn-group-justified" role="group" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        <input type="radio" name="radio-f-d-t" autocomplete="off" value="question" onchange="hide_and_seek('#div-mess,#div-phone','#div-format');" checked/> Question
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="radio-f-d-t" autocomplete="off" value="reponse" onchange="hide_and_seek('#div-mess,#div-phone','#div-format');"/> Réponses
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="radio-f-d-t" autocomplete="off" value="paragraphe" onchange="hide_and_seek('#div-mess','#div-format,#div-phone');"/> Paragraphe
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="radio-f-d-t" autocomplete="off" value="nbmess" onchange="show_div_mess();"/> Nombre de messages
                    </label>
                </div>
                <div id="div-mess" style="display:none;">
                    <label>Afficher le nombre de message : <input id="nbmessages" type="checkbox" name="checkbox" onchange="hide_checkbox('#nbmessages','#div-format');" checked/></label><br/>
                </div>
                <div id="div-format">
                    <label>Couleur de la police : <input type="color" name="color"/></label><br/>
                    <label>Taille de la police  : <input type="text" name="taille-police"/></label><br/>
                    <label>Choix de la police d'écriture :
                        <select name="police" value="button-police">
                            <option value="Arial">Arial</option>
                            <option value="Arial Black">Arial Black</option>
                            <option value="Comic Sans MS">Comic Sans MS</option>
                            <option value="Courier New">Courier New</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Impact">Impact</option>
                            <option value="Times New Roman">Times New Roman</option>
                            <option value="Trebuchet MS">Trebuchet MS</option>
                            <option value="Verdana">Verdana</option>
                        </select>
                    </label><br/>
                </div>
                <div id="div-phone" style="display:none;">
                    <label>Numéro de téléphone : <input id="numtel" type="text" name="tel"/></label><br/>
                </div>
                    <input type="submit" name="button" value="Sauvegarder"/>
            </form>
            
            
            <div class="div-button-section">
            </div>
        </section>
        <section id="background">
            <h1>Arrière-plan et barres progressives</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="btn-group-justified" role="group" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        <input type="radio" name="radio-a-b" autocomplete="off" value="arriere-plan" onchange="hide_and_seek('#barre-progressive','#arriere-plan');"/>    Arrière-Plan
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="radio-a-b" autocomplete="off" value="barre-progressive" onchange="hide_and_seek('#arriere-plan','#barre-progressive');"/>       Barres progressives
                    </label>
                </div>
                <div id="arriere-plan">
                    <p> Type d'arrière plan : 
                        <label> Couleur :    <input type="radio" name="radio-a" value="color" onchange="hide_and_seek('#background-image','#background-color');" checked/>     </label>
                        <label> Image :      <input type="radio" name="radio-a" value="image" onchange="hide_and_seek('#background-color','#background-image');"/>     </label><br/>
                        <label id="background-color">Couleur de l'arrière-plan :    <input type="color" name="color"/>    </label>
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
    </body>
</html>