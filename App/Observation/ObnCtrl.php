<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TodoCtrl
 *
 * @author thonon
 */
namespace App\Observation;

use App\Controller\BaseController;
use App\DbConnect;

class ObnCtrl extends BaseController{
    //put your code here
    public function delete($login, $setting, $action, $id, $update) {
          if(!isset($id) || !is_numeric($id)){
            throw new \Exception("Erreur dans la variable id, une erreur est survenue");
        }

        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("delete from t_obn where id = :id AND ref_id_folders = :ref_id_folders");
        if($req->execute(array("id" => $id,
                               "ref_id_folders" => $setting->getIdFolderSelected())) == false){
            throw new \Exception("Erreur dans la requête de suppression du synopsis, une erreur est survenue");
        }
        
        $this->show($login, $setting, $action, $id, $update);
    }

    public function insert($login, $setting, $action, $id, $update) {
        
        if(!isset($update['date']) || strlen($update['date']) == 0){
             throw new \Exception("Une date doit obligatoirement être fournie");
        }
        
        if(!isset($update['heure']) || strlen($update['heure']) == 0){
             throw new \Exception("Une heure doit obligatoirement être fournie");
        }
      
        if(!isset($setting)){
            throw new \Exception("Erreur dans la variable setting, une erreur est survenue");
        }
       
      
        // génération du datetime
        $datetime = $update['date'] . " " .$update['heure'];
       
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("insert into t_obn (date,rapport,ref_id_folders) values "
                . "(:date,"
                . ":rapport,"
                . ":ref_id_folders)");
      
        if($req->execute(array("date" => $datetime,
                            "rapport" => htmlspecialchars($update['rapport'], ENT_QUOTES),
                            "ref_id_folders" => $setting->getIdFolderSelected())) == false){
            throw new \Exception("Erreur dans la requête d'ajout de l'obn, une erreur est survenue");
        }
        
        $this->show($login, $setting, $action, $id, $update);
    
    }

    public function select($login, $setting, $action, $id, $update) {
        
    }
     

    public function show($login, $setting, $action, $id, $update) {
         if(!isset($setting))
            throw new \Exception("Erreur dans la variable setting, une erreur est survenue");
        
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("select *,DATE_FORMAT(date,'%d/%m/%Y à %H:%i') AS date from t_obn where ref_id_folders = :ref_id_folders");
        if($req->execute(array("ref_id_folders" => $setting->getIdFolderSelected())) == false){
            throw new \Exception("Erreur dans la requete de le sélection des synopsis");
        }
        
        $array_obn = $req->fetchAll();
       
        // appel à la vue
        require './App/Observation/ObnView.php';
    }

    public function update($login, $setting, $action, $id, $update) {
        
        if(!isset($setting))
            return; // pas d'exeption car appelé par AJAX
        
        if(!isset($_GET['checked'])){
            return; // pas d'exeption car appelé par AJAX
        }
        $checked = $_GET['checked'];
        if(strcmp(trim($checked),"true") == 0)
            $check = 1;
        else
            $check = 0;
            
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("update t_todo set statut = :checked where id = :id AND ref_id_folders = :ref_id_folders");
            
        $req->execute(array("id" => $id,
                            "checked" => $check,
                            "ref_id_folders" => $setting->getIdFolderSelected()));
        
        
       
    }

}
