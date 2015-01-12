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
            $plus='<div id="afficher-p-p"><a class="lien-entete" id="afficher_public" href="javascript:PopupWindow(this,"page-public.php");"><div id="bloc-entete"><h4 id="h4-bloc-entete" class="glyphicon glyphicon-search"></h4>Page publique</div></a></div>';
        }
        
        echo'
            <div id="title_logo">
                <img src="../final_logo.png" width="216px" height="75px" id="logo"/>
                '.$plus.'
            </div>
            <div id="menu">
                <ul>
                    <a id="questionnaires" href='.$accueil.' title="Liste de tous les questionnaires"><li>Questionnaires</li></a>
                    <a id="questions" href='.$questions.' title="Consulter ou modifier les questions de votre questionnaire"><li>Questions</li></a>
                    <a id="parametres" href='.$parametre.' title="Paramétrer vos questionnaires"><li>Paramètres</li></a>
                </ul>
            </div>
            ';
    }

?>

