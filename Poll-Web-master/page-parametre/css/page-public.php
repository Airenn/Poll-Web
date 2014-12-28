<?php
    require('../php/fonctions.php');
    session_start();
    header('content-type: text/css');
?>



/* TOUTE LA PAGE */

html, body
{
    height : 100%;
    <?php  
        if(isset($_SESSION['arriere-plan']['radio-a'])){
            if($_SESSION['arriere-plan']['radio-a']=="image" and isset($_SESSION['arriere-plan']['file']))
                echo 'background-image:url(../'.$_SESSION['arriere-plan']['file'].');'; 
        }
    ?>
}

#conteneur
{
    width : 100%;
    min-height : 100%;
    position : relative;
    margin-left : auto;
    margin-right : auto;
    <?php
        if(isset($_SESSION['arriere-plan']['radio-a']) and isset($_SESSION['arriere-plan']['color']) ){         
            if($_SESSION['arriere-plan']['radio-a']=="color"){
                echo 'background-color:'.$_SESSION['arriere-plan']['color'].';'; 
            }
        }
    ?>
}



/* HAUT DE PAGE */

header
{
    width : 98%;
    margin-left : auto;
    margin-right : auto;
}

#question
{
    padding : .3em 79% .3em .3em;
    border : solid black 1px;
    border-radius : 5px;
    float : left;
    <?php text_format_css('question');?>
}

#nbmsg
{
    margin-top : 1em;
    padding : .5em;
    padding-bottom : .3em;
    border : solid black 1px;
    border-radius : 5px;
    float : right;

    <?php 
    if(isset($_SESSION['nbmess']['checkbox']) and $_SESSION['nbmess']['checkbox']=="on")
        text_format_css('nbmess');
    else 
        echo 'display : none;';
    ?>
}

#nbmsg #nbrecus
{
    text-align : center;
    margin-bottom : 0;
}



/* BLOC PRINCIPAL */

section
{
    margin-left : 2em;
    clear : both;
}

.rep
{
    margin-bottom : 4em;
    <?php text_format_css('reponse');?>
}

.rep:last-child
{
    margin-bottom : 8em;
}

.progress-bar.progress-bar-striped{
    <?php
        if(isset($_SESSION['barre-progressive']['color']))
            echo 'background-color:'.$_SESSION['barre-progressive']['color'].';';
    ?>
}
.progress-bar.progress-bar-warning.progress-bar-striped.active{
    <?php
        if(isset($_SESSION['barre-progressive']['offline-color']))
            echo 'background-color:'.$_SESSION['barre-progressive']['offline-color'].';';
    ?>
}

/* BAS DE PAGE */

footer
{
    position : relative;
    left : 2em;
}

footer p{
        <?php text_format_css('paragraphe');?>
}