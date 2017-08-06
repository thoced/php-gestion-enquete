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
require_once './App/Controller/BaseController.php';

class RechercheCtrl extends BaseController{
    //put your code here
    public function delete($login, $setting, $action, $id, $update) {
        
    }

    public function insert($login, $setting, $action, $id, $update) {
        
    }

    public function select($login, $setting, $action, $id, $update) {
        
        
        $this->show($login, $setting, $action, $id, $update);
        
    }

    public function show($login, $setting, $action, $id, $update) {
        
        // appel à la vue
        require './App/Recherche/RechercheView.php';
    }

    public function update($login, $setting, $action, $id, $update) {
        
    }

}
