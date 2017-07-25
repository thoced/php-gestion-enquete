<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FolderModel
 *
 * @author Thonon
 */
require_once "./App/Model/BaseModel.php";
require_once "Folder.php";

class FolderModel extends BaseModel
{
    public function __construct() {
        parent::__construct();
    }

    public function getFolders($login){
        
              
        
        $req = $this->db->_dbb->prepare("select * from t_folders inner join t_link_group_folders on t_folders.id = t_link_group_folders.ref_id_folders "
                    . "where t_link_group_folders.ref_id_group like ("
                    . "select DISTINCT t_group.id from t_group inner join t_link_group_users on t_group.id = t_link_group_users.ref_id_group "
                    . "where t_link_group_users.ref_id_users = (select t_users.id from t_users where login = ?)) AND t_folders.visible = TRUE");
        
        $req->execute(array($login->login));
        $listFolders = array();
        $id = 0;
        while($row = $req->fetch())
        {
            $folder = new Folder();
            $folder->id = $row['id'];
            $folder->nom = $row['nom'];
            $folder->commentaire = $row['commentaire'];
            $folder->owner = $row['owner'];
            $folder->visible = $row['visible'];
            $listFolders[$id] = $folder;
            $id++;
        }
        return $listFolders;
    }
}
