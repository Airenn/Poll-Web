<?php
    session_start();
    header('content-type: text/css');
    function text_format_css($key){
        if(isset($_SESSION[$key]['color']) and isset($_SESSION[$key]['taille-police']) and isset($_SESSION[$key]['police'])){
            echo 'color : '.$_SESSION[$key]['color'].';';
            echo 'font-size : '.$_SESSION[$key]['taille-police'].'px;';
            echo 'font-family : '.$_SESSION[$key]['police'].'px;';
        }
    }
?>



/* TOUTE LA PAGE */

html, body
{
    height : 100%;

}

#conteneur
{
    width : 100%;
    min-height : 100%;
    position : relative;
    margin-left : auto;
    margin-right : auto;

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
    <?php if(trim($_SESSION['nbmess']['checkbox-nb-message'])!=""){?>
    margin-top : 1em;
    padding : .5em;
    padding-bottom : .3em;
    border : solid black 1px;
    border-radius : 5px;
    float : right;
    <?php text_format_css('nbmess');}
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



/* BAS DE PAGE */

footer
{
    position : relative;
    left : 2em;
}

footer p{
        <?php text_format_css('paragraphe');?>
}