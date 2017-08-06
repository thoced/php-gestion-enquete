<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DocumentCtrl
 *
 * @author Thonon
 */

namespace App\Documents;

//require_once './App/Controller/BaseController.php';
//require_once './App/Annexe/AnnexeSelectCtrl.php';

use App\DbConnect;
use App\Controller\BaseController;

class DocumentCtrl extends BaseController{
    //put your code here
   
    
    public function __construct() {
        parent::__construct();
    }

    public function delete($login, $setting, $action, $id, $update) {
        if(!isset($id) || !is_numeric($id)){
            throw new \Exception("La variable id est vide ou n'est pas numérique");
        }
        
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('delete from t_document where id = :id ');
        if($req->execute(array("id" => $id)) == false)
            throw new \Exception ("Suppresion non réalisée, une erreur est survenue");
        // rappel à la methode show
        $this->show($login, $setting, $action, $id, $update);
        
    }

    public function insert($login, $setting, $action, $id, $update) {
        
        if(!isset($setting)){
            throw new \Exception("La variable setting pose probleme, une erreur est survenue");
        }
         if(!isset($update)){
            throw new \Exception("La variable update pose probleme, une erreur est survenue");
        }
        
        // controlle sur la date de naissance
        $date = $update['date'];
        if(strlen($date) == 0){
            $date = null;
        }
        
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('insert into t_document (ref_id_type,titre,commentaire,date,reference,ref_id_folders) values('
                . ':ref_id_type,'
                . ':titre,'
                . ':commentaire,'
                . ':date,'
                . ':reference,'
                . ':ref_id_folders)');
        if($req->execute(array("ref_id_type" => $update['type'],
                            "titre" => $update['titre'],
                            "commentaire" => $update['commentaire'],
                            "date" => $date,
                            "reference" => $update['reference'],
                            "ref_id_folders"  => $setting->getIdFolderSelected())) == false){
            
             throw new \Exception("L'insertion n'a pas eu lieu, une erreur est survenue");
        } 
        
         $this->show($login, $setting, $action, $id, $update);
    }

    public function select($login, $setting, $action, $id, $update) {
        $this->show($login, $setting, $action, $id, $update);
        
      
    }

    public function show($login, $setting, $action, $id, $update) {
        
        if(!isset($setting) || is_null($setting))
            throw new \Exception ("Probleme avec la variable setting");
        
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('select * from t_document inner join t_type_document ON t_document.ref_id_type = t_type_document.id where t_document.ref_id_folders = :idfolder');
        if($req->execute(array("idfolder" => $setting->getIdFolderSelected())) == false)
            throw new \Exception ("Lecteur des documents non réalisée, une erreur est survenue");
        // récupération des types de document
        $db = DbConnect::getInstance();
        $reqType = $db->_dbb->prepare('select * from t_type_document');
        if($reqType->execute() == false)
            throw new \Exception ("Lecteur des types de document non réalisée, une erreur est survenue");
        // appel à la vue
        require './App/Documents/DocumentView.php';
       
    }

    public function update($login, $setting, $action, $id, $update) {
        // controle sur la date de naissance
        if(!isset($id) || !is_numeric($id) || !isset($setting))
            throw new \Exception("La variable id ou la variable setting (est/sont) null ou non numérique(s)");
        
        $date = $update['date'];
            if(strlen($date) == 0){
                $date = null;
            }
        
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("update t_document set ref_id_type = :ref_id_type, titre = :titre, commentaire = :commentaire, date = :date, reference = :reference where id = :id AND ref_id_folders = :ref_id_folders");
        if($req->execute(array("ref_id_type" => $update['type'],
                            "titre" => $update['titre'],
                            "commentaire" => $update['commentaire'],
                            "date" => $date,
                            "reference" => $update['reference'],
                            "id" => $id,
                            "ref_id_folders" => $setting->getIdFolderSelected())) == false){
            throw new \Exception("Erreur dans la modification des données, une erreur est survenue");
        }
                
        // appel à la vue
        $this->show($login, $setting, $action, $id, $update);
    }

}
