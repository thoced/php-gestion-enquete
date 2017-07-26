<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseController
 *
 * @author Thonon
 */
abstract class BaseController 
{
    abstract public function run($setting,$action,$id,$update);
    
    public function __construct() 
    {
        // pompe à récupération d'information
        $setting = new SettingModel();
        $action = null;
        $id = null;
        $update = array();
        
        if(isset($_SESSION['SETTING'])){
            $setting->unserialize($_SESSION['SETTING']);
        }
        
        if(isset($_GET['action'])){
            $action = $_GET['action'];
        }
        
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        
        if(isset($_POST)){
            $update = $_POST;
        }
        
        // appel au methode run des enfants
        $this->run($setting,$action,$id,$update);
    }
}
