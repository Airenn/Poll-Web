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
function progress_bars($question,$categorie){
        $reponses = get_reponses($question);
        $total = nb_messages_quest($question,$categorie);
        $categories = array("success"=>"Valide", "default"=>"Doublon", "warning"=>"Retard");
        $pourcentage;
        
        while($rep = $reponses->fetch(PDO::FETCH_ASSOC)){
            echo '<p>'.$rep['texte'].'</p><div class="progress">';
            
            foreach($categories as $key=>$categ){
                ($total>0) 
                ? $pourcentage = 100*(nb_messages_rep($rep['ID'], $categ)/$total)
                : $pourcentage = 0;
                echo
                    '<div class="progress-bar progress-bar-'.$key.' progress-bar-striped" style="width: '.(int)$pourcentage.'%">
                        <span class="sr-only">'.(int)$pourcentage.'% Complete</span>
                    </div>';
            }
            
            echo '</div>';
        }
    }

function create_pb(){
    echo '<span id="salut" value='.get_current_question()['ID'].'></span>';
}
?>
