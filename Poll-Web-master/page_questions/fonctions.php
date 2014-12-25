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


    function nb_messages($reponse){
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
            ? $pourcentage = 100*(nb_messages($rep['ID'])/$total)
            : $pourcentage = 0;
        
            echo
                '<div class="progress">
                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="'.$pourcentage.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$pourcentage.'%" id="'.$rep['ID'].'">
                        <span class="sr-only">'.$pourcentage.'% Complete</span>
                    </div>
                </div>';
        }
        
    }
	
?>