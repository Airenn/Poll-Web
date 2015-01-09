<?php
    try{
        $db=new PDO("mysql:host=localhost;dbname=poll", 'root');
        $db->query('SET NAMES utf8');
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        $db=new PDO("mysql:host=localhost;dbname=mysql", 'root');
        $db->exec(file_get_contents("../creation_db_poll_final.sql"));
        try{
            $db=new PDO("mysql:host=localhost;dbname=poll", 'root');
            $db->query('SET NAMES utf8');
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        } 
    } 
?>