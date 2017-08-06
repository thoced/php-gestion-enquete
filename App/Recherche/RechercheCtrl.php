<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RechercheCtrl
 *
 * @author Thonon
 */
namespace App\Recherche;

require_once './App/Controller/BaseController.php';

use App\DbConnect;
use App\Controller\BaseController;
use App\Exception\ExceptionCtrl;

class RechercheCtrl extends BaseController{
    //put your code here
    public function delete($login, $setting, $action, $id, $update) {
        
    }

    public function insert($login, $setting, $action, $id, $update) {
        
    }

    public function select($login, $setting, $action, $id, $update) {
        
        if(!isset($setting))
            throw new Exception("Probleme avec la valeur setting, une erreur est survenue");
        
        if(!isset($update) || !isset($update['contenu']))
            throw new Exception("Probleme avec les valeurs de la variable update, une erreur est survenue");
        
        // recherche dans les documents liés au folder en cours
        $db = DbConnect::getInstance();
        $contenu = "%" . trim($update['contenu']) . "%";
        $req = $db->_dbb->prepare("select * from t_document inner join t_type_document ON t_document.ref_id_type = t_type_document.id where ref_id_folders = :ref_id_folders AND contenu like :contenu");
        if($req->execute(array("ref_id_folders" => $setting->getIdFolderSelected(),
                               "contenu" => $contenu)) == false)
            throw new \Exception("Une erreur est survenue dans la recherche");
        
     
        
        // appel à la vue
        require './App/Recherche/RechercheResultView.php';
        
    }

    public function show($login, $setting, $action, $id, $update) {
        
        // appel à la vue
        require './App/Recherche/RechercheView.php';
    }

    public function update($login, $setting, $action, $id, $update) {
        
    }

}
