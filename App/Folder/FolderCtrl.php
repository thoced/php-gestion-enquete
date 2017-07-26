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
    public function run($login,$setting, $action, $id, $update) {
        
        switch($action)
        {
            case 'SELECT':$this->selectFolder($setting,$id);
                break;
            
            default: $this->showFolder($login);
                     break;
        }
    }
    
    private function showFolder($login)
    {
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("select * from t_folders inner join t_link_group_folders on t_folders.id = t_link_group_folders.ref_id_folders "
                    . "where t_link_group_folders.ref_id_group like ("
                    . "select DISTINCT t_group.id from t_group inner join t_link_group_users on t_group.id = t_link_group_users.ref_id_group "
                    . "where t_link_group_users.ref_id_users = (select t_users.id from t_users where login = :login)) AND t_folders.visible = TRUE");
        
        $req->execute(array("login" => $login->login));
        
        // appel à la vue
        require './App/Folder/ViewFoldersView.php';
    }
    
    private function selectFolder($setting,$id)
    {
        if(is_numeric($id)){
            $setting->setIdFolderSelected($id);
            $_SESSION['SETTING'] = $setting->serialize();
            header('location: .?target_link=MAINVIEW');
            
        }
    }

}
