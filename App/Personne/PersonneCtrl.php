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

namespace App\Personne;

require_once './App/Controller/BaseController.php';
//require_once './App/Setting/SettingModel.php';

use App\DbConnect;
use App\Controller\BaseController;

class PersonneCtrl extends BaseController
{
    
       
    public function update($login,$setting,$action,$id,$update)
    {
        if(!isset($update) || is_null($update) || !isset($id) || !is_numeric($id) || !isset($setting)){
            throw new Exception("Les variable update, id et setting posent probleme, une erreur est survenue");
        }
       // controlle sur la date de naissance
            $date = $update['date_naissance'];
            if(strlen($date) == 0){
                $date = null;
            }
        
        if(is_numeric($id)){
            $db = DbConnect::getInstance();
            $req = $db->_dbb->prepare('update t_personne set nom = :nom,prenom = :prenom,adresse = :adresse, date_naissance = :date_naissance, qualite = :qualite '
                    . 'where id = :id AND ref_id_folders = :ref_id_folders');
            if($req->execute(array('nom' =>$update['nom'], 'prenom' => $update['prenom'], 'adresse' => $update['adresse'],'date_naissance' => $date, 'qualite' => $update['qualite'],'id' => $id,'ref_id_folders' => $setting->getIdFolderSelected())) == false){
                throw new Exception("La modification n'a pas eu lieu, une erreur est survenue");
            }
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
        else{
            throw new Exception("la variable id n'est pas numérique");
        }
            
        
        $this->show($login,$setting,$action,$id,$update);
    }
    
    public function insert($login,$setting,$action,$id,$update)
    {
            if(!isset($setting)){
                throw new Exception("La variable setting pose probleme, une erreur est survenue");
            }
        
            // controlle sur la date de naissance
            $date = $update['date_naissance'];
            if(strlen($date) == 0){
                $date = null;
            }
           
            $db = DbConnect::getInstance();
            $req = $db->_dbb->prepare('insert into t_personne (nom,prenom,adresse,date_naissance,qualite,ref_id_folders) values (:nom,:prenom,:adresse,:date_naissance,:qualite,:ref_id_folders)');
            if($ret = $req->execute(array('nom' => $update['nom'], 'prenom' => $update['prenom'], 'adresse' => $update['adresse'],'date_naissance' => $date, 'qualite' => $update['qualite'],'ref_id_folders' => $setting->getIdFolderSelected())) == false ){
                throw new Exception("l'insertion ne s'est pas réalisée, une erreur est survenue");
            }
          
            
            $this->show($login,$setting,$action,$id,$update);
      
        
       
    }
    
    public function show($login,$setting,$action,$id,$update)
    {
        if(!isset($setting)){
            throw new Exception("La variable setting pose probleme, une erreur est survenue");
        }
        
         // reception des Personnes
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('select * from t_personne where ref_id_folders = :refFolder');
        if($req->execute(array('refFolder' => $setting->getIdFolderSelected())) == false){
            throw new Exception("la selection n'a pas eu lieu, une erreur est survenue");
        }
        
        // appel à la vue
        require './App/Personne/PersonneView.php';
    }
    
    public function __construct() {
        parent::__construct();
    }

    public function select($login, $setting, $action, $id, $update) {
        
    }

}


