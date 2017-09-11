<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FolderCtrl
 *
 * @author Thonon
 */
namespace App\Folder;

//require_once './App/Controller/BaseController.php';

use App\Controller\BaseController;
use App\DbConnect;


class FolderCtrl extends BaseController{
    //put your code here
    
    public function showNewFolder(){
        
        // recherche des owner
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("select * from t_users");
        $req->execute();
        
        // recherche des groupes
        $db = DbConnect::getInstance();
        $reqGroup = $db->_dbb->prepare("select * from t_group");
        $reqGroup->execute();
        
    // appel à la vue
        require './App/Folder/AddFolderView.php';
        return true;
    }
    
    public function addfaits(){
        if(!isset($this->update)){
             throw new \Exception("Erreur dans la variable update, une erreur est survenue");
        }
        
        if(!isset($this->update['fait'])){
             throw new \Exception("Erreur dans la variable update, il manque la valeur fait");
        }
        if(!isset($this->update['ref_id_folders'])){
             throw new \Exception("Erreur dans la variable update, il manque la valeur ref_id_folders");
        }
        if(!isset($this->update['date_basse'])){
             throw new \Exception("Erreur dans la variable update, il manque la valeur date_basse");
        }
        if(!isset($this->update['date_haute'])){
             throw new \Exception("Erreur dans la variable update, il manque la valeur date_haute");
        }
        if(!isset($this->update['pv'])){
             throw new \Exception("Erreur dans la variable update, il manque la valeur pv");
        }
        
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("insert into t_faits (ref_id_listfaits,ref_id_folders,date_basse,date_haute,pv) VALUES "
                                . "(:ref_id_listfaits,:ref_id_folders,:date_basse,:date_haute,:pv)");

        $date_basse = null;
        $date_haute = null;
        if(strlen($this->update['date_basse']) != 0){
            $date_basse = $this->update['date_basse'];
        }
        if(strlen($this->update['date_haute']) != 0){
            $date_haute = $this->update['date_haute'];
        }
        

        if($req->execute(array("ref_id_listfaits" => $this->update['fait'],
                               "ref_id_folders" => $this->update['ref_id_folders'],
                               "date_basse" => $date_basse,
                               "date_haute" => $date_haute,
                               "pv" => $this->update['pv'])) == false){
            throw new \Exception("Erreur dans l'ajout  du fait, une erreur est survenue");
        }
        
        $this->id = $this->update['ref_id_folders'];
        $this->faits();
    }
    
    public function delfaits(){
        
      if(!isset($this->id)){
          throw new \Exception("Erreur dans la variable id, un erreur est survenue");
      }
      
      if(!is_numeric($this->id)){
          throw new \Exception("La variable id n'est pas numérique, un erreur est survenue");
      }
      
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("delete from t_faits where id = :id");
        if($req->execute(array("id" => $this->id)) == false){
            throw new \Exception("Erreur dans la suppression du fait, une erreur est survenue");
        }
        
        if(isset($_GET['ref_id_folders'])){
               $this->id = $_GET['ref_id_folders'];
        }
        
        $this->faits();
    }
    
    public function faits(){
        

      if(!isset($this->id)){
          throw new \Exception("Erreur dans la variable id, un erreur est survenue");
      }
      
      if(!is_numeric($this->id)){
          throw new \Exception("La variable id n'est pas numérique, un erreur est survenue");
      }
      
       $ref_id_folders = $this->id;
      
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("select *,DATE_FORMAT(date_basse,'%d/%m/%Y') AS date_basse, DATE_FORMAT(date_haute,'%d/%m/%Y') AS date_haute from t_faits INNER JOIN t_listfaits ON t_faits.ref_id_listfaits = t_listfaits.id where t_faits.ref_id_folders = :ref_id_folders");
        if($req->execute(array("ref_id_folders" => $this->id)) == false){
            throw new \Exception("Erreur dans la sélection des faits, une erreur est survenue");
        }
        
        $db = DbConnect::getInstance();
        $reqListFait = $db->_dbb->prepare("select * from t_listfaits");
        if($reqListFait->execute() == false){
            throw new \Exception("Erreur dans la sélection de la liste des faits, une erreur est survenue");
        }
     
        // appel à la vue
        require './App/Folder/FaitsView.php';
    }
    
    public function filtre(){
        
         if(!isset($_GET['idgroupselected'])){
            return;
        }

        $idgroupselected = $_GET['idgroupselected'];
        
        $db = DbConnect::getInstance();
               
        if($idgroupselected == -1){
        
        $req = $db->_dbb->prepare("select DISTINCT * from t_folders where t_folders.id IN "
                 . "(select t_link_group_folders.ref_id_folders from t_link_group_folders where t_link_group_folders.ref_id_group IN "
                 . "(select t_link_group_users.ref_id_group from t_link_group_users where t_link_group_users.ref_id_users = (select t_users.id from t_users where login = :login))) AND t_folders.visible = TRUE");
        
        if($req->execute(array("login" => $this->login->login)) == false){
            throw new \Exception("Erreur dans la selection des dossiers, une erreur est survenue");
           }
           
        }else{
            $req = $db->_dbb->prepare("select DISTINCT * from t_folders where t_folders.id IN "
                 . "(select t_link_group_folders.ref_id_folders from t_link_group_folders where t_link_group_folders.ref_id_group = :idgroupselected AND t_link_group_folders.ref_id_group IN "
                 . "(select t_link_group_users.ref_id_group from t_link_group_users where t_link_group_users.ref_id_users = (select t_users.id from t_users where login = :login))) AND t_folders.visible = TRUE");
            
           if($req->execute(array("idgroupselected" => $idgroupselected,
                                  "login" => $this->login->login)) == false){
            throw new \Exception("Erreur dans la selection des dossiers, une erreur est survenue");
           }
            
        }

        
       
        
        $array_folder = $req->fetchAll();
        
        header("Content-Type: text/plain");
     
        $html = "<tr>
        <td>Num</td>
        <td>Nom</td>
        <td>Commentaire</td>
        </tr>";
        
        $i=1;
        foreach($array_folder as $folder){
            $html .= "<tr onmouseover='mouseOver(this);' onmouseout='mouseOut(this);'>"
            . "<td>" . $i. "</td>" // 0 au lieu de id car la requete récupère plusieurs types d'id
            . "<td>" . $folder['nom'] . "</td>"
            . "<td><a onclick='copyClipboard(this);'href='#'>" . substr($folder['commentaire'],0,16) . " ...<span class='infoBulle'>"  .$folder['commentaire'] . "</span></td>"
                . "<td><a class='contenu' href='?target_link=VIEWDOSSIERS&action=SELECT&id=" . $folder[0]."'>Cliquez ici pour sélectionner</a>"
                . "<td><a class='contenu' href='?target_link=VIEWDOSSIERS&action=FAITS&id=" . $folder[0]."'>Faits</a>"   
            . "</tr>";
            
            $i++;
        }
        
        
        echo $html;
         // return true pour ne pas obtenir le show
        return true;
        
    }
    
    public function show($login,$setting,$action,$id,$update)
    {
        if(!isset($login)){
            throw new \Exception("La variable login est vide, une erreur est survenue");
        }
        
        $db = DbConnect::getInstance();
               
        $req = $db->_dbb->prepare("select DISTINCT * from t_folders where t_folders.id IN "
                 . "(select t_link_group_folders.ref_id_folders from t_link_group_folders where t_link_group_folders.ref_id_group IN "
                 . "(select t_link_group_users.ref_id_group from t_link_group_users where t_link_group_users.ref_id_users = (select t_users.id from t_users where login = :login))) AND t_folders.visible = TRUE");
        
        if($req->execute(array("login" => $login->login)) == false){
            throw new \Exception("Erreur dans la selection des dossiers, une erreur est survenue");
        }
        
        // selection des groupes pour le filtre
        $db = DbConnect::getInstance();
               
        $reqFiltre = $db->_dbb->prepare("select * from t_group where t_group.id IN "
                . "(select t_link_group_users.ref_id_group from t_link_group_users where ref_id_users IN (select t_users.id from t_users where login = :login)) ORDER BY t_group.group_name");
        
        if($reqFiltre->execute(array("login" => $login->login)) == false){
            throw new \Exception("Erreur dans la selection des dossiers, une erreur est survenue");
        }
        
        $array_group = $reqFiltre->fetchAll();
        
        // appel à la vue
        require './App/Folder/ViewFoldersView.php';
    }
    
    public function select($login,$setting,$action,$id,$update)
    {
        if(is_numeric($id)){
            $setting->setIdFolderSelected($id);
            $_SESSION['SETTING'] = $setting->serialize();
            header('location: .?target_link=MAINVIEW');
            
        }
        else
            throw new \Exception("La variable id n'est pas numérique");
    }
    
    public function __construct() {
        parent::__construct();
    }

    public function delete($login,$setting,$action,$id,$update) {
        
    }

    public function insert($login,$setting,$action,$id,$update) {
        
        if(!isset($update['owner'])) 
            throw new \Exception("Un propriétaire de dossier n'a pas été sélectionné");
        
        if(!isset($update['nom_folder'])) 
            throw new \Exception("Un nom de dossier doit être fourni");
        
         if(!isset($update['commentaire'])) 
            throw new \Exception("Un commentaire lié au dossier doit être fourni");

        if(isset($update['group']) && !empty($update['group'])){
           
             $db = DbConnect::getInstance();
             try{
             $db->_dbb->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
             
             $db->_dbb->beginTransaction();
             
             // enregistrement du folder
             $reqFolder = $db->_dbb->prepare("insert into t_folders (nom,commentaire,owner,visible) VALUES "
                     . "(:nom,:commentaire,:owner,1)");
             $reqFolder->execute(array("nom" => $update['nom_folder'],
                                       "commentaire"  => $update['commentaire'],
                                       "owner" => $update['owner']));
             
             $lastId = $db->_dbb->lastInsertId();
             
             // enregistrement 
               $groups = $update['group'];
               foreach($groups as $g){
                    $reqGroup = $db->_dbb->prepare("insert into t_link_group_folders (ref_id_group,ref_id_folders) VALUES "
                            . "(:ref_id_group,:ref_id_folders)");
                    
                    $reqGroup->execute(array("ref_id_group" => $g,
                                       "ref_id_folders"  => $lastId));
               }

             $db->_dbb->commit();
            
             }
             catch(\Exception $e){
                  $db->_dbb->rollBack();
                  throw new \Exception("Une erreur est survenue lors de l'ajout du nouveau dossier");
             }
          
        }
        else
              throw new \Exception("Un groupe n'a pas été sélectionné ou une erreur est survenue");
        
        $this->show($login, $setting, $action, $id, $update);
    }

    public function update($login,$setting,$action,$id,$update) {
        
    }

}
