<?php
    require_once('../php/connexion.php');
    require_once('../php/fonctions.php');

    if(isset($_GET['num_tel']) && isset($_GET['texte']) && trim($_GET['num_tel'])!="" && trim($_GET['texte'])!=""){
        $message = array();
        $message['num_tel'] = '+'.trim($_GET['num_tel']);
        $message['texte'] = $_GET['texte'];
        sort_message($message);
    }
?>