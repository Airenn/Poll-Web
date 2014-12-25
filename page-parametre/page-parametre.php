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
        <script src="js/cbpAnimatedHeader.js"></script>

</head>
        <title>Paramètre (Provisoire)</title>
    </head>
    <body>
        <?php
            session_start();
            function text_format($key){
                if(isset($_POST['color']) and isset($_POST['police'])){
                    $_SESSION[$key]['color']=$_POST['color'];
                    $_SESSION[$key]['police']=$_POST['police'];
                }
                if(isset($_POST['taille-police']) and is_numeric($_POST['taille-police']))
                    $_SESSION[$key]['taille-police']=$_POST['taille-police'];              
                elseif(isset($_POST['taille-police']) and trim($_POST['taille-police'])!="")
                                echo "la taille de police saisie n'est pas valide";
            }
        ?>
        <script type="text/javascript">
        </script>
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
                    <a class="lien-entete" href="#couleur">Formattage de texte</a>
                </li>
            </ul>
        </nav>
        <section class="pair" id="couleur">
            <h1>Formattage de texte</h1>
            <form method="post">
                
                <div class="btn-group-justified" role="group" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        <input type="radio" name="radio" autocomplete="off" value="question" checked>Question
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="radio" autocomplete="off" value="reponse"> Réponses
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="radio" autocomplete="off" value="nbmess"> Nombre de messages
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="radio" autocomplete="off" value="paragraphe"> Paragraphe
                    </label>
                </div>
                
                <div id="div-mess" style="display:none;">
                    <label>Afficher le nombre de message : <input type="checkbox" name="chkbx" /></label>
                </div>
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
                
                    <input type="submit" name="button" value="Sauvegarder"/>
            </form>
            <?php
                if($_POST['radio']=='question')
                    text_format('question');
                elseif($_POST['radio']=='reponse')
                    text_format('reponse');
                elseif($_POST['radio']=='nbmess')
                    text_format('nbmess');
                else
                    text_format('paragraphe');
            ?>
            <div class="div-button-section">
            </div>
        </section>
        <section id="background">
            <h1>Background</h1>
        </section>
    </body>
</html>