<?php

    function gen_menu($page){
        $accueil = "";
        $questions = "";
        $parametre = "";

        if($page == 'accueil'){
            $accueil = "#";
            $questions = "../../page_questions/php/questions.php";
            $parametre = "../../page-parametre/page-parametre.php";
        }
        else if($page == 'questions'){
            $accueil = "../../Page accueil/php/accueil.php";
            $questions = "#";
            $parametre = "../../page-parametre/page-parametre.php";
        }
        else{
            $accueil = "../../Page accueil/php/accueil.php";
            $questions = "../../page_questions/php/questions.php";
            $parametre = "#";
        }
        
        echo
            '<div id="menu">
                <ul>
                    <a href="'.$accueil.'" title="Liste de tous les questionnaires"><li>Questionnaires</li></a>
                    <a href="'.$questions.'" title="Afficher/modifier les questions de votre questionnaire"><li>Questions</li></a>
                    <a href="'.$parametre.'" title="Paramétrer vos questionnaires"><li>Paramètres</li></a>
                </ul>
            </div>';
    }

?>

