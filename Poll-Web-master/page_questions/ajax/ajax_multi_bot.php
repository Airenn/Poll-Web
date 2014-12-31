<?php
    require_once('../php/redirect.php');

    if(isset($_GET['robot_actif']) && $_GET['robot_actif']==1){
        message_bot($_GET['question']);
    }
    
?>