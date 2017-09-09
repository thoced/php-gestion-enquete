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
                
          if($req->execute(array("numero" => $update["numero"],
                              "date_apostille" => $dateApo->format('Y-m-d'),
                              "date_in" => $dateIn->format('Y-m-d'),
                              "reference" => $update["reference"],
                              "magistrat" => $update["magistrat"],
                              "sujet" => $update["sujet"],
                              "attribue" => $update["attribue"],
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
            if($ret = $req->execute(array('numero' => $update['numero'],
                                          'date_apostille' => $dateApo->format("Y-m-d"),
                                          'date_in' => $dateIn->format("Y-m-d"),
                                          'reference' => $update['reference'],
                                          'magistrat' => $update['magistrat'],
                                          'sujet' => $update['sujet'],
                                          'attribue' => $update['attribue'],
                                          'ref_id_folders' => $update['ref_id_folders'])) == false ){
                throw new \Exception("l'insertion ne s'est pas réalisée, une erreur est survenue");
            }
          
            
            $this->show($login,$setting,$action,$id,$update);
      
        
       
    }
    
    public function show($login,$setting,$action,$id,$update)
    {
        if(!isset($setting)){
            throw new \Exception("La variable setting pose probleme, une erreur est survenue");
        }
        
                 
         if(!isset($setting)){
            throw new \Exception("La variable setting pose probleme, une erreur est survenue");
        }
        
        
        if(isset($_GET['idfolderselected']) && $_GET['idfolderselected'] != -1)
            {
            $idFolderSelected = $_GET['idfolderselected'];

            // reception des apostilles
            $db = DbConnect::getInstance();
            $req = $db->_dbb->prepare('select *,t_apostilles.id AS idApostille, DATE_FORMAT(date_apostille,"%d-%m-%Y") AS date_apostille,DATE_FORMAT(date_in,"%d-%m-%Y") AS date_in,'
                    . ' DATE_FORMAT(date_out,"%d-%m-%Y") AS date_out from t_apostilles INNER JOIN t_folders ON t_apostilles.ref_id_folders = t_folders.id where ref_id_folders IN '
                    . '(select ref_id_folders from t_link_group_folders where ref_id_group IN '
                    . '(select ref_id_group from t_link_group_users where ref_id_users = :id_user AND t_apostilles.ref_id_folders = :idFolderSelected))');
            if($req->execute(array("id_user" => $login->idUser,
                                   "idFolderSelected" => $idFolderSelected)) == false){
                throw new \Exception("la selection n'a pas eu lieu, une erreur est survenue");
            }
        }else{
             // reception des apostilles
            $db = DbConnect::getInstance();
            $req = $db->_dbb->prepare('select *,t_apostilles.id AS idApostille, DATE_FORMAT(date_apostille,"%d-%m-%Y") AS date_apostille,DATE_FORMAT(date_in,"%d-%m-%Y") AS date_in,'
                    . ' DATE_FORMAT(date_out,"%d-%m-%Y") AS date_out from t_apostilles INNER JOIN t_folders ON t_apostilles.ref_id_folders = t_folders.id where ref_id_folders IN '
                    . '(select ref_id_folders from t_link_group_folders where ref_id_group IN '
                    . '(select ref_id_group from t_link_group_users where ref_id_users = :id_user))');
            if($req->execute(array("id_user" => $login->idUser)) == false){
                throw new \Exception("la selection n'a pas eu lieu, une erreur est survenue");
            }
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
        
        echo $xml;
        
    }

}


