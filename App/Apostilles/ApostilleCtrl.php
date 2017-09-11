<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PersonneCtrl
 *
 * @author Thonon
 */

namespace App\Apostilles;

require_once './App/Controller/BaseController.php';
//require_once './App/Setting/SettingModel.php';

use App\DbConnect;
use App\Controller\BaseController;

class ApostilleCtrl extends BaseController
{
    public function cloture()
    {
        if(!isset($_POST['idCloture']) || !is_numeric($_POST['idCloture'])){
             throw new \Exception("ID de l'apostille à cloturer pose un probleme");
        }
        
      $idCloture = $_POST['idCloture'];
      $ref_cloture =  $_POST['ref_cloture'];
      $date_out = $_POST['date_out'];
      
     
      $dateCloture = \DateTime::createFromFormat('d-m-Y', $date_out);
     
      $db = DbConnect::getInstance();
      $req = $db->_dbb->prepare("update t_apostilles set "
                  . "ref_cloture = :ref_cloture,"
                  . "date_out = :date_out "
                  . "WHERE id = :id");
      $req->execute(array("ref_cloture" => $ref_cloture,
                          "date_out" => $dateCloture->format("Y-m-d"),
                          "id" => $idCloture));
      
      return false;
    }
    
       
    public function update($login,$setting,$action,$id,$update)
    {
        
        if(!isset($update) || is_null($update) || !isset($setting)){
            throw new \Exception("Les variable update, id et setting posent probleme, une erreur est survenue");
        }
       
        // conversion des dates
        $dApo = $update["date_apostille"];
        $dateApo = \DateTime::createFromFormat('d-m-Y', $dApo);
        
        $dIn = $update["date_in"];
        $dateIn = \DateTime::createFromFormat('d-m-Y', $dIn);
                
        // la variable id est envoyé en methode POST cette fois-ci
          $db = DbConnect::getInstance();
          $req = $db->_dbb->prepare("update t_apostilles set numero = :numero,"
                  . "date_apostille = :date_apostille,"
                  . "date_in = :date_in,"
                  . "reference = :reference,"
                  . "magistrat = :magistrat,"
                  . "sujet = :sujet,"
                  . "attribue = :attribue,"
                  . "ref_id_folders = :ref_id_folders "
                  . "WHERE id = :id");
                
          if($req->execute(array("numero" => htmlspecialchars($update["numero"], ENT_QUOTES),
                              "date_apostille" => $dateApo->format('Y-m-d'),
                              "date_in" => $dateIn->format('Y-m-d'),
                              "reference" => htmlspecialchars($update["reference"], ENT_QUOTES),
                              "magistrat" => htmlspecialchars($update["magistrat"], ENT_QUOTES),
                              "sujet" => htmlspecialchars($update["sujet"], ENT_QUOTES),
                              "attribue" => htmlspecialchars($update["attribue"], ENT_QUOTES),
                              "ref_id_folders" => $update["ref_id_folders"],
                              "id" => $update["id"])) == FALSE){
               echo $req->queryString;
               throw new \Exception("l'update ne s'est pas réalisée, une erreur est survenue");
          }
          
      
        
        $this->show($login,$setting,$action,$id,$update);
    }
    
    public function delete($login,$setting,$action,$id,$update)
    {
         // suppresion d'une personne
       
        if(is_numeric($id)){
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('delete from t_apostilles where id = :id');
        $req->execute(array('id' =>$id));
        }
        else{
            throw new \Exception("la variable id n'est pas numérique");
        }
            
        
        $this->show($login,$setting,$action,$id,$update);
    }
    
    public function insert($login,$setting,$action,$id,$update)
    {
            if(!isset($setting)){
                throw new \Exception("La variable setting pose probleme, une erreur est survenue");
            }
         
               // conversation des dates
        $dApo = $update["date_apostille"];
        $dateApo = \DateTime::createFromFormat('d-m-Y', $dApo);
        
        $dIn = $update["date_in"];
        $dateIn = \DateTime::createFromFormat('d-m-Y', $dIn);
           
            $db = DbConnect::getInstance();
            $req = $db->_dbb->prepare('insert into t_apostilles (numero,date_apostille,date_in,reference,magistrat,sujet,attribue,ref_id_folders) values '
                    . '(:numero,:date_apostille,:date_in,:reference,:magistrat,:sujet,:attribue,:ref_id_folders)');
            if($ret = $req->execute(array('numero' => htmlspecialchars ($update['numero'], ENT_QUOTES),
                                          'date_apostille' => $dateApo->format("Y-m-d"),
                                          'date_in' => $dateIn->format("Y-m-d"),
                                          'reference' => htmlspecialchars ($update['reference'], ENT_QUOTES),
                                          'magistrat' => htmlspecialchars ($update['magistrat'], ENT_QUOTES),
                                          'sujet' => htmlspecialchars ($update['sujet'], ENT_QUOTES),
                                          'attribue' => htmlspecialchars ($update['attribue'], ENT_QUOTES),
                                          'ref_id_folders' => $update['ref_id_folders'])) == false ){
                throw new \Exception("l'insertion ne s'est pas réalisée, une erreur est survenue");
            }
          
            
            $this->show($login,$setting,$action,$id,$update);
      
        
       
    }
    
    public function filtre(){

        if(!isset($_GET['idfolderselected'])){
            return;
        }

        $idfolderselected = $_GET['idfolderselected'];
        
        if($idfolderselected != -1){
        
            $db = DbConnect::getInstance();
            $req = $db->_dbb->prepare('select *,t_apostilles.id AS idApostille, DATE_FORMAT(date_apostille,"%d-%m-%Y") AS date_apostille,DATE_FORMAT(date_in,"%d-%m-%Y") AS date_in,'
                    . ' DATE_FORMAT(date_out,"%d-%m-%Y") AS date_out from t_apostilles INNER JOIN t_folders ON t_apostilles.ref_id_folders = t_folders.id where ref_id_folders IN '
                    . '(select ref_id_folders from t_link_group_folders where ref_id_group IN '
                    . '(select ref_id_group from t_link_group_users where ref_id_users = :id_user AND t_apostilles.ref_id_folders = :idfolderselected))');
            if($req->execute(array("id_user" => $this->login->idUser,
                                    "idfolderselected" => $idfolderselected)) == false){
                throw new \Exception("la selection n'a pas eu lieu, une erreur est survenue");
            }
        }else{
             $db = DbConnect::getInstance();
            $req = $db->_dbb->prepare('select *,t_apostilles.id AS idApostille, DATE_FORMAT(date_apostille,"%d-%m-%Y") AS date_apostille,DATE_FORMAT(date_in,"%d-%m-%Y") AS date_in,'
                    . ' DATE_FORMAT(date_out,"%d-%m-%Y") AS date_out from t_apostilles INNER JOIN t_folders ON t_apostilles.ref_id_folders = t_folders.id where ref_id_folders IN '
                    . '(select ref_id_folders from t_link_group_folders where ref_id_group IN '
                    . '(select ref_id_group from t_link_group_users where ref_id_users = :id_user))');
            if($req->execute(array("id_user" => $this->login->idUser)) == false){
                throw new \Exception("la selection n'a pas eu lieu, une erreur est survenue");
            }
        }
        
        // génération du code html qui sera retournée en asynchrone au javascript AJAX
      
         header("Content-Type: text/plain");
     
        $html = "<tr>
            <td>Numero:</td>
            <td>Nom du dossier:</td>
            <td>Date apostille:</td>
            <td>Date IN:</td>
            <td>Référence:</td>
            <td>Magistrat:</td>
            <td>Sujet:</td>
            <td>Attribué à:</td>
            <td>Référence de cloture</td>
            <td>Date OUT</td>
            <td>Cloturé ?</td>
            <td>Option</td>
        </tr>";
        
        while($row = $req->fetch()){
            $checked = "";
            if(!is_null($row['date_out'])){
            $checked = "checked";
            }
            $html .= "<tr onmouseover='mouseOver(this);' onmouseout='mouseOut(this);' onclick='selectRow(" . $row['idApostille']. ");'>"
                    . "<td>" . $row['numero'] . "</td>"
                    . "<td><b>" . $row['nom']. "</b></td>"
                    . "<td>" . $row['date_apostille'] . "</td>"
                    . "<td>" . $row["date_in"] . "</td>"
                    . "<td>" . $row["reference"] . "</td>"
                    . "<td>" . $row["magistrat"] . "</td>"
                    . "<td>" . $row["sujet"] . "</td>"
                    . "<td>" . $row["attribue"] . "</td>"
                    . "<td>" . $row["ref_cloture"] . "</td>"
                    . "<td>" . $row["date_out"] . "</td>"
                    . "<td><input " . $checked . " type='checkbox' onclick='return cloture(" . $row['idApostille'] . ");'></input></td>"
                    . '<td>' . '<a class="supprimer" class="supprimer" onclick="return verifDelete();" href="?target_link=VIEWAPOSTILLES&action=DELETE&id=' . $row['idApostille'] . '">Supprimer</a>' . '</td>'
                    . '</tr>';
        }
        // affichage
        echo $html;
        // return true pour ne pas obtenir le show
        return true;
    }
    
    public function show($login,$setting,$action,$id,$update)
    {
        if(!isset($setting)){
            throw new \Exception("La variable setting pose probleme, une erreur est survenue");
        }
        
                 
         if(!isset($setting)){
            throw new \Exception("La variable setting pose probleme, une erreur est survenue");
        }
             // reception des apostilles
            $db = DbConnect::getInstance();
            $req = $db->_dbb->prepare('select *,t_apostilles.id AS idApostille, DATE_FORMAT(date_apostille,"%d-%m-%Y") AS date_apostille,DATE_FORMAT(date_in,"%d-%m-%Y") AS date_in,'
                    . ' DATE_FORMAT(date_out,"%d-%m-%Y") AS date_out from t_apostilles INNER JOIN t_folders ON t_apostilles.ref_id_folders = t_folders.id where ref_id_folders IN '
                    . '(select ref_id_folders from t_link_group_folders where ref_id_group IN '
                    . '(select ref_id_group from t_link_group_users where ref_id_users = :id_user))');
            if($req->execute(array("id_user" => $login->idUser)) == false){
                throw new \Exception("la selection n'a pas eu lieu, une erreur est survenue");
            }
        
        
       /*   $req = $db->_dbb->prepare('select *,DATE_FORMAT(date_apostille,"%d/%m/%Y") AS date_apostille,DATE_FORMAT(date_in,"%d/%m/%Y") AS date_in,'
                . ' DATE_FORMAT(date_out,"%d/%m/%Y") AS date_out from t_apostilles where ref_id_folders IN '
                . '(select ref_id_folders from t_link_group_folders where ref_id_group IN '
                . '(select ref_id_group from t_link_group_users where ref_id_users = :id_user))');*/
        
        // recherche des dossiers associés au nom de l'utilisateur
         $db = DbConnect::getInstance();
         $reqFolders = $db->_dbb->prepare('select * from t_folders where id IN '
                 . '(select ref_id_folders from t_link_group_folders where ref_id_group IN '
                 . '(select ref_id_group from t_link_group_users where ref_id_users = :id_user))');
         if($reqFolders->execute(array("id_user" => $login->idUser)) == false){
            throw new \Exception("la selection n'a pas eu lieu, une erreur est survenue");
        }
        
        $array_folders = $reqFolders->fetchAll();
       
        // appel à la vue
        require './App/Apostilles/ApostilleView.php';
    }
    
    public function __construct() {
        parent::__construct();
    }

    public function select($login, $setting, $action, $id, $update) {
        
        // reception des apostilles
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('select *,DATE_FORMAT(date_apostille,"%d-%m-%Y") AS date_apostille,DATE_FORMAT(date_in,"%d-%m-%Y") AS date_in,'
                . ' DATE_FORMAT(date_out,"%d-%m-%Y") AS date_out from t_apostilles INNER JOIN t_folders ON t_apostilles.ref_id_folders = t_folders.id where t_apostilles.id = :id');
        if($req->execute(array("id" => $id)) == false){
            throw new \Exception("la selection n'a pas eu lieu, une erreur est survenue");
        }
        
        
        $row = $req->fetch();
        
       
        // génération du doc xml pour le retour de la sélection
        $xml = "<?xml version='1.0' encoding='UTF-8'?>"
                . "<apostille>"
                . "<numero>" . $row['numero'] . "</numero>"
                . "<date_apostille>" . $row['date_apostille'] . "</date_apostille>"
                . "<date_in>" . $row['date_in'] . "</date_in>"
                . "<reference>" . $row['reference'] . "</reference>"
                . "<magistrat>" . $row['magistrat'] . "</magistrat>"
                . "<sujet>" . $row['sujet'] . "</sujet>"
                . "<attribue>" . $row['attribue'] . "</attribue>"
                . "<ref_id_folders>" . $row['ref_id_folders'] . "</ref_id_folders>"
                . "</apostille>";

        header("Content-Type: text/xml");
        echo $xml;
        
    }

}


