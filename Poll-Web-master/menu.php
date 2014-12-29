<?php

    function gen_menu($page){
        $accueil = "";
        $questions = "";
        $parametre = "";

        if($page == 'accueil'){
            $accueil = '"#" id="current"';
            $questions = '"../page_questions/questions.php"';
            $parametre = '"../page_parametre/parametre.php"';
        }
        else if($page == 'questions'){
            $accueil = '"../page_accueil/accueil.php"';
            $questions = '"#" id="current"';
            $parametre = '"../page_parametre/parametre.php"';
        }
        else{
            $accueil = '"../page_accueil/accueil.php"';
            $questions = '"../page_questions/questions.php"';
            $parametre = '"#" id="current"';
        }
        
        echo'
            <div id="title"><h1>Poll</h1></div>
            <div id="menu">
                <ul>
                    <a href='.$accueil.' title="Liste de tous les questionnaires"><li>Questionnaires</li></a>
                    <a href='.$questions.' title="Afficher/modifier les questions de votre questionnaire"><li>Questions</li></a>
                    <a href='.$parametre.' title="Paramétrer vos questionnaires"><li>Paramètres</li></a>
                </ul>
            </div>
            ';
    }

?>

