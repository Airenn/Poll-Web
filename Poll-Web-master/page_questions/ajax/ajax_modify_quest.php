<?php
    require_once('../php/connexion.php');
    require_once('../php/fonctions.php');
    
    if(!isset($_GET['modal_id'])){
        $_GET['modal_id'] = "";   
    }

    echo create_input($_GET['type'], $_GET['id'], $_GET['modal_id'], $_GET['question']);
?>