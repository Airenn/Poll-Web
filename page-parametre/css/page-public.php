<?php
    session_start();
    header('content-type: text/css');
?>

 body
{
    color : <?php echo $_SESSION['color'];?>;
    font-size : <?php echo $_SESSION['taille-police'];?>px;
    font-family : <?php echo $_SESSION['police'];?>;
}