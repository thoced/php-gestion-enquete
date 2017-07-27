<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AnnexeSelectCtrl
 *
 * @author Thonon
 */
require_once './App/Controller/BaseController.php';

class AnnexeSelectCtrl extends BaseController{
    //put your code here
    public function delete($login, $setting, $action, $id, $update) {
        $this->show($login, $setting, $action, $id, $update);
    }

    public function insert($login, $setting, $action, $id, $update) {
        
        // récupération du fichier
        if(!isset($_FILES) || !isset($_FILES['raw'])){
             $this->show($login, $setting, $action, $id, $update);
             die;
        }
        
        if($_FILES['raw']['error'] > 0)
        {
            $this->show($login, $setting, $action, $id, $update);
            die;
        }
        
        $filePath = $_FILES['raw']['tmp_name'];
        $file = fopen($filePath,'rb');
        $tab = fread($file, $_FILES['raw']['size']);
        fclose($file);

        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('insert into t_annexe (libelle,commentaire,raw,ref_id_folders) values ('
                . ':libelle,'
                . ':commentaire,'
                . ':raw,'
                . ':ref_id_folders)');
        $req->execute(array("libelle" => $update['libelle'],
                            "commentaire" => $update['commentaire'],
                            "raw" => $tab,
                            "ref_id_folders" => $setting->getIdFolderSelected()));
        
        $lastId = $db->_dbb->lastInsertId();
      
        
        // ajout ensuite dans la table t_link_annexe_document;
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('insert into t_link_annexe_document (ref_id_annexe,ref_id_document) values (:ref_id_annexe,:ref_id_document)');
        $req->execute(array("ref_id_annexe" => $lastId,
                            "ref_id_document" => $id));
        // appel à la vue
        $this->show($login, $setting, $action, $id, $update);
    }

    public function select($login, $setting, $action, $id, $update) {
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('select raw from t_annexe where id = :id');
        $req->execute(array("id" => $id));
        
        $row = $req->fetch();
        if(isset($row) && !is_null($row)){
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="test.pdf"');
            header('Content-Length: ' .strlen($row['raw']));
            echo $row['raw'];
        }

    }

    public function show($login, $setting, $action, $id, $update) {
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('select * from t_annexe where id IN (select ref_id_annexe from t_link_annexe_document WHERE t_link_annexe_document.ref_id_document = :id)');
        $req->execute(array('id' => $id));
        // appel à la vue
        require './App/Annexe/AnnexeSelectView.php';
       
    }

    public function update($login, $setting, $action, $id, $update) {
        $this->show($login, $setting, $action, $id, $update);
    }

}
