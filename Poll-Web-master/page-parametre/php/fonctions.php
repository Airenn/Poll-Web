<?php

function text_format($key){
                if(isset($_POST['color']) and isset($_POST['police'])){
                    $_SESSION[$key]['color']=$_POST['color'];
                    $_SESSION[$key]['police']=$_POST['police'];
                }
                if(isset($_POST['taille-police']) and is_numeric($_POST['taille-police']))
                    $_SESSION[$key]['taille-police']=$_POST['taille-police'];              
                elseif(isset($_POST['taille-police']) and trim($_POST['taille-police'])!="")
                                echo "la taille de police saisie n'est pas valide";
}

function text_format_css($key){
    if(isset($_SESSION[$key]['color']) and isset($_SESSION[$key]['taille-police']) and isset($_SESSION[$key]['police'])){
        echo 'color : '.$_SESSION[$key]['color'].';';
        echo 'font-size : '.$_SESSION[$key]['taille-police'].'px;';
        echo 'font-family : '.$_SESSION[$key]['police'].'px;';
    }
}
?>
