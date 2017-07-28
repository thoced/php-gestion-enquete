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
require_once './App/Controller/BaseController.php';


class FolderCtrl extends BaseController{
    //put your code here
    
    public function show($login,$setting,$action,$id,$update)
    {
        if(!isset($login)){
            throw new Exception("La variable login est vide, une erreur est survenue");
        }
        
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("select * from t_folders inner join t_link_group_folders on t_folders.id = t_link_group_folders.ref_id_folders "
                    . "where t_link_group_folders.ref_id_group like ("
                    . "select DISTINCT t_group.id from t_group inner join t_link_group_users on t_group.id = t_link_group_users.ref_id_group "
                    . "where t_link_group_users.ref_id_users = (select t_users.id from t_users where login = :login)) AND t_folders.visible = TRUE");
        
        if($req->execute(array("login" => $login->login)) == false){
            throw new Exception("Erreur dans la selection des dossiers, une erreur est survenue");
        }
        
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
            throw new Exception("La variable id n'est pas numérique");
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

}
