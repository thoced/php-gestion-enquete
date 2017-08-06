<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContenuCtrl
 *
 * @author Thonon
 */
namespace App\Contenu;

//require_once './App/Controller/BaseController.php';

use App\DbConnect;
use App\Controller\BaseController;


class ContenuCtrl extends BaseController{
    //put your code here
    public function delete($login, $setting, $action, $id, $update) {
        $this->show($login, $setting, $action, $id, $update);
    }

    public function insert($login, $setting, $action, $id, $update) {
        $this->show($login, $setting, $action, $id, $update);
    }

    public function select($login, $setting, $action, $id, $update) {
        $this->show($login, $setting, $action, $id, $update);
    }

    public function show($login, $setting, $action, $id, $update) {
        
        if(!isset($id))
            throw new Exception("Une erreur est survenue avec la variable id");
        
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('select contenu from t_document where id = :id');
        $req->execute(array("id" => $id));
        $row = $req->fetch();
        
        $contenu = $row['contenu'];
        // appel à la vue
        require './App/Contenu/ContenuView.php';
    }

    public function update($login, $setting, $action, $id, $update) {
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('update t_document set contenu = :contenu where id = :id');
        $req->execute(array("contenu" => $update['contenu'],
                            "id" => $id));
        
        $this->show($login, $setting, $action, $id, $update);
    }

}
