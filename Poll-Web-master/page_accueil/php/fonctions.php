<?php

require_once('../page_questions/php/fonctions.php');
require_once('php/connexion.php');
function AfficheQuestionnaires()
 {
    $args = array('clause_where'=>array('ID!'=>1));
        
    $req = execute_sql("SELECT", "operations", $args);
  while($val = $req->fetch(PDO::FETCH_ASSOC))
  {
   echo'
   <tr id="'.$val['ID'].'" data-toggle="collapse" data-target=".'.$val['ID'].'" class="accordion-toggle">
        <td class="titre">'.$val['nom'].'</td>
        <td>'.$val['date_prevue'].'</td> 
        <td class="option">
		<div class="options_part_1">
		<a href="../page_questions/questions.php?operation='.$val['ID'].'" title="Modifier les questions de ce questionnaire"><img class="edit_button" src="images/editer.png" alt="" /></a>
        <img class="close_button" src="images/cloturer.png" alt="" />
		</div>
		<div class="options_part_2">
		<img class="export_button" src="images/exporter.png" alt="" />
        <a href="'.$val['ID'].'" data-confirm="Etes-vous certain de vouloir supprimer le questionnaire '.$val['nom'].' ?"><img class="delete_button" src="images/supprimer.png" alt="" /></a>
		</div>
   </td></tr>
   <tr><td class="hiddenRow"><div class="accordian-body collapse '.$val['ID'].' ">Nombre de questions : '.total_questions($val['ID']).'</div></td>
        <td class="hiddenRow"><div class="accordian-body collapse '.$val['ID'].' ">Nombre de SMS recu : '.total_messages($val['ID']).'</div></td>
        <td class="hiddenRow"><div class="accordian-body collapse  '.$val['ID'].' ">Questionnaire '.ouverture_questionnaire($val['ID']).'</div></td>
   </tr>';        
  }
    }

function total_questions($ID_operation){
        global $db;
        $total = 0;
    $args = array(
                    'champs_cibles'=>array('count(*) as nb'), 
                    'clause_where'=>array('ID_question'=>$ID_operation)
                );
        
        $total = execute_sql("SELECT", "reponses", $args);
        $total = $total->fetch(PDO::FETCH_ASSOC);
        return $total['nb'];
    }

function ouverture_questionnaire($ID_operation){
        global $db;
        $total = 0;
    $args = array(
                    'champs_cibles'=>array('fermee'), 
                    'clause_where'=>array('ID'=>$ID_operation)
                );
        
        $total = execute_sql("SELECT", "operations", $args);
        $total = $total->fetch(PDO::FETCH_ASSOC);
    if($total==1)    
    return "ouvert";
    else 
    return "fermée";
    }


?>