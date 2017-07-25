<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PersonneCtrl
 *
 * @author Thonon
 */
class PersonneCtrl 
{
    private $setting;
    
    private function run()
    {
        
        
        
        // reception des Personnes
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('select * from t_personne where ref_id_folders = :refFolder');
        $req->execute(array('refFolder' => $this->setting->getIdFolderSelected()));
               
        // appel à la vue
        require './App/Personne/PersonneView.php';
    }
    
    function __construct($setting) {
        $this->setting = $setting;
        $this->run();
    }
}


