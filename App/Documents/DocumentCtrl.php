<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DocumentCtrl
 *
 * @author Thonon
 */
require_once './App/Controller/BaseController.php';
require_once './App/Annexe/AnnexeSelectCtrl.php';

class DocumentCtrl extends BaseController{
    //put your code here
   
    
    public function __construct() {
        parent::__construct();
    }

    public function delete($login, $setting, $action, $id, $update) {
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('delete from t_document where id = :id ');
        $req->execute(array("id" => $id));
        // rappel à la methode show
        $this->show($login, $setting, $action, $id, $update);
    }

    public function insert($login, $setting, $action, $id, $update) {
        
    }

    public function select($login, $setting, $action, $id, $update) {
        $this->show($login, $setting, $action, $id, $update);
        
      
    }

    public function show($login, $setting, $action, $id, $update) {
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('select * from t_document inner join t_type_document ON t_document.ref_id_type = t_type_document.id where t_document.ref_id_folders = :idfolder');
        $req->execute(array("idfolder" => $setting->getIdFolderSelected()));
        // récupération des types de document
        $db = DbConnect::getInstance();
        $reqType = $db->_dbb->prepare('select * from t_type_document');
        $reqType->execute();
        // appel à la vue
        require './App/Documents/DocumentView.php';
       
    }

    public function update($login, $setting, $action, $id, $update) {
        // controle sur la date de naissance
        $date = $update['date'];
            if(strlen($date) == 0){
                $date = null;
            }
        
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("update t_document set ref_id_type = :ref_id_type, titre = :titre, commentaire = :commentaire, date = :date, reference = :reference where id = :id AND ref_id_folders = :ref_id_folders");
        $req->execute(array("ref_id_type" => $update['type'],
                            "titre" => $update['titre'],
                            "commentaire" => $update['commentaire'],
                            "date" => $date,
                            "reference" => $update['reference'],
                            "id" => $id,
                            "ref_id_folders" => $setting->getIdFolderSelected()));
        // appel à la vue
        $this->show($login, $setting, $action, $id, $update);
    }

}
