<?php
    require_once('../php/connexion.php');
    require_once('../php/fonctions.php');

    if(!isset($_GET['nb']) || trim($_GET['nb'])==""){
        $_GET['nb']=6;   
    }

    if(!isset($_GET['page']) || trim($_GET['page'])==""){
        $_GET['page']=0;   
    }

    if(!isset($_GET['categorie']) || trim($_GET['categorie'])==""){
        $_GET['categorie']='Tout';   
    }

    if(!isset($_GET['tri']) || trim($_GET['tri'])==""){
        $_GET['tri']='DESC';   
    }

    create_messages_table($_GET['question'], $_GET['nb'], $_GET['page'], $_GET['categorie'], $_GET['tri'])
?>