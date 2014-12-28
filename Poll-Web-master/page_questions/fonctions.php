<?php
        
    function get_operation($operation){
        global $db;
        try{
            $req=$db->prepare('SELECT * FROM operations WHERE ID=:operation');
            $req->bindvalue(':operation', $operation);
            $req->execute();
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        return $req->fetch(PDO::FETCH_ASSOC);
    }


    function get_questions($operation){
        global $db;
        try{
            $req=$db->prepare('SELECT * FROM questions WHERE ID_operation=:operation');
            $req->bindvalue(':operation', $operation);
            $req->execute();
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        return $req;
    }


    function get_question($question){
        global $db;
        try{
            $req=$db->prepare('SELECT * FROM questions WHERE ID=:question');
            $req->bindvalue(':question', $question);
            $req->execute();
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        return $req->fetch(PDO::FETCH_ASSOC);
    }


    function get_reponses($question){
        global $db;
        try{
            $req=$db->prepare('SELECT * FROM reponses WHERE ID_question=:question');
            $req->bindvalue(':question', $question);
            $req->execute();
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        return $req;
    }


    function get_lettres_reponses($question){
        $lettres = array();
        $reponses = get_reponses($question);
        
        while($rep = $reponses->fetch(PDO::FETCH_ASSOC)){
            $lettres[] = $rep['lettre_reponse'];
        }
        
        return $lettres;
    }


    function get_messages($question){
        global $db;
        try{
            $req=$db->prepare('SELECT * FROM messages WHERE ID_question=:question');
            $req->bindvalue(':question', $question);
            $req->execute();
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        return $req;
    }


    function total_reponses($question){
        global $db;
        try{
            $req=$db->prepare('SELECT count(*) as nb FROM reponses WHERE ID_question=:question');
            $req->bindvalue(':question', $question);
            $req->execute();
            $total = $req->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        return $total['nb'];
    }


    function total_messages($question){
        global $db;
        try{
            $req=$db->prepare('SELECT count(*) as nb FROM messages WHERE ID_question=:question');
            $req->bindvalue(':question', $question);
            $req->execute();
            $total = $req->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        return $total['nb'];
    }


    function nb_messages_rep($reponse){
        global $db;
        try{
            $req=$db->prepare('SELECT count(*) as nb FROM messages WHERE ID_reponse=:reponse');
            $req->bindvalue(':reponse', $reponse);
            $req->execute();
            $total = $req->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        return $total['nb'];
    }


    function create_dropdown($questions){
        echo'<div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="btn-question">
                    Question <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">';
                    while($question_tab = $questions->fetch(PDO::FETCH_ASSOC)){
                        echo'<li class="question" value="'.htmlspecialchars($question_tab['ID']).'">
                                <a href="#">'.htmlspecialchars($question_tab['num_question']).": ".htmlspecialchars($question_tab['texte']).'</a>
                            </li>';
                    }
        echo    '</ul>
            </div>';
        
    }


    function create_progress_bars($question){
        $reponses = get_reponses($question);
        $total = total_messages($question);
        $pourcentage;
        
        while($rep = $reponses->fetch(PDO::FETCH_ASSOC)){
            ($total>0) 
            ? $pourcentage = 100*(nb_messages_rep($rep['ID'])/$total)
            : $pourcentage = 0;
        
            echo
                '<p>'.$rep['texte'].'</p><div class="progress">
                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="'.$pourcentage.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$pourcentage.'%" id="'.$rep['ID'].'">
                        <span class="sr-only">'.$pourcentage.'% Complete</span>
                    </div>
                </div>';
        }
        
    }


    function create_messages_table($question){
        $req = get_messages($question);
        
        if($messages = $req->fetch(PDO::FETCH_ASSOC)){
            echo '<thead><tr>';
            foreach($messages as $key=>$info){
                echo '<th class="col-md-2">'.$key.'</th>';
            }
            echo '</tr></thead>';

            do{
                echo '<tr>';
                foreach($messages as $key=>$info){
                    echo '<td class="col-md-2">'.$info.'</td>';
                }
                echo '</tr>';
            }while($messages = $req->fetch(PDO::FETCH_ASSOC));
        }  

    }


    function count_digit($nb) {
        return strlen((string) $nb);
    }


    function sort_message($message){
        global $db;
        $num_tel = (string) $message['num_tel'];
        $texte = strtoupper(trim($message['texte']));
        $regex = '#^([1-9])(\-|\)|\]|\}|\:)?([A-Z])+$#';
        $resultats;
        $num_question;
        $lettre;
        $lettres_reponse;
        $req;
        
        $operation = get_current_operation();
        $all_questions = get_questions($operation['ID']);
        $current_questions = get_current_questions();
        $all_reponses = null;
        
        $question = null;
        $reponses = null;
        
        $erreur = false;
        $retard = true;
        $ID_reponse = null;
        $ID_question = null;
        $insertion = false;
        
        if(preg_match($regex, $texte, $resultats)){
            $num_question = (int) $resultats[1];
            $lettres_reponse = str_split((string) $resultats[3]);
        
            while($quest = $all_questions->fetch(PDO::FETCH_ASSOC)){

                if((string)$num_question == (string)$quest['num_question']){
                    $question = $quest;
                    $ID_question = $quest['ID'];
                    break;
                }
            }

            if($question != null){
                $all_reponses = get_reponses($ID_question);
                $reponses = get_lettres_reponses($ID_question);
                $nb_reponses = count($lettres_reponse);

                while($quest = $current_questions->fetch(PDO::FETCH_ASSOC)){
                    if($num_question == $quest['num_question']){
                        $retard = false;
                        break;
                    }
                }

                if(($question['multi_rep']==1 && $nb_reponses>=1) || ($question['multi_rep']==0 && $nb_reponses==1)){

                    do{
                        $valide = false;
                        $erreur = false;
                        $doublon = false;
                        $lettre = current($lettres_reponse);
                        next($lettres_reponse);

                        if(in_array($lettre, $reponses)){
                            while($rep = $all_reponses->fetch(PDO::FETCH_ASSOC)){
                                if($lettre == $rep['lettre_reponse']){
                                    $ID_reponse = $rep['ID'];
                                    break;
                                }
                            }
                        }
                        else{
                            $erreur = true;   
                        }

                        $texte = (string) ($num_question.$lettre);
                        insert_message($num_tel, $texte, $erreur, $retard, $ID_reponse, $ID_question);
                        $insertion = true;

                    }while((--$nb_reponses)!=0);
                }
                else{
                    $erreur = true;   
                }
            }
            else{
                $erreur = true;   
            }
        }
        else{
            $erreur = true;
        }
                    
        if(!$insertion){
            insert_message($num_tel, $texte, $erreur, $retard, $ID_reponse, $ID_question);
        }
    }


    function insert_message($num_tel, $texte, $erreur, $retard, $ID_reponse, $ID_question){
        global $db;
        $valide = !($erreur || $doublon || $retard);
        $current_question = get_current_questions();
        $reponse;
        
        if($current_question = $current_question->fetch(PDO::FETCH_ASSOC)){
            $current_question = $current_question['ID'];
            $reponse = get_reponses($current_question);
            $reponse = $reponse['ID'];
        }
        else{
            $current_question = 1;
            $reponse = 1;
        }
        
        if($erreur == true){
            if($ID_question == null && $ID_reponse == null){
                $ID_question = $current_question;
                $ID_reponse = $reponse;
            }
            else if($ID_reponse == null){
                $ID_reponse = get_reponses($ID_question);
                $ID_reponse = $ID_reponse->fetch(PDO::FETCH_ASSOC);
                $ID_reponse = $ID_reponse['ID'];
            }
        }
        
        $doublon = check_doublon($num_tel, $texte, $erreur, $retard, $ID_reponse, $ID_question);
        
        try{
            $req=$db->prepare('INSERT INTO messages(`num_tel`, `texte`, `valide`, `erreur`, `doublon`, `retard`, `ID_reponse`, `ID_question`) 
                                VALUES (:tel, :texte, :valide, :erreur, :doublon, :retard, :rep, :quest)');
            $req->bindvalue(':tel', $num_tel);
            $req->bindvalue(':texte', $texte);
            $req->bindvalue(':valide', $valide);
            $req->bindvalue(':erreur', $erreur);
            $req->bindvalue(':doublon', $doublon);
            $req->bindvalue(':retard', $retard);
            $req->bindvalue(':rep', $ID_reponse);
            $req->bindvalue(':quest', $ID_question);
            $req->execute();
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
    }


    function check_doublon($num_tel, $texte, $erreur, $retard, $ID_reponse, $ID_question){
        global $db;
        $req;
        $doublon;
        
        try{
            $req=$db->prepare('SELECT * FROM messages WHERE num_tel=:tel AND texte=:texte AND erreur=:erreur AND retard=:retard AND ID_reponse=:rep AND ID_question=:quest');
            $req->bindvalue(':tel', $num_tel);
            $req->bindvalue(':texte', $texte);
            $req->bindvalue(':erreur', $erreur);
            $req->bindvalue(':retard', $retard);
            $req->bindvalue(':rep', $ID_reponse);
            $req->bindvalue(':quest', $ID_question);
            $req->execute();
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        
        ($req->fetch())
        ? $doublon = true
        : $doublon = false;
        
        return $doublon;
    }

    
    function get_current_operation(){
        global $db;
        try{
            $req=$db->prepare('SELECT * FROM operations WHERE fermee=0');
            $req->execute();
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        return $req->fetch(PDO::FETCH_ASSOC);
    }


    function get_current_questions(){
        global $db;
        try{
            $req=$db->prepare('SELECT * FROM questions WHERE fermee=0 ORDER BY num_question');
            $req->execute();
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        return $req;
    }

    
	
?>