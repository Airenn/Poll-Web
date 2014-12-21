<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />

                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" media="screen" type="text/css" href="css/page-public.php" />
        <title>Paramètre (Provisoire)</title>
    </head>
    <body>
        <?php
        session_start();
        ?>
        <style> <!---Ceci est degueulasse et je m'en excuse soly-->
            body{
                color : <?php echo $_SESSION['color'];?>
            }
        </style>
        <h1>Salutt</h1>
        <p>cc cv toi</p>
    </body>
</html>
