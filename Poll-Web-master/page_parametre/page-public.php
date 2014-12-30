<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" media="screen" type="text/css" href="css/page-public.php" />
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <script src="../page_questions/js/questions.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/classie.js"></script>
        <script src="js/cbpAnimatedHeader.js"></script>
        <title>Page public</title>
    </head>
    <body>
        
        <div id="conteneur">
            <?php
                session_start();
                require("../page_questions/php/connexion.php");
                require("../page_questions/php/fonctions.php");
                require("php/fonctions.php");

            ?>
            <header>
                
                <p id="question"><?php echo get_current_question()['texte'];?></p>
                <div id="nbmsg">
                    <img src="images/enveloppe.png" alt=""/>
                    <p id="nbrecus"><?php echo total_reponses(get_current_question()['ID']) ?></p>
                </div>
            </header>
            <section id="ajax_bar">
                <?php progress_bars( get_current_question()['ID']); ?>
            </section>
            <footer>
                <p>
                    Envoyez votre réponse (exemple: <strong>2A</strong>, ou <strong>2B</strong>) par SMS au <strong><?php echo $_SESSION['paragraphe']['tel']; ?></strong><br/>
                    Pour donner plusieurs réponses, envoyez par exemple <strong>2AB</strong>
                </p>
            </footer>
            
        </div>
    </body>
</html>
