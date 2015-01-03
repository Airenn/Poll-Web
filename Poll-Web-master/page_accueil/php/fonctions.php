<?php
function AfficheQuestionnaires()
 {
        global $db;
  $req = $db->prepare("SELECT * FROM operations");
  $req->execute();
  echo '<table id="tableau" class="table table-striped table-hover" >';
  while($val = $req->fetch(PDO::FETCH_ASSOC))
  {
   echo'
   <tr data-toggle="collapse" data-target=".'.$val['nom'].'" class="accordion-toggle">
        <td class="titre">'.$val['ID'].'</td>
        <td>'.$val['nom'].'</td> 
        <td class="option">
        <img src="images/afficher.png" alt="" /><img class="edit" src="images/editer.png" alt="" />
        <img src="images/cloturer.png" alt="" /><img class="export" src="images/exporter.png" alt="" />
        <img src="images/dupliquer.png" alt="" />
        <a href="" data-confirm="Etes-vous certain de vouloir supprimer le questionnaire '.$val['nom'].' ?"><img class="delete" src="images/supprimer.png" alt="" /></a>
   </td></tr>
   <tr><td class="hiddenRow"><div class="accordian-body collapse '.$val['nom'].' ">Nombre de questions : '.total_questions($val['ID']).'</div></td>
        <td class="hiddenRow"><div class="accordian-body collapse '.$val['nom'].' ">Date de realistation prevu : '.$val['date_prevue'].'</div></td>
        <td class="hiddenRow"><div class="accordian-body collapse  '.$val['nom'].' ">Date de realistation prevu : '.$val['date_prevue'].'</div></td>
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