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
require_once './App/Controller/BaseController.php';

class PersonneCtrl extends BaseController
{
    
    public function run($setting,$action,$id)
    {
 
        switch($action)
        {
            case 'DELETE':echo "DELETE";$this->deletePerson($setting, $id);
                          break;
            
            default:$this->showPerson($setting);
                    break;
        }

    }
    
    private function deletePerson($setting,$id)
    {
         // suppresion d'une personne
       
        if(is_numeric($id)){
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('delete from t_personne where id = :id');
        $req->execute(array('id' =>$id));
        }
        
        $this->showPerson($setting);
    }
    
    private function showPerson($setting)
    {
         // reception des Personnes
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('select * from t_personne where ref_id_folders = :refFolder');
        $req->execute(array('refFolder' => $setting->getIdFolderSelected()));
        
        // appel à la vue
        require './App/Personne/PersonneView.php';
    }
    
    public function __construct() {
        parent::__construct();
    }

}


