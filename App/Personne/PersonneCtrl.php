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
require_once './App/Setting/SettingModel.php';

class PersonneCtrl extends BaseController
{
    
       
    public function update($login,$setting,$action,$id,$update)
    {
       // controlle sur la date de naissance
            $date = $update['date_naissance'];
            if(strlen($date) == 0){
                $date = null;
            }
        
        if(is_numeric($id)){
            $db = DbConnect::getInstance();
            $req = $db->_dbb->prepare('update t_personne set nom = :nom,prenom = :prenom,adresse = :adresse, date_naissance = :date_naissance, qualite = :qualite '
                    . 'where id = :id');
            $req->execute(array('nom' =>$update['nom'], 'prenom' => $update['prenom'], 'adresse' => $update['adresse'],'date_naissance' => $date, 'qualite' => $update['qualite'],'id' => $id));
        }
        
        $this->show($login,$setting,$action,$id,$update);
    }
    
    public function delete($login,$setting,$action,$id,$update)
    {
         // suppresion d'une personne
       
        if(is_numeric($id)){
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('delete from t_personne where id = :id');
        $req->execute(array('id' =>$id));
        }
        
        $this->show($login,$setting,$action,$id,$update);
    }
    
    public function insert($login,$setting,$action,$id,$update)
    {
        
            // controlle sur la date de naissance
            $date = $update['date_naissance'];
            if(strlen($date) == 0){
                $date = null;
            }
           
            $db = DbConnect::getInstance();
            $req = $db->_dbb->prepare('insert into t_personne (nom,prenom,adresse,date_naissance,qualite,ref_id_folders) values (:nom,:prenom,:adresse,:date_naissance,:qualite,:ref_id_folders)');
            $ret = $req->execute(array('nom' => $update['nom'], 'prenom' => $update['prenom'], 'adresse' => $update['adresse'],'date_naissance' => $date, 'qualite' => $update['qualite'],'ref_id_folders' => $setting->getIdFolderSelected()));
          
            
            $this->show($login,$setting,$action,$id,$update);
      
        
       
    }
    
    public function show($login,$setting,$action,$id,$update)
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

    public function select($login, $setting, $action, $id, $update) {
        
    }

}


