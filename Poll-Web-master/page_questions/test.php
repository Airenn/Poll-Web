<?php
    require_once('php/connexion.php');
    require_once('php/fonctions.php');

    $args_operation= array(
                        'clauses_set'=>array('fermee'=>1),
                        'clause_where'=>array('ID'=> 3)
                    );

    echo 'dd';
    echo execute_sql('UPDATE', 'operation', $args_operation);
?>