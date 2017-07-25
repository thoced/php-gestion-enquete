<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SettingModel
 *
 * @author Thonon
 */
class SettingModel implements Serializable
{
    private $idFolderSelected;
    
    private $nomFolderSelected;
     
    function setIdFolderSelected($idFolderSelected) {
        $this->idFolderSelected = $idFolderSelected;
        // recheche du nom du folder selectionné
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare('select id,nom from t_folders where id = :id');
        $req->execute(array('id' => $idFolderSelected));
        while($row = $req->fetch())
        {
           $this->idFolderSelected = $row['id'];
           $this->nomFolderSelected = $row['nom'];
        }
    }
    
    public function getIdFolderSelected() {
        return $this->idFolderSelected;
    }

    public function  getNomFolderSelected() {
        return $this->nomFolderSelected;
    }

    public function setNomFolderSelected($nomFolderSelected) {
        $this->nomFolderSelected = $nomFolderSelected;
    }

    public function serialize(){

       return serialize(array('id' => $this->idFolderSelected, 'nom' => $this->nomFolderSelected));
    }

    public function unserialize($serialized) {
        $a = array();
        $a = unserialize($serialized);
        $this->idFolderSelected = $a['id'];
        $this->nomFolderSelected = $a['nom'];
    }

}
