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
        echo "font-family : ".$_SESSION[$key]["police-$choix_section"].";";
    }
}

function progress_bars($categorie){
    $question = get_current_question()['ID'];
    create_progress_bars($question,$categorie);
}

function open_question($question){
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
        
    }catch(PDOException $e){
        die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
    }
    $val=get_current_question()['ID'];
    echo $val;
}

function afficher_reponse($question){
    $req=execute_sql("SELECT","reponses",array('clause_where'=>array("ID_question"=>$question)));
    while($rep=$req->fetch(PDO::FETCH_ASSOC)){
        if($rep['points']>0)
        construct_full_bar(array("success"=>"Valide"), $question, $rep['ID'], $total, $rep['texte']);
        else
            construct_full_bar(array("danger"=>"Valide"), $question, $rep['ID'], $total, $rep['texte']);
    }
}

function changer_question_reponse($question,$sens){
    global $db;
    $operation = get_current_operation()['ID'];
    if($sens)
        $req=execute_sql("SELECT","questions",array("clause_where"=>array("ID_operation"=>$operation)));
    else
        $req=execute_sql("SELECT","questions",array("clause_where"=>array("ID_operation"=>$operation), "clause_order_by"=>array("colonne_tri"=>"ID","ordre_tri"=>"DESC")));
    $rep=$req->fetch(PDO::FETCH_ASSOC);
    echo $rep['ID'];
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

function formulaire_couleur($key,$choix_section){
?>
        <div <?php echo "id=formatage-texte-$choix_section"; ?> >

            <span class="input-group-addon" style="border-top-left-radius:0;border-bottom-left-radius:0;width:23,33333%;"> 
                Couleur<br/><br/>
                <input type="color" class="form-control" aria-describedby="basic-addon1" <?php echo "name='color-$choix_section'"; ?> value='<?php 
                                if(isset($_SESSION[$key]["color-$choix_section"]))
                                    echo $_SESSION[$key]["color-$choix_section"]; 
                            ?>' />
            </span>

            <span class="input-group-addon" style="width:23,33333%;">
                Police<br/><br/>
                <div>
                    <select style="width:70%;height:2.4em;border:solid #cccccc 1px;border-top-right-radius:2px;border-bottom-right-radius:2px;border-top-left-radius:4px;border-bottom-left-radius:4px;text-align:center;" <?php echo "name='police-$choix_section'"; ?> value='button-police'>
                        <optgroup style="font-family:'Arial'">
                            <option class="style-police" value='Arial'>Arial</option>
                        </optgroup>
                        <optgroup style="font-family:'Arial Black'">
                            <option class="style-police" value='Arial Black'>Arial Black</option>
                        </optgroup>
                        <optgroup style="font-family:'Comic Sans MS'">
                            <option class="style-police" value='Comic Sans MS'>Comic Sans MS</option>
                        </optgroup>
                        <optgroup style="font-family:'Courier New'">
                            <option class="style-police" value='Courier New'>Courier New</option>
                        </optgroup>
                        <optgroup style="font-family:'Georgia'">
                            <option class="style-police" value='Georgia'>Georgia</option>
                        </optgroup>
                        <optgroup style="font-family:'Impact'">
                            <option class="style-police" value='Impact'>Impact</option>
                        </optgroup>
                        <optgroup style="font-family:'Times New Roman'">
                            <option class="style-police" value='Times New Roman'>Times New Roman</option>
                        </optgroup>
                        <optgroup style="font-family:'Trebuchet MS'">
                            <option class="style-police" value='Trebuchet MS'>Trebuchet MS</option>
                        </optgroup>
                        <optgroup style="font-family:'Verdana'">
                            <option class="style-police" value='Verdana'>Verdana</option>
                        </optgroup>
                        
                        <?php  if(isset($_SESSION[$key]["police-$choix_section"])){
                                    switch($_SESSION[$key]["police-$choix_section"]){
                                        case "Arial":
                                            echo "<option value='Arial' selected >Arial</option>";
                                            break;
                                        case "Arial Black":
                                            echo "<option value='Arial Black' selected >Arial Black</option>";
                                            break;
                                        case "Comic Sans MS";
                                            echo "<option value='Comic Sans MS' selected >Comic Sans MS</option>";
                                            break;
                                        case "Courrier New":
                                        echo "<option value='Courier New' selected >Courier New</option>";
                                            break;
                                        case "Georgia":
                                        echo "<option value='Georgia' selected >Georgia</option>";
                                            break;
                                        case "Impact":
                                        echo "<option value='Impact' selected >Impact</option>";
                                            break;
                                        case "Times New Roman":
                                        echo "<option value='Times New Roman' selected >Times New Roman</option>";
                                            break;
                                        case "Trebuchet MS":
                                        echo "<option value='Trebuchet MS' selected >Trebuchet MS</option>";
                                            break;
                                        case "Verdana":
                                            echo "<option value='Verdana' selected >Verdana</option>";
                                            break;
                                    }
                            } 
                        ?>
                    </select>
                </div>
            </span>
            
            <span class="input-group-addon"style="border-top-right-radius:0;border-bottom-right-radius:0;width:23,33333%;">
                Taille<br/><br/>
                <input style="text-align:center;" type="text" class="form-control" placeholder='<?php 
                            if(isset($_SESSION[$key]["taille-police-$choix_section"]))
                                echo $_SESSION[$key]["taille-police-$choix_section"]." px";
                            else
                                echo "en px";
                       
                       ?>' "aria-describedby="basic-addon1" <?php echo "name='taille-police-$choix_section'"; ?> >
            </span>

       </div> 

<?php
}
?>
