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
namespace App\Todo;

use App\Controller\BaseController;
use App\DbConnect;

class TodoCtrl extends BaseController{
    //put your code here
    public function delete($login, $setting, $action, $id, $update) {
        
    }

    public function insert($login, $setting, $action, $id, $update) {
        
        if(!isset($update['date_creation']) || strlen($update['date_creation']) == 0){
             throw new \Exception("Une date de création doit obligatoirement être fournie");
        }
        
        if(!isset($update) || !isset($update['date_creation']) || !isset($update['date_rappel'])){
            throw new \Exception("Erreur dans la variable update, une erreur est survenue");
        }
        
        if(!isset($setting)){
            throw new \Exception("Erreur dans la variable setting, une erreur est survenue");
        }
        
        $date_rappel = $update['date_rappel'];
        if(strlen($date_rappel) == 0){
            $date_rappel = null;
        }
        
                     
       // $commentaire = preg_replace("#[^a-zA-Z àéè!?;:()-+=/' ]#", "", $update['commentaire']);
        $libelle = strip_tags($update['libelle']);
        $commentaire = strip_tags($update['commentaire']);

        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("insert into t_todo (libelle,commentaire,date_creation,date_rappel,statut,ref_id_folders) values "
                . "(:libelle,"
                . ":commentaire,"
                . ":date_creation,"
                . ":date_rappel,"
                . ":statut,"
                . ":ref_id_folders)");
        
        $statut = true;
        
        if($req->execute(array("libelle" => $libelle,
                            "commentaire" => $commentaire,
                            "date_creation" => $update['date_creation'],
                            "date_rappel" => $date_rappel,
                            "statut"      => $statut,
                            "ref_id_folders" => $setting->getIdFolderSelected())) == false){
            throw new \Exception("Erreur dans la requête d'ajout du synopsis, une erreur est survenue");
        }
        
        $this->show($login, $setting, $action, $id, $update);
    
    }

    public function select($login, $setting, $action, $id, $update) {
        
    }

    public function show($login, $setting, $action, $id, $update) {
         if(!isset($setting))
            throw new \Exception("Erreur dans la variable setting, une erreur est survenue");
        
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("select * from t_todo where ref_id_folders = :ref_id_folders");
        if($req->execute(array("ref_id_folders" => $setting->getIdFolderSelected())) == false){
            throw new \Exception("Erreur dans la requete de le sélection des synopsis");
        }
        
                
        // appel à la vue
        require './App/Todo/TodoView.php';
    }

    public function update($login, $setting, $action, $id, $update) {
        
    }

}
