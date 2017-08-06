<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SynopsisCtrl
 *
 * @author Thonon
 */
namespace App\Synopsis;

use App\DbConnect;
use App\Controller\BaseController;


class SynopsisCtrl extends BaseController{
    //put your code here
    public function delete($login, $setting, $action, $id, $update) {
        
    }

    public function insert($login, $setting, $action, $id, $update) {
        if(!isset($update) || !isset($update['date']) || !isset($update['commentaire'])){
            throw new \Exception("Erreur dans la variable update, une erreur est survenue");
        }
        
        if(!isset($setting)){
            throw new \Exception("Erreur dans la variable setting, une erreur est survenue");
        }
        
        $date = $update['date'];
        if(strlen($date) == 0){
            $date = null;
        }

        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("insert into t_synopsis (date,commentaire,ref_id_folders) values (:date,:commentaire,:ref_id_folders)");
        if($req->execute(array("date" => $date,
                            "commentaire" => $update['commentaire'],
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
        $req = $db->_dbb->prepare("select * from t_synopsis where ref_id_folders = :ref_id_folders");
        if($req->execute(array("ref_id_folders" => $setting->getIdFolderSelected())) == false){
            throw new \Exception("Erreur dans la requete de le sélection des synopsis");
        }

        // appel à la vue
        require './App/Synopsis/SynopsisView.php';
    }

    public function update($login, $setting, $action, $id, $update) {
        
    }

}
