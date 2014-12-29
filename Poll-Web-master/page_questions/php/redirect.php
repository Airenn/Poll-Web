<?php
    require_once ('connexion.php');
    require ('fonctions.php');

    $operation=false;
    $question=false;

    if(isset($_GET['operation'])){
        $operation = get_operation($_GET['operation']);
    }
    if(isset($_GET['question'])){
        $question = get_question($_GET['question']);
    }

    if((!$operation && isset($_GET['operation'])) || (!$question && isset($_GET['question']))){
        header('Location: ../../Page accueil/php/accueil.php');
        exit();
    }
?>