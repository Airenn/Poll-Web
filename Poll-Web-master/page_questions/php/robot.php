<?php
    $_GET['operation'] = 1;
    require_once('redirect.php');  
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Robot</title>
        <link href="../../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    
    <?php
        $message = array();
        if(isset($_GET['num_tel']) && isset($_GET['texte']) && trim($_GET['num_tel'])!="" && trim($_GET['texte'])!=""){
            $message['num_tel'] = $_GET['num_tel'];
            $message['texte'] = $_GET['texte'];
            sort_message($message);
            print_r($_GET);
            unset($_GET);
        }
    ?>

    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <p><label>Numéro: </label><input type="text" name="num_tel"/></p>
            <p><label>Réponse: </label><input type="text" name="texte"/></p>
            <input type="submit"/>
        </form>
    
        <script src="../../bootstrap/dist/js/jquery.min.js"></script>
        <script src="../../bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>