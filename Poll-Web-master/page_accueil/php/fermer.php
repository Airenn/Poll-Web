<?php
    require_once('../../php/fonctions.php');
    require_once('../../php/connexion.php');

    $id_operation = $_GET['ID'];
    $type_operation='UPDATE';
    $table_cible='operations';
    $args_operation= array(
                    'clauses_set'=>array('fermee'=>0),
                'clause_where'=>array('ID'=> $id_operation)
);
    execute_sql($type_operation, $table_cible, $args_operation);
?>     