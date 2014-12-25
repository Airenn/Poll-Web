<?php
    require_once ('connexion.php');
    require ('fonctions.php');

    $_GET['operation'] = 1;
    $operation = get_operation($_GET['operation']);
    $questions = get_questions($_GET['operation']);

    if(!$operation || !isset($_GET['operation'])){
        header('Location: operations.php');
        exit();
    }
    
    /*
    echo 'Operation :<ul>';
    foreach($operation as $key=>$info){
        echo '<li>'.htmlspecialchars($key).' = '.htmlspecialchars($info).'</li>';
    }
    echo '</ul>';

    echo 'Questions :';
    while($question_tab = $questions->fetch(PDO::FETCH_ASSOC)){
        echo '<ul>';
        foreach($question_tab as $key=>$info){
            echo '<li>'.htmlspecialchars($key).' = '.htmlspecialchars($info).'</li>';
        }
        echo '</ul>';
    }
    */
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Questions</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    </head>
    
    <body>
        <!-- Single button -->
        <?php create_dropdown($questions); ?>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Résultats</h3>
            </div>
            <div class="panel-body">
                
                <div class="panel panel-default">
                    <div class="panel-body" id="stats">
                        
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-body" id="infos_messages">
                        <ul class="nav nav-tabs">
                            <li role="presentation" class="messages active" id="all_messages"><a href="#">Tout</a></li>
                            <li role="presentation" class="messages" id="valid_messages"><a href="#">Valide</a></li>
                            <li role="presentation" class="messages" id="multi_messages"><a href="#">Doublon</a></li>
                            <li role="presentation" class="messages" id="wrong_messages"><a href="#">Erroné</a></li>
                            <li role="presentation" class="messages" id="late_messages"><a href="#">Hors-délai</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="questions.js"></script>
    </body>
</html>