<?php
    /*!
     * Renvoie le tableau associatif correspondant a l'operation recue en parametre
     *
     * \param $operation : int, identifiant de l'operation que l'on veut recuperer
     */    
    function get_operation($operation){
        $args = array(
                    'clause_where'=>array('ID'=>$operation)
                );
        
        $req = execute_sql("SELECT", "operations", $args);

        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /*!
     * Renvoie l'objet PDO correspondant aux questions pour l'operation recue en parametre
     *
     * \param $operation : int, identifiant de l'operation dont on doit recuperer les questions
     */
    function get_questions($operation){
        $args = array(
                    'clause_where'=>array('ID_operation'=>$operation)
                );
        
        $req = execute_sql("SELECT", "questions", $args);
        
        return $req;
    }

    /*!
     * Renvoie le tableau associatif correspondant a la question recue en parametre
     *
     * \param $question : int, identifiant de la question que l'on veut recuperer
     */
    function get_question($question){
        $args = array(
                    'clause_where'=>array('ID'=>$question)
                );
        
        $req = execute_sql("SELECT", "questions", $args);

        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /*!
     * Renvoie le tableau associatif correspondant au numero de question et a l'operation recues en parametre
     *
     * \param $num_question : int, numero de la question que l'on veut recuperer
     * \param $operation : int, identifiant de l'operation que l'on veut recuperer
     */
    function get_question_num($num_question, $operation){
        $args = array(
                    'clause_where'=>array('num_question'=>$num_question,
                                          'ID_operation'=>$operation
                                    )
                );
        
        $req = execute_sql("SELECT", "questions", $args);
        
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /*!
     * Renvoie l'objet PDO correspondant aux reponses pour la question recue en parametre
     *
     * \param $question : int, identifiant de la question dont on doit recuperer les reponses
     */
    function get_reponses($question){
        $args = array(
                    'clause_where'=>array('ID_question'=>$question)
                );
        
        $req = execute_sql("SELECT", "reponses", $args);

        return $req;
    }

    /*!
     * Renvoie l'array correspondant aux lettres des reponses pour la question recue en parametre
     *
     * \param $question : int, identifiant de la question dont on doit recuperer les lettres des reponses
     */
    function get_lettres_reponses($question){
        $lettres = array();
        $reponses = get_reponses($question);
        
        while($rep = $reponses->fetch(PDO::FETCH_ASSOC)){
            $lettres[] = $rep['lettre_reponse'];
        }
        
        return $lettres;
    }

    /*!
     * Renvoie l'array correspondant aux numeros des questions pour l'operation recue en parametre
     *
     * \param $operation : int, identifiant de l'operation dont on doit recuperer les numeros des questions
     */
    function get_num_questions($operation){
        $nums = array();
        $questions = get_questions($operation);
        
        while($quest = $questions->fetch(PDO::FETCH_ASSOC)){
            $nums[] = $quest['num_question'];
        }
        
        return $nums;
    }

    /*!
     * Renvoie l'objet PDO correspondant aux messages recus pour la question recue en parametre
     *
     * \param $question : int, identifiant de la question dont on doit recuperer les messages
     */
    function get_messages($question){
         $args = array(
                    'clause_where'=>array('ID_question'=>$question)
                );
        
        $req = execute_sql("SELECT", "messages", $args);

        return $req;
    }

    /*!
     * Renvoie le nombre de reponses pour la question recue en parametre
     *
     * \param $question : int, identifiant de la question dont on doit compter les reponses
     */
    function total_reponses($question){
         $args = array(
                    'champs_cibles'=>array('count(*) as nb'), 
                    'clause_where'=>array('ID_question'=>$question)
                );
        
        $total = execute_sql("SELECT", "reponses", $args);
        $total = $total->fetch(PDO::FETCH_ASSOC);

        return $total['nb'];
    }

    /*!
     * Renvoie le nombre de messages recus pour la question recue en parametre
     *
     * \param $question : int, identifiant de la question dont on doit compter les messages
     */
    function total_messages($question){
         $args = array(
                    'champs_cibles'=>array('count(*) as nb'), 
                    'clause_where'=>array('ID_question'=>$question)
                );
        
        $total = execute_sql("SELECT", "messages", $args);
        $total = $total->fetch(PDO::FETCH_ASSOC);
        
        return $total['nb'];
    }

    /*!
     * Renvoie le nombre de messages errones recus pour la question recue en parametre
     *
     * \param $question : int, identifiant de la question
     */
    function nb_erreur_quest($question){
        $args = array(
                    'champs_cibles'=>array('count(*) as nb'), 
                    'clause_where'=>array('ID_question'=>$question,
                                          'erreur'=>1
                                    )
                );
        
        $total = execute_sql("SELECT", "messages", $args);
        $total = $total->fetch(PDO::FETCH_ASSOC);

        return $total['nb'];
    }

    /*!
     * Renvoie le nombre de messages recus pour la reponse recue en parametre
     *
     * \param $reponse : int, identifiant de la reponse dont on doit compter les messages
     * \param $categorie : string, categorie de message a selectionner
     */
    function nb_messages_rep($reponse, $categorie){
        $where = array('ID_reponse'=>$reponse);
        
        if($categorie != 'Erreur' && $categorie != 'Tout'){
            $where[strtolower($categorie)] = 1;
        }
        
        $args = array(
                    'champs_cibles'=>array('count(*) as nb'), 
                    'clause_where'=>$where
                );
        
        $total = execute_sql("SELECT", "messages", $args);
        $total = $total->fetch(PDO::FETCH_ASSOC);

        return $total['nb'];
    }

    /*!
     * Renvoie le nombre de messages recus pour la question recue en parametre
     *
     * \param $question : int, identifiant de la reponse dont on doit compter les messages
     * \param $categorie : string, categorie de message a selectionner
     */
    function nb_messages_quest($question, $categorie){
        $where = array('ID_question'=>$question);
        
        if($categorie != 'Erreur' && $categorie != 'Tout'){
            $where[strtolower($categorie)] = 1;
        }
        
        $where['erreur'] = 0;
        
        $args = array(
                    'champs_cibles'=>array('count(*) as nb'), 
                    'clause_where'=>$where
                );
        
        $total = execute_sql("SELECT", "messages", $args);
        $total = $total->fetch(PDO::FETCH_ASSOC);
        
        if($categorie == 'Erreur'){
            $total['nb'] = nb_erreur_quest($question);   
        }
        if($categorie == 'Tout'){
            $total['nb'] = total_messages($question);   
        }
        
        return $total['nb'];
    }

    /*!
     * Creer le menu deroulant contenant les questions recues en parametre
     *
     * \param $operation : int, identifiant de l'operation dont on veut les questions dans le dropdown
     */
    function create_dropdown($operation){
        $questions =  get_questions($operation);
        $texte = "";
        
        while($question_tab = $questions->fetch(PDO::FETCH_ASSOC)){
            $texte = htmlspecialchars($question_tab['num_question'].': '.$question_tab['texte']);
            
            echo '<li class="question"';
            echo ' onclick="affichage_question('.htmlspecialchars($question_tab['ID_operation']).'
                                                , '.htmlspecialchars($question_tab['fermee']).'
                                                , '.htmlspecialchars($question_tab['multi_rep']).'
                                                , '.htmlspecialchars($question_tab['ID']).'
                                                , \''.$texte.'\')"';
            echo '>';
            echo '<a href="#">'.$texte.'</a>';
            echo '</li>';
        }
    }

    /*!
     * Creer les barres de progression pour chaque reponse de la question recue en parametre
     *
     * \param $question : int, identifiant de la question dont on doit construire les barres
     */
    function create_progress_bars($question, $categorie='Tout'){
        $reponses = get_reponses($question);
        $total = nb_messages_quest($question, $categorie);
        $categories = array();
        
        if($categorie == 'Valide'){
            $categories = array("success"=>$categorie);
        }
        else if($categorie == 'Doublon'){
            $categories = array("default"=>$categorie);
        }
        else if($categorie == 'Retard'){
            $categories = array("warning"=>$categorie);
        }
        else if($categorie == 'Tout'){
            $categories = array("success"=>"Valide", "default"=>"Doublon", "warning"=>"Retard");
        }
        
        while($rep = $reponses->fetch(PDO::FETCH_ASSOC)){
            construct_full_bar($categories, $question, $rep['ID'], $total, $rep['texte']);
        }
        
        if($categorie == 'Tout' || $categorie == 'Erreur'){
            $categories = array("danger"=>"Erreur");
            $total = total_messages($question);
            construct_full_bar($categories, $question, null, $total, 'Erreur');
        }
    }

    /*
     * Renvoie l'entier correspondant au pourcentage de barre pour les parametres recus
     *
     * \param $question : int, identifiant de la question
     * \param $reponse : int, identifiant de la reponse concernee
     * \param $categorie : string, categorie de message dont on veut le pourcentage
     * \param $total : int, total de messages a prendre en compte
     */
    function get_pourcentage($question, $reponse, $categorie, $total){
        if($total>0){
            ($categorie!='Erreur')
            ? $pourcentage = 100*(nb_messages_rep($reponse, $categorie)/$total)
            : $pourcentage = 100*(nb_erreur_quest($question)/$total);
        }
        else{
            $pourcentage = 0;
        }

        $pourcentage = round($pourcentage);
        
        return $pourcentage;
    }

    /*
     * Creer la sous-barre de la barre principale pour la reponse et la categorie recues en parametre
     *
     * \param $pourcentage : int, pourcentage de la reponse
     * \param $reponse : int, identifiant de la reponse concernee
     * \param $progress_clas : string, classe de la progress-bar a construire
     * \param $categorie : string, categorie de message a representer
     * \param $total : int, total de messages a prendre en compte
     */
    function construct_part_bar($pourcentage, $reponse, $progress_class, $categorie, $total){
        echo
            '<div class="progress-bar progress-bar-'.$progress_class.' progress-bar-striped" style="width: '.$pourcentage.'%">
                <span class="sr-only">'.$pourcentage.'%</span>
            </div>';
    }

    /*
     * Creer la barre principale pour la reponse recue en parametre
     *
     * \param $categories : array, liste des categories a inclure dans la barre
     * \param $question : int, identifiant de la question
     * \param $reponse : int, identifiant de la reponse concernee
     * \param $total : int, total de messages a prendre en compte
     * \param $texte : string, texte a inclure dans le titre de la barre
     */
    function construct_full_bar($categories, $question, $reponse, $total, $texte){
        $pourcentage_total = 0;
        $pourcentage = 0;
        
        if($total>0){
            foreach($categories as $key=>$categ){
                $pourcentage_total += get_pourcentage($question, $reponse, $categ, $total);
            }
        }

        echo '<h4>'.$texte;

        if($pourcentage_total != 0){
            echo '<span class="label label-default" style="float: right;">'.$pourcentage_total.'%</span>';
        }

        echo '</h4><div class="progress">';

        foreach($categories as $key=>$categ){
            $pourcentage = get_pourcentage($question, $reponse, $categ, $total);
            construct_part_bar($pourcentage, $reponse, $key, $categ, $total);
        }
        echo '</div>';
    }

    /*!
     * Creer le tableau repertoriant les messages recus pour la question recue en parametre
     *
     * \param $question : int, identifiant de la question dont on doit afficher les messages
     */
    function create_messages_table($question, $nb, $page=0, $categorie='Tout', $tri='DESC'){
        $req = create_table_limit($question, $nb, $page, $categorie, $tri);
        
        if($message = $req->fetch(PDO::FETCH_ASSOC)){
            do{
                $classe = "valide_message";
                
                if($message['erreur']){
                    $classe = "erreur_message";
                }
                else if($message['retard']){
                    $classe = "retard_message";
                }
                else if($message['doublon']){
                    $classe = "doublon_message";   
                }
                
                echo '<tr class="'.$classe.'">';
                echo '<td style="text-align:center;">'.$message['num_tel'].'</td>';
                echo '<td style="text-align:center;">'.$message['texte'].'</td>';
                echo '<td style="text-align:center;">'.$message['date_reception'].'</td>';
                echo '</tr>';
            }while($message = $req->fetch(PDO::FETCH_ASSOC));
        }  

    }

    /*!
     * Renvoie le nombre de digits d'un entier
     *
     * \param $nb : int, nombre dont on doit compter les digits
     */
    function count_digit($nb) {
        return strlen((string) $nb);
    }

    /*!
     * Analyse le message recu en parametre pour detecter les erreurs avant de l'inserer dans la base de donnees
     *
     * \param $message : array à 2 champs (num_tel, texte), message envoye par l'expediteur
     */
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
        $current_question = get_current_question();
        $all_reponses = null;
        
        $question = null;
        $reponses = null;
        
        $erreur = false;
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

                if(($question['multi_rep']==1 && $nb_reponses>=1) || ($question['multi_rep']==0 && $nb_reponses==1)){

                    do{
                        $erreur = false;
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
                        insert_message($num_tel, $texte, $erreur, $ID_reponse, $ID_question);
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
            insert_message($num_tel, $texte, $erreur, $ID_reponse, $ID_question);
        }
    }

    /*!
     * Insere le message recu en parametre dans la base de donnees en effectuant les tests necessaires avant l'insertion
     *
     * \param $num_tel : string, numero de telephone de l'expediteur
     * \param $texte : string, texte envoye par l'expediteur
     * \param $erreur : bool, vaut 1 si le texte est invalide, 0 sinon
     * \param $ID_reponse : int, identifiant de la reponse concernee
     * \param $ID_question : int, identifiant de la question concernee
     */
    function insert_message($num_tel, $texte, $erreur, $ID_reponse, $ID_question){
        global $db;
        $current_question = get_current_question();
        $reponse;
        $doublon;
        $retard;
        $valide;
        $texte = htmlentities($texte);
        
        if(isset($current_question['ID'])){
            $current_question = $current_question['ID'];
            $reponse = get_reponses($current_question);
            $reponse = $reponse->fetch(PDO::FETCH_ASSOC);
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
        
        $retard = check_retard($ID_question);
        $doublon = check_doublon($num_tel, $texte, $erreur, $retard, $ID_reponse, $ID_question);
        $valide = !($erreur || $doublon || $retard);
        
        $args = array(
                    'champs_cibles'=>array('num_tel', 
                                           'texte', 
                                           'valide', 
                                           'erreur', 
                                           'doublon', 
                                           'retard', 
                                           'ID_reponse', 
                                           'ID_question'
                                    ), 
                    'clause_values'=>array('num_tel'=>$num_tel, 
                                           'texte'=>$texte, 
                                           'valide'=>$valide, 
                                           'erreur'=>$erreur, 
                                           'doublon'=>$doublon, 
                                           'retard'=>$retard, 
                                           'ID_reponse'=>$ID_reponse, 
                                           'ID_question'=>$ID_question
                                    )
                );
        
        execute_sql("INSERT", "messages", $args);
    }

    /*!
     * Renvoie un bool valant 1 si le message existe deja dans la base et 0 sinon
     *
     * \param $num_tel : string, numero de telephone de l'expediteur
     * \param $texte : string, texte envoye par l'expediteur
     * \param $erreur : bool, vaut 1 si le texte est invalide, 0 sinon
     * \param $retard : bool, vaut 1 si la question concernee est fermee, 0 sinon
     * \param $ID_reponse : int, identifiant de la reponse concernee
     * \param $ID_question : int, identifiant de la question concernee
     */
    function check_doublon($num_tel, $texte, $erreur, $retard, $ID_reponse, $ID_question){
        $args = array(
                    'clause_where'=>array('num_tel'=>$num_tel, 
                                           'texte'=>$texte, 
                                           'erreur'=>$erreur, 
                                           'retard'=>$retard, 
                                           'ID_reponse'=>$ID_reponse, 
                                           'ID_question'=>$ID_question
                                    )
                );
        
        $req = execute_sql("SELECT", "messages", $args);
        
        ($req->fetch())
        ? $doublon = true
        : $doublon = false;
        
        return $doublon;
    }

    /*!
     * Renvoie un bool valant 1 si la question est fermee et 0 sinon
     *
     * \param $ID_question : int, identifiant de la question a verifier
     */
    function check_retard($ID_question){
        $args = array(
                    'champs_cibles'=>array('fermee'),
                    'clause_where'=>array('ID'=>$ID_question)
                );
        
        $req = execute_sql("SELECT", "questions", $args);
        $req = $req->fetch(PDO::FETCH_ASSOC);
        $retard = $req['fermee'];
        
        return $retard;
    }

    /*!
     * Renvoie le tableau associatif correspondant à l'operation en cours
     */    
    function get_current_operation(){
        $args = array(
                    'clause_where'=>array('fermee'=>0)
                );
        
        $req = execute_sql("SELECT", "operations", $args);
        
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /*!
     * Renvoie le tableau associatif correspondant à la question en cours
     */
    function get_current_question(){
        $args = array(
                    'clause_where'=>array('fermee'=>0)
                );
        
        $req = execute_sql("SELECT", "questions", $args);
        
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /*!
     * Insere un message genere automatiquement dans la base de donnees
     *
     * \param $question : int, identifiant de la question concernee
     */
    function message_bot($question){
        mt_srand();
        $message = array();
        $message['num_tel'] = gen_num_tel();
        $message['texte'] = gen_texte(mt_rand(0,1), $question);
        sort_message($message);
    }

    /*!
     * Renvoie un string correspondant à un numero de telephone francais
     */
    function gen_num_tel(){
        $num_tel = '+33';
        $taille = 8;
        mt_srand();
        
        $num_tel .= (string) mt_rand(6,7);
        
        do{
            $num_tel .= (string) mt_rand(0,9);
        }while(--$taille>0);
        
        return $num_tel;
    }

    /*!
     * Renvoie un string valide ou non par rapport à la question recue en parametre
     *
     * \param $valide : bool, s'il vaut 1 le texte retour est valide, sinon il ne l'est pa
     * \param $question : int, identifiant de la question a laquelle on doit repondre
     */
    function gen_texte($valide, $question){
        $texte = "";
        $question = get_question($question);
        
        if($valide){ 
            $texte = $question['num_question'];
            $total_reponses = total_reponses($question['ID']);
            $letters = get_lettres_reponses($question['ID']);

            ($question['multi_rep'])
            ? $texte .= get_random_letters($letters, $total_reponses)
            : $texte .= get_random_letters($letters);
        }
        else{
            mt_srand();
            $taille = mt_rand(1,4);
            
            for($i=0; $i<$taille; $i++){
                $texte .= chr(mt_rand(32,126));
            }
        }
        
        return $texte;
    }

    /*!
     * Renvoie un string composé de $nb lettres prises au hasard dans $letters
     *
     * \param $letters : array, contient les lettres possibles
     * \param $nb : int, nombre de lettres a prendre
     */
    function get_random_letters($letters, $nb=1){
        shuffle($letters);
        
        $r_letters = "";
        
        for ($i = 0; $i < $nb; $i++) {
            $r_letters .= $letters[$i];
        }
        
        return $r_letters;
    }

    /*!
     * Supprimme les messages rattaches a la question recue en parametre
     *
     * \param $question : int, identifiant de la question dont les messages doivent etre supprimes
     */
    function delete_messages_quest($question){
        $args = array(
                    'clause_where'=>array('ID_question'=>$question)
                );
        
        execute_sql("DELETE", "messages", $args);
    }

     /*!
     * Renvoie l'objet PDO correspondant aux $nb messages concernant $question a partir de la $page*$nb ligne
     *
     * \param $question : int, identifiant de la question
     * \param $nb : int, nombre de resultats a renvoyer
     * \param $page : int, numero de la page
     */
    function create_table_limit($question, $nb, $page=0, $categorie='Tout', $tri='DESC'){
        $where = array('ID_question'=>$question);
        
        if($categorie!='Tout'){
            $where[strtolower($categorie)] = 1;   
        }
        
        if($categorie != 'Erreur' && $categorie != 'Tout'){
             $where['erreur']=0;   
        }
        
        $args = array(
                    'clause_where'=>$where, 
                    'clause_order_by'=>array('colonne_tri'=>'date_reception', 'ordre_tri'=>$tri), 
                    'clause_limit'=>array('ligne_depart'=>$page*$nb, 'nombre_lignes'=>$nb)
                );

        $req = execute_sql("SELECT", "messages", $args);
        
        return $req;
    }

    /*!
     * Cree le systeme de pagination du tableau
     *
     * \param $question : int, identifiant de la question
     * \param $nb : int, nombre de resultats a renvoyer
     * \param $page : int, numero de la page
     */
    function create_pagination($question, $nb, $page=0, $categorie='Tout'){
        $total = nb_messages_quest($question, $categorie);
        $hidden = 'style="visibility : hidden;"';
        $visible = 'style="visibility : visible;"';
        $previous = $visible;
        $next = $visible;
        
        if(($nb*($page+1)) >= $total){
            $next = $hidden;
        }
        
        if($page==0){
            $previous = $hidden;
        }
        
        echo'
            <button type="button" '.$previous.' onclick="previous_page()" class="btn btn-default pagination_message" id="previous_page">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </button>
            <button class="btn" type="button" id="badge_num_page">
                Page <span class="badge" id="num_page">'.($page+1).'</span>
            </button>
            <button type="button" '.$next.' onclick="next_page()" class="btn btn-default pagination_message" id="next_page">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            </button> 
        ';  
    }

    /*
     * Change le statut d'ouverture de la question recue en parametre
     *
     * \param $question : int, identifiant de la question dont le statut d'ouverture doit etre change
     */
    function open_close_quest($question){
        $fermee = get_question($question);
        $fermee = (int)$fermee['fermee'];
        
        ($fermee==1)
        ? $fermee = 0
        : $fermee = 1;
        
        $args = array(
                    'clause_set'=>array('fermee'=>$fermee), 
                    'clause_where'=>array('ID'=>$question)
                );
        
        execute_sql("UPDATE", "questions", $args);
    }

    /*
     * Pose un verrou sur les tables recues en parametre avec le type recu
     *
     * \param $tables : string ou array, liste des tables sur lesquelles poser le verrou
     * \param $type : string, type du verrou (READ ou WRITE)
     */
    function lock_sql($tables, $type){
        global $db;
        $lock = 'LOCK TABLE ';
        $valid_types = array('WRITE', 'READ');
        $type = strtoupper($type);
        
        if(in_array($type, $valid_types)){
            if(is_string($tables)){
                $lock .= $tables.' '.$type;
            }
            else if(is_array($tables)){
                $max = count($tables);
                foreach($tables as $table_name){
                    if(!empty($table_name)){
                        $lock .= $table_name.' '.$type;
                        if($tables[$max-1] != $table_name){
                            $lock .= ', ';
                        }
                    }
                }
            }
        }
        
        try{
            $lock=$db->prepare($lock);
            $lock->execute();
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
    }

    /*
     * Desactive tous les verrous actifs
     */
    function unlock_sql(){
        global $db;
        try{
            $unlock=$db->prepare('UNLOCK TABLES');
            $unlock->execute();
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
    }

    /*
     * --------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     * Renvoie la requete sql correspondant aux parametres recus.
     * Les exceptions et verrous sont gerees au sein de la fonction qui s'occupe egalement de construire la requete grace aux arguments fournis
     *
     * \param $type_operation : string, type de l'operation SQL, peut prendre 4 valeurs, SELECT / INSERT / UPDATE / DELETE
     * \param $table_cible : string, nom de la table cible
     * \param $args_operation : array, liste des arguments, peut contenir plusieurs elements selon le type de requete :
     *
     *                          - Pour une requete SELECT
     *                              # Une cle "champs_cibles" pour un array listant les colonnes cibles de la requete
     *                                  ~ "champs_cibles" => array(string, string, ...)
     *                                  ~ "champs_cibles" => array(NOM_COLONNE_1, NOM_COLONNE_2, ...)
     *                                  ~ Si non definie, la cle "champs_cibles" sera telle que "champs_cibles" => array("*")
     *
     *                              # Une cle "clause_where" pour un array listant les conditions du WHERE (s'il y en a un)
     *                                  ~ "clause_where" => array(string => type_de_la_colonne, string => type_de_la_colonne, ...)
     *                                  ~ "clause_where" => array(NOM_COLONNE_1 => VALEUR_1, NOM_COLONNE_2 => VALEUR_2, ...)
     *                                  ~ Si non definie, la cle "clause_where" sera telle que "clause_where" => ""
     *
     *                              # Une cle "clause_order_by" pour un array listant les deux conditions du ORDER BY (s'il y en a un)
     *                                  ~ "clause_order_by" => array(string => string, string => string)
     *                                  ~ "clause_order_by" => array("colonne_tri" => NOM_COLONNE, "ordre_tri" => "DESC" OU "ordre_tri" => "ASC")
     *                                  ~ Si non definie, la cle "clause_order_by" sera telle que "clause_order_by" => ""
     *
     *                              # Une cle "clause_limit" pour un array listant les deux conditions du LIMIT (s'il y en a un)
     *                                  ~ "clause_limit" => array(string => int, string => int)
     *                                  ~ "clause_limit" => array("ligne_depart" => NUMERO_LIGNE, "nombre_lignes" => NOMBRE_DE_LIGNE_A_SELECTIONNER)
     *                                  ~ Si non definie, la cle "clause_limit" sera telle que "clause_limit" => ""
     *                           
     *                              # Forme de la requete
     *                                  ~ SELECT "champs_cibles" FROM $table_cible [ WHERE "clause_where" ORDER BY "clause_order_by" LIMIT "clause_limit" ]
     *                                  ~  ------------- Obligatoire ------------   ----------------------- Lorsque cles definies ------------------------
     *
     *
     *                          - Pour une requete INSERT
     *                              # Une cle "champs_cibles" pour un array listant les colonnes cibles de la requete
     *                                  ~ "champs_cibles" => array(string, string, ...)
     *                                  ~ "champs_cibles" => array(NOM_COLONNE_1, NOM_COLONNE_2, ...)
     *                                  ~ Si non definie, la cle "champs_cibles" sera telle que "champs_cibles" => ""
     *
     *                              # Une cle "clause_values" pour un array listant les valeurs a ajouter
     *                                  ~ "clause_values" => array(string => type_de_la_colonne, string => type_de_la_colonne, ...)
     *                                  ~ "clause_values" => array(NOM_COLONNE_1 => VALEUR_1, NOM_COLONNE_2 => VALEUR_2, ...)
     *                                  ~ Si non definie, la cle "clause_values" sera telle que "clause_values" => ""
     *                           
     *                              # Forme de la requete
     *                                  ~ INSERT INTO $table_cible "champs_cibles" VALUES "clause_values"
     *                                  ~  ------------------------ Obligatoire ------------------------
     *
     *
     *                          - Pour une requete UPDATE
     *                              # Une cle "clause_set" pour un array listant les valeurs a mettre a jour
     *                                  ~ "clause_set" => array(string => type_de_la_colonne, string => type_de_la_colonne, ...)
     *                                  ~ "clause_set" => array(NOM_COLONNE_1 => VALEUR_1, NOM_COLONNE_2 => VALEUR_2, ...)
     *                                  ~ Si non definie, la cle "clause_set" sera telle que "clause_set" => ""
     *
     *                              # Une cle "clause_where" pour un array listant les conditions du WHERE
     *                                  ~ "clause_where" => array(string => type_de_la_colonne, string => type_de_la_colonne, ...)
     *                                  ~ "clause_where" => array(NOM_COLONNE_1 => VALEUR_1, NOM_COLONNE_2 => VALEUR_2, ...)
     *                                  ~ Si non definie, la cle "clause_set" sera telle que "clause_set" => ""
     *
     *                              # Forme de la requete
     *                                  ~ UPDATE $table_cible SET "clause_set" WHERE "clause_where"
     *                                  ~  --------------------- Obligatoire ---------------------
     *
     *
     *                          - Pour une requete DELETE
     *                              # Une cle "clause_where" pour un array listant les conditions du WHERE
     *                                  ~ "clause_where" => array(string => type_de_la_colonne, string => type_de_la_colonne, ...)
     *                                  ~ "clause_where" => array(NOM_COLONNE_1 => VALEUR_1, NOM_COLONNE_2 => VALEUR_2, ...)
     *                                  ~ Si non definie, la cle "clause_where" sera telle que "clause_where" => ""
     *
     *                              # Forme de la requete
     *                                  ~ DELETE FROM $table_cible WHERE "clause_where"
     *                                  ~  --------------- Obligatoire ---------------
     *
     * --------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     */
    function execute_sql($type_operation, $table_cible, $args_operation=array()){
        global $db;
        $req = "";
        
        $type_operation = strtoupper(trim($type_operation));
        $op_select = array("operation"=>"SELECT", "liaison"=>"FROM", "condition"=>"WHERE", "verrou"=>"READ");
        $op_insert = array("operation"=>"INSERT", "liaison"=>"INTO", "condition"=>"VALUES", "verrou"=>"WRITE");
        $op_update = array("operation"=>"UPDATE", "liaison"=>"SET", "condition"=>"WHERE", "verrou"=>"WRITE");
        $op_delete = array("operation"=>"DELETE", "liaison"=>"FROM", "condition"=>"WHERE", "verrou"=>"WRITE");
        $types_valides = array($op_select, $op_insert, $op_update, $op_delete);
        
        $select_valide = array("champs_cibles", "clause_where", "clause_order_by", "clause_limit");
        $insert_valide = array("champs_cibles", "clause_values");
        $update_valide = array("clause_set", "clause_where");
        $delete_valide = array("clause_where");
        $args_valides = array("SELECT"=>$select_valide, "INSERT"=>$insert_valide, "UPDATE"=>$update_valide, "DELETE"=>$delete_valide);
        
        $ordre_composantes = "";
        $args_operation_valides = ($args_operation === "");
        $operation_valide = false;
        
        foreach($types_valides as $type){
            if($type_operation == $type['operation']){
                $type_operation = $type;
                $operation_valide = true;
                
                if($args_operation_valides == 0){
                    $args_operation_valides = 1;
                    foreach($args_operation as $key=>$info){
                        $args_operation_valides *= in_array($key, $args_valides[$type['operation']]);
                    }
                } 
                
                break;
            }
        }
        
        if($type_operation['operation'] == "SELECT"){
            $champs_cibles = "";
            $clause_where = "";
            $clause_order_by = "";
            $clause_limit = "";
            
            (!isset($args_operation['champs_cibles']))
            ? $champs_cibles = array("*")
            : $champs_cibles = $args_operation['champs_cibles'];
            
            (!isset($args_operation['clause_where']))
            ? $clause_where = ""
            : $clause_where = $args_operation['clause_where'];
            
            (!isset($args_operation['clause_order_by']))
            ? $clause_order_by = ""
            : $clause_order_by = $args_operation['clause_order_by'];
            
            (!isset($args_operation['clause_limit']))
            ? $clause_limit = ""
            : $clause_limit = $args_operation['clause_limit'];
            
            if($clause_where == ""){
                $type_operation['condition'] = "";
            }

            $args_operation = array("champs_cibles"=>$champs_cibles, "clause_where"=>$clause_where, "clause_order_by"=>$clause_order_by, "clause_limit"=>$clause_limit);
        }
        else if($type_operation['operation'] == "INSERT"){
            $champs_cibles = "";
            $clause_values = "";
            
            (!isset($args_operation['champs_cibles']))
            ? $champs_cibles = ""
            : $champs_cibles = $args_operation['champs_cibles'];
            
            (!isset($args_operation['clause_values']))
            ? $clause_values = ""
            : $clause_values = $args_operation['clause_values'];

            $args_operation = array("champs_cibles"=>$champs_cibles, "clause_values"=>$clause_values);
        }
        else if($type_operation['operation'] == "UPDATE"){
            $clause_set = "";
            $clause_where = "";
            
            (!isset($args_operation['clause_set']))
            ? $clause_set = ""
            : $clause_set = $args_operation['clause_set'];
            
            (!isset($args_operation['clause_where']))
            ? $clause_where = ""
            : $clause_where = $args_operation['clause_where'];

            $args_operation = array("clause_set"=>$clause_set, "clause_where"=>$clause_where);
        }
        else{
            $clause_where = "";
            
            (!isset($args_operation['clause_where']))
            ? $clause_where = ""
            : $clause_where = $args_operation['clause_where'];
            
            if($clause_where == ""){
                $type_operation['condition'] = "";
            }

            $args_operation = array("clause_where"=>$clause_where);
        }
        
        if($operation_valide && is_string($table_cible) && trim($table_cible)!="" && $args_operation_valides){
            
            $champs = "";
            $where = "";
            $order_by = "";
            $limit = "";
            $values = "";
            $set = "";
            
            if(isset($args_operation['champs_cibles']) && !empty($args_operation['champs_cibles']) && $args_operation['champs_cibles'][0]!=""){
                $i = count($args_operation['champs_cibles']);
                if($type_operation['operation'] == "INSERT"){
                    $champs .= "(";    
                }
                foreach($args_operation['champs_cibles'] as $colonne){
                    $i--;
                    if($colonne!=""){
                        $champs .= "$colonne";
            
                        if($i>0){
                            $champs .= ", ";   
                        }
                    }
                }
                if($type_operation['operation'] == "INSERT"){
                    $champs .= ")";    
                }
            }
            
            if(isset($args_operation['clause_where']) && !empty($args_operation['clause_where'])){
                $i = count($args_operation['clause_where']);
                foreach($args_operation['clause_where'] as $colonne=>$valeur){
                    $i--;
                    if($colonne!=""){
                        $where .= "$colonne=:where_$colonne";
            
                        if($i>0){
                            $where .= " AND ";   
                        }
                    }
                }
            }                
            
            if(isset($args_operation['clause_order_by']) && !empty($args_operation['clause_order_by'])){
                $order_by = 'ORDER BY '.$args_operation['clause_order_by']['colonne_tri'].' '.$args_operation['clause_order_by']['ordre_tri'];
            }                
            
            if(isset($args_operation['clause_limit']) && !empty($args_operation['clause_limit'])){
                $limit = 'LIMIT '.$args_operation['clause_limit']['ligne_depart'].', '.$args_operation['clause_limit']['nombre_lignes'];
            }                
            
            if(isset($args_operation['clause_values']) && !empty($args_operation['clause_values'])){
                $i = count($args_operation['clause_values']);
                $values .= "(";
                foreach($args_operation['clause_values'] as $colonne=>$valeur){
                    $i--;
                    if($colonne!=""){
                        $values .= ":values_$colonne";
            
                        if($i>0){
                            $values .= ", ";   
                        }
                    }
                }
                $values .= ")";
            }                
            
            if(isset($args_operation['clause_set']) && !empty($args_operation['clause_set'])){
                $i = count($args_operation['clause_set']);
                foreach($args_operation['clause_set'] as $colonne=>$valeur){
                    $i--;
                    if($colonne!=""){
                        $set .= "$colonne=:set_$colonne";
            
                        if($i>0){
                            $set .= ", ";   
                        }
                    }
                }
            }                
            
            if($type_operation['operation'] == "SELECT"){
                $ordre_composantes = array(
                                        $type_operation['operation'], 
                                        $champs, 
                                        $type_operation['liaison'],
                                        $table_cible,
                                        $type_operation['condition'],
                                        $where,
                                        $order_by,
                                        $limit
                                    );
            }
            else if($type_operation['operation'] == "INSERT"){
                $ordre_composantes = array(
                                        $type_operation['operation'], 
                                        $type_operation['liaison'],
                                        $table_cible,
                                        $champs,
                                        $type_operation['condition'],
                                        $values
                                    );
                
                if($values == ""){
                    $ordre_composantes = "";
                }
            }
            else if($type_operation['operation'] == "UPDATE"){
                $ordre_composantes = array(
                                        $type_operation['operation'], 
                                        $table_cible,
                                        $type_operation['liaison'],
                                        $set,
                                        $type_operation['condition'],
                                        $where
                                    );
                if($set == "" || $where == ""){
                    $ordre_composantes = "";
                }
            }
            else{
                $ordre_composantes = array(
                                        $type_operation['operation'], 
                                        $type_operation['liaison'],
                                        $table_cible,
                                        $type_operation['condition'],
                                        $where
                                    );
            }
            
            if($ordre_composantes != ""){
                foreach($ordre_composantes as $composantes){
                    $req .= "$composantes ";
                }
            }

            try{
                lock_sql($table_cible, $type_operation['verrou']);
                $req = $db->prepare($req);
                
                if($type_operation['operation'] == "SELECT" || $type_operation['operation'] == "UPDATE" || $type_operation['operation'] == "DELETE"){
                    if($where != ""){
                        foreach($args_operation['clause_where'] as $colonne=>$valeur){
                            $req->bindvalue(":where_$colonne", $valeur);
                        }
                    }
                }
                
                if($type_operation['operation'] == "INSERT"){
                    if($values != ""){
                        foreach($args_operation['clause_values'] as $colonne=>$valeur){
                            $req->bindvalue(":values_$colonne", $valeur);
                        } 
                    }
                }
                
                if($type_operation['operation'] == "UPDATE"){
                    if($set != ""){
                        foreach($args_operation['clause_set'] as $colonne=>$valeur){
                            $req->bindvalue(":set_$colonne", $valeur);
                        } 
                    }
                }
                
                $req->execute();
                unlock_sql();
            }
            catch(PDOException $e){
                die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
            }
            
        }
        
        return $req;
    }
?>