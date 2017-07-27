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
   
    public function show($login,$setting,$action,$id,$update){
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

    public function delete($login,$setting,$action,$id,$update) {
        
    }

    public function insert($login,$setting,$action,$id,$update) {
        
    }

    public function update($login,$setting,$action,$id,$update) {
        
    }

    public function select($login, $setting, $action, $id, $update) {
        
    }

}
