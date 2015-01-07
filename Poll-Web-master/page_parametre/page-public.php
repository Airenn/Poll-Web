<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" media="screen" type="text/css" href="css/page-public.php" />
        <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap-table/dist/css/bootstrap-table.min.css" rel="stylesheet" >
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
            <header class="public">
                
                <div id="ajax_title"></div>
                <div id="nbmsg">
                    <img src="images/enveloppe.png" alt=""/>
                    <p id="nbrecus"><?php echo nb_messages_quest(get_current_question()['ID'],'Valide'); ?></p>
                </div>
            </header>
                <section id="section_bar">
                    <?php create_pb(); ?>
                    <div id="ajax_bar"></div>  
                    <div id="ajax_keydown"></div> 
                </section>
            <footer>
                <p>
                    Envoyez votre réponse (exemple: <strong>2A</strong>, ou <strong>2B</strong>) par SMS au <strong><?php echo $_SESSION['paragraphe']['tel']; ?></strong><br/>
                    Pour donner plusieurs réponses, envoyez par exemple <strong>2AB</strong>
                </p>
            </footer>
            
        </div>
        <script src="../bootstrap/dist/js/jquery.min.js"></script>
        <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../bootstrap-table/dist/js/bootstrap-table.min.js"></script>
        <script src="js/fonctions.js"></script>
    </body>
</html>
