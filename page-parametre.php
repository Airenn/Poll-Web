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
                    <a class="lien-entete" href="page-public.php">Afficher la page public</a>
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
                <input type="color" name="color"> 
                <input type="submit" name="button">
            </form>
            <?php
                $_SESSION['color']=$_POST['color'];
                echo $_SESSION['color'];
            ?>
            <div class="div-button-section">
                <button class="button-section">Prévisualisation</button>
                <button class="button-section">Sauvegarder</button>
            </div>
        </section>
        
        <section id="police">
            
            <h1>Police</h1>
            <div class="div-button-section">
                <button class="button-section">Prévisualisation</button>
                <button class="button-section">Sauvegarder</button>
            </div>
        </section>
        
        <section class="pair" id="arriere-plan">
            
            <h1>Arrière-Plan</h1>
            
            
            <div class="div-button-section">
                <button class="button-section">Prévisualisation</button>
                <button class="button-section">Sauvegarder</button>
            </div>
        </section>
        
    </body>
</html>