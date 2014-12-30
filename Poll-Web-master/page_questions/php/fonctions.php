<?php
    /*!
     * Renvoie le tableau associatif correspondant a l'operation recue en parametre
     *
     * \param $operation : int, identifiant de l'operation que l'on veut recuperer
     */    
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

    /*!
     * Renvoie l'objet PDO correspondant aux questions pour l'operation recue en parametre
     *
     * \param $operation : int, identifiant de l'operation dont on doit recuperer les questions
     */
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

    /*!
     * Renvoie le tableau associatif correspondant a la question recue en parametre
     *
     * \param $question : int, identifiant de la question que l'on veut recuperer
     */
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

    /*!
     * Renvoie le tableau associatif correspondant au numero de question et a l'operation recues en parametre
     *
     * \param $num_question : int, numero de la question que l'on veut recuperer
     * \param $operation : int, identifiant de l'operation que l'on veut recuperer
     */
    function get_question_num($num_question, $operation){
        global $db;
        try{
            $req=$db->prepare('SELECT * FROM questions WHERE num_question=:quest AND ID_operation=:op');
            $req->bindvalue(':quest', $num_question);
            $req->bindvalue(':op', $operation);
            $req->execute();
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /*!
     * Renvoie l'objet PDO correspondant aux reponses pour la question recue en parametre
     *
     * \param $question : int, identifiant de la question dont on doit recuperer les reponses
     */
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
    function get_messages($question, $categorie='Tout'){
        global $db;
        try{
            $req='SELECT * FROM messages WHERE ID_question=:question';
            
            if($categorie=='Valide'){
                $req .= ' AND valide=1';
            }
            else if($categorie=='Erreur'){
                $req .= ' AND erreur=1';
            }
            else if($categorie=='Doublon'){
                $req .= ' AND doublon=1';
            }
            else if($categorie=='Retard'){
                $req .= ' AND retard=1';
            }

            $req = $db->prepare($req);
            $req->bindvalue(':question', $question);
            $req->execute();
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        return $req;
    }

    /*!
     * Renvoie le nombre de reponses pour la question recue en parametre
     *
     * \param $question : int, identifiant de la question dont on doit compter les reponses
     */
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

    /*!
     * Renvoie le nombre de messages recus pour la question recue en parametre
     *
     * \param $question : int, identifiant de la question dont on doit compter les messages
     */
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

    /*!
     * Renvoie le nombre de messages recus pour la reponse recue en parametre
     *
     * \param $reponse : int, identifiant de la reponse dont on doit compter les messages
     */
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

    /*!
     * Creer le menu deroulant contenant les questions recues en parametre
     *
     * \param $questions : objet PDO, correspond a une liste de question recuperee par un SELECT
     */
    function create_dropdown($questions){
        while($question_tab = $questions->fetch(PDO::FETCH_ASSOC)){
            echo'<li class="question" value="'.htmlspecialchars($question_tab['ID']).'">
                    <a href="#">'.htmlspecialchars($question_tab['num_question']).": ".htmlspecialchars($question_tab['texte']).'</a>
                </li>';
        }
    }

    /*!
     * Creer les barres de progression pour chaque reponse de la question recue en parametre
     *
     * \param $question : int, identifiant de la question dont on doit construire les barres
     */
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

    /*!
     * Creer le tableau repertoriant les messages recus pour la question recue en parametre
     *
     * \param $question : int, identifiant de la question dont on doit afficher les messages
     */
    function create_messages_table($question, $categorie='Tout'){
        $req = get_messages($question, $categorie);
        $colonnes = array('Numéro de téléphone', 'Message', 'Date de réception');
        
        echo '<thead><tr>';
            foreach($colonnes as $key){
                echo '<th class="col-md-2">'.$key.'</th>';
            }
        echo '</tr></thead>';
        
        if($message = $req->fetch(PDO::FETCH_ASSOC)){

            do{
                $classe = "success";
                
                if($message['erreur']){
                    $classe = "danger";
                }
                else if($message['retard']){
                    $classe = "warning";
                }
                else if($message['doublon']){
                    $classe = "default";   
                }
                
                echo '<tr class="'.$classe.'">';
                echo '<td>'.$message['num_tel'].'</td>';
                echo '<td>'.$message['texte'].'</td>';
                echo '<td>'.$message['date_reception'].'</td>';
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

    /*!
     * Renvoie un bool valant 1 si la question est fermee et 0 sinon
     *
     * \param $ID_question : int, identifiant de la question a verifier
     */
    function check_retard($ID_question){
        global $db;
        $req;
        $retard;
        
         try{
            $req=$db->prepare('SELECT fermee FROM questions WHERE ID=:quest');
            $req->bindvalue(':quest', $ID_question);
            $req->execute();
            $req = $req->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        
        $retard = $req['fermee'];
        
        return $retard;
    }

    /*!
     * Renvoie le tableau associatif correspondant à l'operation en cours
     */    
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

    /*!
     * Renvoie le tableau associatif correspondant à la question en cours
     */
    function get_current_question(){
        global $db;
        try{
            $req=$db->prepare('SELECT * FROM questions WHERE fermee=0');
            $req->execute();
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /*!
     * Insere un message genere automatiquement dans la base de donnees
     */
    function message_bot(){
        mt_srand();
        if(isset($_GET['robot_actif']) && $_GET['robot_actif']==1){
            $message = array();
            $message['num_tel'] = gen_num_tel();
            $message['texte'] = gen_texte(mt_rand(0,1));
            sort_message($message);
        }
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
     * Renvoie un string valide ou non par rapport à la question en cours
     *
     * \param $valide : bool, s'il vaut 1 le texte retour est valide, sinon il ne l'est pas
     */
    function gen_texte($valide){
        $texte = "";
        $current_question = get_current_question();
        
        if($valide){ 
            if(!isset($current_question['ID']) || trim($current_question['ID'])==""){
                $current_operation = get_current_operation();
                $questions = get_num_questions($current_operation['ID']);
                shuffle($questions);
                $current_question = get_question_num($questions[0], $current_operation['ID']);
            }
            
            $texte = $current_question['num_question'];
            $total_reponses = total_reponses($current_question['ID']);
            $letters = get_lettres_reponses($current_question['ID']);

            ($current_question['multi_rep'])
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
        global $db;
         try{
            $req=$db->prepare('DELETE FROM messages WHERE ID_question=:quest');
            $req->bindvalue(':quest', $question);
            $req->execute();
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        
    }
?>