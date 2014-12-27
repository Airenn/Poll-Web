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
            require('php/fonctions.php');
            session_start();

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
                    <label class="btn btn-primary">
                        <input type="radio" name="radio-f-d-t" autocomplete="off" value="question" onchange="show_and_hide_div();" checked/>Question
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="radio-f-d-t" autocomplete="off" value="reponse" onchange="show_and_hide_div();"/> Réponses
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="radio-f-d-t" autocomplete="off" value="paragraphe" onchange="show_and_hide_div();"/> Paragraphe
                    </label>
                   <label class="btn btn-primary">
                        <input type="radio" name="radio-f-d-t" autocomplete="off" value="nbmess" onchange="show_div_mess();"/> Nombre de messages
                    </label>
                </div>
                <div id="div-mess" style="display:none;">
                    <label>Afficher le nombre de message : <input id="nbmessages" type="checkbox" name="checkbox-nb-message" value="checked" onchange="hide_div_format();" checked/></label><br/>
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
                    </select> </label><br/>
                </div>
                    <input type="submit" name="button" value="Sauvegarder"/>
            </form>
            <?php
                if(isset($_POST['radio-f-d-t']) and $_POST['radio-f-d-t']=='question')
                    text_format('question');
                elseif(isset($_POST['radio-f-d-t']) and $_POST['radio-f-d-t']=='reponse')
                    text_format('reponse');
                elseif(isset($_POST['radio-f-d-t']) and $_POST['radio-f-d-t']=='nbmess')
                    text_format('nbmess');
                else
                    text_format('paragraphe');
                if(isset($_POST['checkbox-nb-message']) and $_POST['checkbox-nb-message']=='checked')
                    $_SESSION['nbmess']['checkbox-nb-message']=$_POST['checkbox-nb-message'];
            ?>
            <div class="div-button-section">
            </div>
        </section>
        <section id="background">
            <h1>Arrière-plan et barres progressives</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="btn-group-justified" role="group" data-toggle="buttons">
                    <label class="btn btn-primary">
                        <input type="radio" name="radio-a-b" autocomplete="off" value="arriere-plan" onchange="hide_barre_prog();" checked/>    Arrière-Plan
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="radio-a-b" autocomplete="off" value="barre-progressive" onchange="hide_arriere_plan();"/>       Barres progressives
                    </label>
                </div>
                <div id="barre-progressive" style="display:none;">
                    <label>Couleur de la barre progressive :    <input type="color" name="color"/>              </label><br/>
                    <label>Afficher le hors-délai :             <input type="checkbox" name="hors-delai"/>      </label><br/>
                    <label>Animation des barres progressives :  <input type="checkbox" name="barre-animation"/> </label><br/>
                </div>
                <div id="arriere-plan">
                    <p> Type d'arrière plan : 
                        <label> Couleur :    <input type="radio" name="radio-a" value="color" checked/>     </label>
                        <label> Image :      <input type="radio" name="radio-a" value="image"/>     </label><br/>
                        <label>Couleur de l'arrière-plan :    <input type="color" name="color"/>    </label><br/>
                        <span class="btn btn-success fileinput-button" ng-class="{disabled: disabled}">
                                
                            Image de l'arrière-plan : <input type="file" name="file" ng-disabled="disabled" accept="image/x-png, image/gif, image/jpeg">
                        </span>
                    </p>
                </div>
                <input type="submit" name="button" value="Sauvegarder"/>
            </form>
            <?php
                /*************************//**ARRIERE-PLAN**//*************************/
                if(isset($_POST['radio-a-b']) and $_POST['radio-a-b']=='arriere-plan'){
                    if(isset($_POST['radio-a']) and $_POST['radio-a']=="image"){
                        $_SESSION['arriere-plan']['radio-a']="image";
                        if ($_FILES['file']['error'] > 0)
                            echo "Error: " . $_FILES['file']['error'] . "<br/>"; 
                        else
                        { 
                            move_uploaded_file($_FILES["file"]["tmp_name"],"images/".$_FILES["file"]["name"]);
                            $_SESSION['arriere-plan']['file']="images/".$_FILES["file"]["name"];
                        }
                    }
                    elseif(isset($_POST['radio-a']) and $_POST['radio-a']=="color"){
                        $_SESSION['arriere-plan']['radio-a']="color";
                        if(isset($_POST['arriere-plan-color'])){
                            $_SESSION['arriere-plan']['color']=$_POST['arriere-plan-color'];
                        }
                    }
                }
                /*************************//**ARRIERE-PLAN**//*************************/
            ?>
        </section>
    </body>
</html>