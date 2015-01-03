<?php
    require("connexion.php");
    global $db;
    $ID_operation = $_GET['ID'];
    try{
            $req=$db->prepare(' DELETE FROM operations WHERE ID='.$_GET['ID']);
            $req->bindvalue(':op', $ID_operation);
            if($req->execute()) {
            $_SESSION['message'] = "Ligne supprimée";
        //  echo "Enregistrement OK !";
            } else {
            $_SESSION['message'] = "Erreur : ligne non supprimée !";
            }
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        header("Location: http://localhost/Poll-Web/Poll-Web-master/page_accueil/accueil.php");
        exit;
         
?>      