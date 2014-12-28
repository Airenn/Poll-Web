<?php
    $_GET['operation'] = 2;
    require_once('redirect.php');

    $questions = get_questions($_GET['operation']);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Questions</title>
        <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    
    <body>
        <?php create_dropdown($questions); ?>
        
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Résultats</h3></div>
            <div class="panel-body" id="ajax_panel">
                
            </div>
        </div>
    
        <script src="../bootstrap/dist/js/jquery.min.js"></script>
        <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="questions.js"></script>
    </body>
</html>