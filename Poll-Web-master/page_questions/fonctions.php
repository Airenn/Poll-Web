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
                                <a href="#">'.htmlspecialchars($question_tab['ID']).": ".htmlspecialchars($question_tab['texte']).'</a>
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


    function regex_builder($question){
        $regex = "#^";
        $max = total_reponses($question);
        $first_digit = substr((string) $max, 0, 1);
        $lettres = get_lettres_reponses($question);
        $multi_rep = get_question($question);
        $multi_rep = $multi_rep['multi_rep'];
        
        arsort($lettres);
        
        if($max > 0){
            ($first_digit != '1')
            ? $regex .= '([1-'.$first_digit.'])'
            : $regex .= '(1)';
            
            $regex .= '(\-|\)|\]|\}|\:)?';
            
            (current($lettres) != 'A')
            ? $regex .= '([A-'.current($lettres).'])'
            : $regex .= '(A)';
            
            if($multi_rep==1 && current($lettres)!='A'){
                $regex .= '*';   
            }
        }
        
        return $regex.'$#';
    }


    function sort_message($message){
        global $db;
        $num_tel = $message['num_tel'];
        $texte = strtoupper(trim($message['texte']));
        $categorie;
        $ID_reponse;
        $ID_question;
    }
	
?>