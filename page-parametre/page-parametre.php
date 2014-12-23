<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/page-parametre.css"/>
        <title>Paramètre (Provisoire)</title>
    </head>
    <body>
        <?php
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
                    <a class="lien-entete" href="#police">Police</a>
                </li>
                <li class="liste-entete">
                    <a class="lien-entete" href="#couleur">Couleur</a>
                </li>
            </ul>
        </nav>
        
        <section class="pair" id="couleur">
            <h1>Couleur</h1>
            <form method="post">
                
                <label>Couleur de la police : </label><input type="color" name="color"/> <br/>
                
                <label>Couleur de la police : </label><input type="text" name="taille-police"/><br/>
                
                <label>Choix police d'ecriture : </label>
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
                    </select><br/>
                <input type="submit" name="button" value="Sauvegarder">
            </form>
            <?php
                $_SESSION['color']=$_POST['color'];
                $_SESSION['police']=$_POST['police'];
                if(!isset($_POST['taille-police']) and is_numeric($_POST['taille-police'])){
                    echo "la taille de police saisie n'est pas valide";
                }
                else{
                    $_SESSION['taille-police']=$_POST['taille-police'];
                }
            ?>
            <div class="div-button-section">
            </div>
        </section>
        
        <section id="police">
            <h1>Police</h1>
            <div class="div-button-section">
            </div>
        </section>
        
        <section class="pair" id="arriere-plan">
            <h1>Arrière-Plan</h1>  
            <div class="div-button-section">
            </div>
        </section>
        
    </body>
</html>