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


function current_question_text(){
    $question = get_current_question();
    return $question['texte'];
}
function get_current_reponses(){
    $quest_id=get_current_question()['ID'];
    $rep=get_reponses($quest_id);
    while($res = $rep->fetch(PDO::FETCH_ASSOC)){
        if(total_messages($quest_id)==0)
            $percent=0;
        else
            $percent = (nb_messages_rep($res['ID'])/ total_messages($quest_id))*100;
        echo"<p class='rep'>".$res['lettre_reponse']." : ".$res['texte']."
            <div class='progress'>
                <div class='progress-bar progress-bar-striped' role='progressbar' aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' style='width:".$percent."%;'>
                    <span class='sr-only'>60% Complete</span>
                </div>";
        if(isset($_SESSION['barre-progressive']['hors-delai']) and $_SESSION['barre-progressive']['hors-delai']=="on")
        {
            echo "<div class='progress-bar progress-bar-warning progress-bar-striped active' style='width: 20%'>
                                    <span class='sr-only'>20% Complete (warning)</span></div>";
        }
            echo "</div></p>";
    
    }
}

?>
