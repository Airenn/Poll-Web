<?php
    require_once('../php/redirect.php');
    
    if(!isset($_GET['categorie']) || trim($_GET['categorie'])==""){
        $_GET['categorie']='Tout';   
    }

    if(!isset($_GET['tri']) || trim($_GET['tri'])==""){
        $_GET['tri']='DESC';   
    }

    create_messages_table($_GET['question'], $_GET['categorie'], $_GET['tri']); 
?>