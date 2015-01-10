<?php

    function gen_menu($page){
        $accueil = "";
        $questions = "";
        $parametre = "";
        $plus="";

        if($page == 'accueil'){
            $accueil = '"#" class="current"';
            $questions = '"../page_questions/questions.php"';
            $parametre = '"../page_parametre/parametre.php"';
        }
        else if($page == 'questions'){
            $accueil = '"../page_accueil/accueil.php"';
            $questions = '"#" class="current"';
            $parametre = '"../page_parametre/parametre.php"';
        }
        else{
            $accueil = '"../page_accueil/accueil.php"';
            $questions = '"../page_questions/questions.php"';
            $parametre = '"#" class="current"';
            $plus='<ul id="liste-entete">
                <li>
                    <a class="lien-entete" href="#couleur">Formatage de texte</a>
                </li>
                <li>
                    <a class="lien-entete" href="#arriere-plan">Arrière-Plan</a>
                </li>
                <li>
                    <a class="lien-entete" onclick="maximize_screen();" href="">Afficher la page public</a>
                </li></ul>
            ';
        }
        
        echo'
            <div id="title_logo">
                <img src="../poll_redux.png" width="10%" height="10%" id="logo"/>
                '.$plus.'
            </div>
            <div id="menu">
                <ul>
                    <a id="questionnaires" href='.$accueil.' title="Liste de tous les questionnaires"><li>Questionnaires</li></a>
                    <a id="questions" href='.$questions.' title="Afficher/modifier les questions de votre questionnaire"><li>Questions</li></a>
                    <a id="parametres" href='.$parametre.' title="Paramétrer vos questionnaires"><li>Paramètres</li></a>
                </ul>
            </div>
            ';
    }

?>

