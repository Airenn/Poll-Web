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

function open_question($question,$open_close){
    global $db;
    $val;
    try{
        $operation = get_current_operation()['ID'];
        $req1=$db->prepare('SELECT * FROM questions WHERE ID_operation=:operation');
        $req1->bindvalue(':operation',$operation);
        $req1->execute();
        $test=false;
        $req2=$db->prepare('SELECT * FROM questions WHERE fermee=0');
        $req2->bindvalue(':operation',$operation);
        $req2->execute();
        if(empty($req2->fetchAll())){
            reset_bdd_question('2');
            $req2->$db->prepare('SELECT * FROM questions WHERE ID_operation=:operation');
            $req2->bindvalue(':operation',$operation);
            $req2->execute();
            $rep=$req2->fetch(PDO::FETCH_ASSOC);
        }
        else{
            while($rep=$req1->fetch(PDO::FETCH_ASSOC) and $test==false){
                if($rep['ID']==$question){
                    $rep=$req1->fetch(PDO::FETCH_ASSOC);
                    reset_bdd_question($rep['ID']);
                    open_close_quest($question);
                    $test=true;
                }
            }
        }
        
    }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
    $val=get_current_question()['ID'];
    echo $val;
}

function reset_bdd_question($question){
    global $db;
    try{
        $req=$db->prepare('UPDATE questions SET fermee=:fermee WHERE ID=:question');
        $req->bindvalue(':question',$question);
        $req->bindvalue(':fermee',0);
        $req->execute();
    }catch(PDOException $e){
    die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
    }
}

function create_pb(){
    $question = get_current_question()['ID'];
    $texte= get_current_question()['texte'];
    echo '<span class="bar" value="'.$question.'" texte="'.$texte.'"></span>';
}

function create_title(){
    $texte= get_current_question()['texte'];
    echo '<p id="question">'.$texte.'</p>';
}


function formulaire_couleur($choix_section){
    echo "
    <div id='div-mess' style='display:none;'>
            <label>Afficher le nombre de message : <input id='nbmessages' type='checkbox' name='checkbox' onchange="."hide_checkbox('#nbmessages','#div-format');"." checked='on'/></label><br/>
    </div>
    <div id='div-format'>
        <label>Couleur de la police : <input type='color' name='color-.$choix_section'/></label><br/>
        <label>Taille de la police  : <input type='text' name='taille-police-.$choix_section'/></label><br/>
        <label>Choix de la police d'écriture :
            <select name='police' value='button-police-.$choix_section'>
                <option value='Arial'>Arial</option>
                <option value='Arial Black'>Arial Black</option>
                <option value='Comic Sans MS'>Comic Sans MS</option>
                <option value='Courier New'>Courier New</option>
                <option value='Georgia'>Georgia</option>
                <option value='Impact'>Impact</option>
                <option value='Times New Roman'>Times New Roman</option>
                <option value='Trebuchet MS'>Trebuchet MS</option>
                <option value='Verdana'>Verdana</option>
            </select>
        </label><br/>
    </div>
    <div id='div-phone' style='display:none;'>
        <label>Numéro de téléphone : <input id='numtel' type='text' name='tel'/></label><br/>
    </div>
    ";
}
?>
