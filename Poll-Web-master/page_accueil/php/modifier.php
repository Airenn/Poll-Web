<?php
    require_once('../../php/fonctions.php');
    require_once('../../php/connexion.php');
	
    $id_operation = $_GET['id'];
    $nom_operation = $_GET['nom'];
    $date_operation = $_GET['date'];
    $type_operation='UPDATE';
    $table_cible='operations';
    if(isset($nom_operation) && isset($date_operation) && trim($nom_operation)!="" && trim($date_operation)!=""){
    $args_operation= array(
                    'clause_set'=>array('nom'=> $nom_operation,'date_prevue'=> $date_operation),
                    'clause_where'=>array('ID'=> $id_operation)
                );
    execute_sql($type_operation, $table_cible, $args_operation);
    }
?>     