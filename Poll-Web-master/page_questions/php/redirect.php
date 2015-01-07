<?php
    require_once ('connexion.php');
    require ('fonctions.php');

    $operation=false;
    $question=false;

    if(isset($_GET['operation']) && trim($_GET['operation'])!=""){
        $operation = get_operation($_GET['operation']);
        $question = true;
    }
    if(isset($_GET['question']) && trim($_GET['question'])!=""){
        $question = get_question($_GET['question']);
        $operation = true;
    }

    if(!$operation || !$question){
        header('Location: ../page_accueil/accueil.php');
        exit();
    }
?>