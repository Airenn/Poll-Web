<?php
    require_once('../php/connexion.php');
    require_once('../php/fonctions.php');

    if(isset($_GET['robot_actif']) && $_GET['robot_actif']==1){
        message_bot($_GET['question']);
    }
    
?>