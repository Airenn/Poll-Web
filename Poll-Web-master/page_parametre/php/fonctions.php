<?php

function text_format($key, $choix_section){
                if(isset($_POST["color-$choix_section"]))
                    $_SESSION[$key]["color-$choix_section"]=$_POST["color-$choix_section"];
                if(isset($_POST["police-$choix_section"]))
                    $_SESSION[$key]["police-$choix_section"]=$_POST["police-$choix_section"];
                if(isset($_POST["taille-police-$choix_section"]) and is_numeric($_POST["taille-police-$choix_section"]))
                    $_SESSION[$key]["taille-police-$choix_section"]=$_POST["taille-police-$choix_section"];              
                elseif(isset($_POST["taille-police-$choix_section"]) and trim($_POST["taille-police-$choix_section"])!="")
                    $_SESSION[$key]["taille-police-$choix_section"]="";
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
                    <select id="choix_police" <?php echo "name='police-$choix_section'"; ?> value='button-police'>
                        <?php  
                            $tab_police = array("Arial","Arial Black","Calibri","Cambria","Comic Sans MS","Constantia","Courier New","Georgia",
                                                    "Impact","Times New Roman","Trebuchet MS","Verdana");
                                                 
                                                 
                            foreach($tab_police as $polices_style){
                                echo "<optgroup style=font-family:'$polices_style';>
                                        <option class='style-police' value='$polices_style'>$polices_style</option>
                                      </optgroup>";
                            }
                        
                        
                            if(isset($_SESSION[$key]["police-$choix_section"])){
                                foreach($tab_police as $police_selected){
                                    switch($_SESSION[$key]["police-$choix_section"]){
                                        case "$police_selected":
                                        echo "<optgroup style=font-family:'$police_selected'>
                                                <option id='police_selectionnee' class='style-police' value='$police_selected' selected>$police_selected</option>
                                            </optgroup>";
                                        break;
                                    }
                                }
                            }
                        ?>
                    </select>
                </div>
            </span>
            
            <span class="input-group-addon"style="border-top-right-radius:0;border-bottom-right-radius:0;width:23,33333%;">
                Taille<br/><br/>
                <input style="text-align:center;" type="text" class="form-control" placeholder='<?php 
                            if(isset($_SESSION[$key]["taille-police-$choix_section"]) && is_numeric($_SESSION[$key]["taille-police-$choix_section"]))
                                echo $_SESSION[$key]["taille-police-$choix_section"]." px";
                            else
                                echo "Entrez un nombre (en px)";
                       
                       ?>' "aria-describedby="basic-addon1" <?php echo "name='taille-police-$choix_section'"; ?> >
            </span>

       </div> 

<?php
}
?>
