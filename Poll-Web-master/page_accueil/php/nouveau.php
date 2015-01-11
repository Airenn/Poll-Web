<?php
    require_once('../../php/fonctions.php');
    require_once('../../php/connexion.php');

    $nom_operation = $_GET['nom'];
    $date_operation = $_GET['date'];
    $type_operation='INSERT';
    $table_cible='operations';
    if(isset($nom_operation) && isset($date_operation) && trim($nom_operation)!="" && trim($date_operation)!=""){
    $args_operation= array(
                    'champs_cibles'=>array('nom','date_prevue','fermee'),
                    'clause_values'=>array('nom'=> $nom_operation,'date_prevue'=>$date_operation,'fermee'=>1)
                );
    execute_sql($type_operation, $table_cible, $args_operation);
    }
?>     