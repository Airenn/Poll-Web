<?php

function text_format($key, $choix_section){
                if(isset($_POST["color-$choix_section"]))
                    $_SESSION[$key]["color-$choix_section"]=$_POST["color-$choix_section"];
                if(isset($_POST["police-$choix_section"]))
                    $_SESSION[$key]["police-$choix_section"]=$_POST["police-$choix_section"];
                if(isset($_POST["taille-police-$choix_section"]) and is_numeric($_POST["taille-police-$choix_section"]))
                    $_SESSION[$key]["taille-police-$choix_section"]=$_POST["taille-police-$choix_section"];              
                elseif(isset($_POST["taille-police-$choix_section"]) and trim($_POST["taille-police-$choix_section"])!="")
                                echo "la taille de police saisie n'est pas valide";
}

function text_format_css($key, $choix_section){
    if(isset($_SESSION[$key]["color-$choix_section"]) and isset($_SESSION[$key]["police-$choix_section"]) or isset($_SESSION[$key]["taille-police-$choix_section"])){
        echo "color : ".$_SESSION[$key]["color-$choix_section"].";";
        echo "font-size : ".$_SESSION[$key]["taille-police-$choix_section"]."px;";
        echo "font-family : ".$_SESSION[$key]["police-$choix_section"]."px;";
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
?>
        <div id='div-format'>
            <label>Couleur de la police : <input type='color' <?php echo "name='color-$choix_section'"; ?> /></label><br/>
            <label>Taille de la police  : <input type='text' <?php echo "name='taille-police-$choix_section'"; ?> /></label><br/>
            <label>Choix de la police d'écriture :
                <select <?php echo "name='police-$choix_section'"; ?> value='button-police'>
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
<?php
}
?>
