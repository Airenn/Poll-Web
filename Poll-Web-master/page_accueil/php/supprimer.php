<?php
    require_once('../../page_questions/php/fonctions.php');
    require_once('connexion.php');
    global $db;
    $ID_operation = $_GET['ID'];
    $type_operation='DELETE';
    $table_cible='operations';
    $args_operation= array(
                    'clause_where'=>array('ID'=> $ID_operation)
                );
        execute_sql($type_operation, $table_cible, $args_operation);
        header("Location: http://localhost/Poll-Web/Poll-Web-master/page_accueil/accueil.php");
        exit;
         
?>      

