<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MainCtrl
 *
 * @author Thonon
 */
require_once './App/Controller/BaseController.php';

class MainCtrl extends BaseController{
    //put your code here
    public function run($login, $setting, $action, $id, $update) {
        
        switch($action)
        {
            default:$this->showMainView($login,$setting);
                break;
        }
    }

    private function showMainView($login,$setting){
        $user = "";
        $folder = "Aucun dossier sélectionné";
        if(isset($login))
            $user = $login->login;
        if(isset($setting))
            $folder = $setting->getNomFolderSelected();
        
        require './App/Main/MainView.php';
    }
          
    public function __construct() {
        parent::__construct();
    }

}
