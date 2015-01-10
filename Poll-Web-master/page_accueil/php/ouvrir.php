<?php
    require('../../php/connexion.php');

        global  $db;
        $id_operation = $_GET['ID'];
        $rep= $db->prepare('UPDATE operations SET fermee=1 WHERE ID ='.$id_operation);
        $rep->execute();
?>     