<?php
function AfficheQuestionnaires()
 {
        global $db;
  $req = $db->prepare("SELECT * FROM operations WHERE ID!=1");
  $req->execute();
  echo '<table id="tableau" class="table table-striped table-hover" >';
  while($val = $req->fetch(PDO::FETCH_ASSOC))
  {
   echo'
   <tr id="'.$val['ID'].'" data-toggle="collapse" data-target=".'.$val['ID'].'" class="accordion-toggle">
        <td class="titre">'.$val['ID'].'</td>
        <td>'.$val['nom'].'</td> 
        <td class="option">
        <a href="../page_questions/questions.php?operation='.$val['ID'].'" title="Afficher les questions de ce questionnaire"><img class="show_button" src="images/afficher.png" alt="" /></a>
		<a href="../page_questions/questions.php?operation='.$val['ID'].'" title="Modifier les questions de ce questionnaire"><img class="edit_button" src="images/editer.png" alt="" /></a>
        <img class="close_button" src="images/cloturer.png" alt="" />
		<img class="export_button" src="images/exporter.png" alt="" />
        <img class="clone_button" src="images/dupliquer.png" alt="" />
        <a href="'.$val['ID'].'" data-confirm="Etes-vous certain de vouloir supprimer le questionnaire '.$val['nom'].' ?"><img class="delete_button" src="images/supprimer.png" alt="" /></a>
   </td></tr>
   <tr><td class="hiddenRow"><div class="accordian-body collapse '.$val['ID'].' ">Nombre de questions : '.total_questions($val['ID']).'</div></td>
        <td class="hiddenRow"><div class="accordian-body collapse '.$val['ID'].' ">Date de realistation prevu : '.$val['date_prevue'].'</div></td>
        <td class="hiddenRow"><div class="accordian-body collapse  '.$val['ID'].' ">Date de realistation prevu : '.$val['date_prevue'].'</div></td>
   </tr>';        
  }
  echo '</table>';
    }

function total_questions($ID_operation){
        global $db;
        $total = 0;
        
        try{
            $req=$db->prepare('SELECT count(*) as nb FROM questions WHERE ID_operation=:op');
            $req->bindvalue(':op', $ID_operation);
            $req->execute();
            $total = $req->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        return $total['nb'];
    }

    function suprimmer($ID_operation){
    global $db;
    try{
            $req=$db->prepare(' DELETE FROM operations WHERE ID='.$_GET['ID']);
            $req->bindvalue(':op', $ID_operation);
            $req->execute();
        }
        catch(PDOException $e){
            die('<p>Echec. Erreur['.$e->getCode().']: '.$e->getMessage().'</p>');
        }
        return $total['nb'];
    }

?>