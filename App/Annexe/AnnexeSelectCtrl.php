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
namespace App\Annexe;

//require_once './App/Controller/BaseController.php';

use App\DbConnect;
use App\Controller\BaseController;

class AnnexeSelectCtrl extends BaseController{
    //put your code here
    public function delete($login, $setting, $action, $id, $update) {
        $this->show($login, $setting, $action, $id, $update);
    }

    public function insert($login, $setting, $action, $id, $update) {
        
        // récupération du fichier
        if(!isset($_FILES) || !isset($_FILES['raw'])){
             throw new Exception("Erreur dans le chargement du fichier PDF");     
        }
        
        if($_FILES['raw']['error'] > 0){
           throw new Exception("Erreur dans le chargement du fichier PDF");
        }
        
        $filePath = $_FILES['raw']['tmp_name'];
        $file = fopen($filePath,'rb');
        $tab = fread($file, $_FILES['raw']['size']);
        fclose($file);

        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('insert into t_annexe (libelle,commentaire,raw,ref_id_document) values ('
                . ':libelle,'
                . ':commentaire,'
                . ':raw,'
                . ':ref_id_document)');
        $req->execute(array("libelle" => $update['libelle'],
                            "commentaire" => $update['commentaire'],
                            "raw" => $tab,
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
        $req = $db->_dbb->prepare('select * from t_annexe where ref_id_document = :id');
        $req->execute(array('id' => $id));
        // appel à la vue
        require './App/Annexe/AnnexeSelectView.php';
       
    }

    public function update($login, $setting, $action, $id, $update) {
        $this->show($login, $setting, $action, $id, $update);
    }

}
