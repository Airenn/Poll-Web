<?php
            /*********************//**FORMATAGE-DE-TEXTE**//*********************/
            if(isset($_POST['radio-f-d-t']) and $_POST['radio-f-d-t']==='question')
                text_format('question','form_question');
            if(isset($_POST['radio-f-d-t']) and $_POST['radio-f-d-t']==='reponse')
                text_format('reponse','form_reponse');
            if(isset($_POST['radio-f-d-t']) and $_POST['radio-f-d-t']==='nbmess')
                text_format('nbmess','form_nbmess');
            if(isset($_POST['radio-f-d-t']) and $_POST['radio-f-d-t']==='paragraphe')
                text_format('paragraphe','form_paragraphe');
            unset($_SESSION['nbmess']['checkbox']);
            if(isset($_POST['checkbox']) and trim($_POST['checkbox']!="")){
                $_SESSION['nbmess']['checkbox']=$_POST['checkbox'];
            }
            else
                $_SESSION['nbmess']['checkbox']="";


            /**********************//**NUMERO-TELEPHONE**//***********************/
            $tel = '#^(0|\+33) ?[6-7]([ -\.]?[0-9]{2}){4}$#';            
            isset($_POST['tel']) ? preg_match($tel,$_POST['tel']) ? $_SESSION['paragraphe']['tel']=$_POST['tel'] : "" : $_SESSION['paragraphe']['tel']='06 xx xx xx xx';


            /*************************//**ARRIERE-PLAN**//*************************/
            unset($_SESSION['arriere-plan']['color']);
            unset($_SESSION['arriere-plan']['file']);
            if(isset($_POST['radio-a-b']) and $_POST['radio-a-b']==='arriere-plan'){
                if(isset($_POST['radio-a']) and $_POST['radio-a']==="image"){
                    $_SESSION['arriere-plan']['radio-a']="image";
                    if ($_FILES['file']['error'] > 0)
                        echo "Error: " . $_FILES['file']['error'] . "<br/>"; 
                    else
                    { 
                        move_uploaded_file($_FILES["file"]["tmp_name"],"images/".$_FILES["file"]["name"]);
                        $_SESSION['arriere-plan']['file']="images/".$_FILES["file"]["name"];
                    }
                }
                elseif(isset($_POST['radio-a']) and $_POST['radio-a']==="color"){
                    $_SESSION['arriere-plan']['radio-a']="color";
                    if(isset($_POST['arriere-plan-color'])){
                        $_SESSION['arriere-plan']['color']=$_POST['arriere-plan-color'];
                    }
                }
            }


            /**********************//**BARRE-PROGRESSIVE**//***********************/
            if(isset($_POST['radio-a-b']) and $_POST['radio-a-b']=='barre-progressive'){
                if(isset($_POST['hors-delai'])){
                     $_SESSION['barre-progressive']['hors-delai']=$_POST['hors-delai'];
                }
                else{
                    $_SESSION['barre-progressive']['hors-delai']="off";
                }
                if(isset($_POST['bar-color'])){
                    $_SESSION['barre-progressive']['color']=$_POST['bar-color'];
                }
                if(isset($_POST['offline-color'])){
                    $_SESSION['barre-progressive']['offline-color']=$_POST['offline-color'];
                }
            }

?>
            