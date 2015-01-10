<?php
    require_once('../../php/fonctions.php');
    require_once('../../php/connexion.php');

    $ID_operation = $_GET['ID'];
    $type_operation='DELETE';
    $table_cible='operations';
    $args_operation= array(
                'clause_where'=>array('ID'=> $ID_operation)
            );
    execute_sql($type_operation, $table_cible, $args_operation);
         
?>      

