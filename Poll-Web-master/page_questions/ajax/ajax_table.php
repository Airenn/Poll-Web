<?php
    require_once('../php/redirect.php');
    
    if(!isset($_GET['categorie']) || trim($_GET['categorie'])==""){
        $_GET['categorie']='Tout';   
    }

    create_messages_table($_GET['question'], $_GET['categorie']); 
?>