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
        $req = $db->_dbb->prepare('select id,libelle,commentaire from t_annexe where ref_id_folders = :ref_id_folders');
        $req->execute(array('ref_id_folders' => $setting->getIdFolderSelected()));
        // appel à la vue
        require './App/Annexe/AnnexeSelectView.php';
    }

    public function update($login, $setting, $action, $id, $update) {
        $this->show($login, $setting, $action, $id, $update);
    }

}
