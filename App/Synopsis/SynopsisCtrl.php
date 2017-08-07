<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SynopsisCtrl
 *
 * @author Thonon
 */
namespace App\Synopsis;

use App\DbConnect;
use App\Controller\BaseController;


class SynopsisCtrl extends BaseController{
    //put your code here
    
    public function generer(){
            require_once './App/lib/vendor/autoload.php';

             $db = DbConnect::getInstance();
             $req = $db->_dbb->prepare("select * from t_synopsis where ref_id_folders = :ref_id_folders");
             if($req->execute(array("ref_id_folders" => $this->setting->getIdFolderSelected())) == false){
            throw new \Exception("Erreur lors de la génénation du rappport");
        }
            
            // Creating the new document...
            $phpWord = new \PhpOffice\PhpWord\PhpWord();
                     
            $section = $phpWord->addSection();
            $header = $section->addHeader();
            $header->addText("Dossier: " . $this->setting->getNomFolderSelected(),
                    array('name' => 'Tahoma', 'size' =>10));
            
            $footer = $section->addFooter();
            $footer->addText("Dossier: " . $this->setting->getNomFolderSelected(),
                    array('name' => 'Tahoma', 'size' =>10));
            
            $section->addText("Rapport dossier: " . $this->setting->getNomFolderSelected(),
                     array('name' => 'Tahoma', 'size' =>22));
            $section->addTextBreak(2);
            $tableStyle = array("borderSize" => 1);
            $table = $section->addTable($tableStyle);
            while($row = $req->fetch()){
            // Adding an empty Section to the document...
                 $rowT = $table->addrow(0);
                 $cellDate = $rowT->addCell(1);
                 $cellCommentaire = $rowT->addCell(3);
                // Adding Text element to the Section having font styled by default...
                $cellDate->addText($row['date'],
                         array('name' => 'Tahoma', 'size' =>12));
                $cellCommentaire->addText($row['commentaire'],
                         array('name' => 'Tahoma', 'size' =>12));
            }

            // Saving the document as OOXML file...
            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            
            // génération d'un nom de fichier aléatoire.
            $alea = 'abcdefghijklmnopqrstuvwxyz1234567890';
            $nameAlea = \str_shuffle($alea);
            $nameAlea = './App/Media/' . $nameAlea;
            $objWriter->save($nameAlea);
            
            $filename = $nameAlea;
            if (!is_file($filename) || !is_readable($filename)){
                header("HTTP/1.1 404 Not Found");
                echo $filename;
            }
            
            $size = filesize($filename);
            
            header("Content-Type: application/force-download");
            header('Content-Disposition: attachment; filename="rapport-' . $this->setting->getNomFolderSelected() .'.docx"');
            header("Content-Length: ".$size);
            readfile($filename);
            
            // suppression
            unlink($nameAlea);
    }
    
    public function delete($login, $setting, $action, $id, $update) {
        
        if(!isset($id) || !is_numeric($id)){
            throw new \Exception("Erreur dans la variable id, une erreur est survenue");
        }

        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("delete from t_synopsis where id = :id AND ref_id_folders = :ref_id_folders");
        if($req->execute(array("id" => $id,
                               "ref_id_folders" => $setting->getIdFolderSelected())) == false){
            throw new \Exception("Erreur dans la requête de suppression du synopsis, une erreur est survenue");
        }
        
        $this->show($login, $setting, $action, $id, $update);
    }

    public function insert($login, $setting, $action, $id, $update) {
        if(!isset($update) || !isset($update['date']) || !isset($update['commentaire'])){
            throw new \Exception("Erreur dans la variable update, une erreur est survenue");
        }
        
        if(!isset($setting)){
            throw new \Exception("Erreur dans la variable setting, une erreur est survenue");
        }
        
        $date = $update['date'];
        if(strlen($date) == 0){
            $date = null;
        }
        
       // $commentaire = preg_replace("#[^a-zA-Z àéè!?;:()-+=/' ]#", "", $update['commentaire']);
        $commentaire = strip_tags($update['commentaire']);

        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("insert into t_synopsis (date,commentaire,ref_id_folders) values (:date,:commentaire,:ref_id_folders)");
        if($req->execute(array("date" => $date,
                            "commentaire" => $commentaire,
                            "ref_id_folders" => $setting->getIdFolderSelected())) == false){
            throw new \Exception("Erreur dans la requête d'ajout du synopsis, une erreur est survenue");
        }
        
        $this->show($login, $setting, $action, $id, $update);
    }

    public function select($login, $setting, $action, $id, $update) {
        
    }

    public function show($login, $setting, $action, $id, $update) {
        
        if(!isset($setting))
            throw new \Exception("Erreur dans la variable setting, une erreur est survenue");
        
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("select * from t_synopsis where ref_id_folders = :ref_id_folders");
        if($req->execute(array("ref_id_folders" => $setting->getIdFolderSelected())) == false){
            throw new \Exception("Erreur dans la requete de le sélection des synopsis");
        }

        // appel à la vue
        require './App/Synopsis/SynopsisView.php';
    }

    public function update($login, $setting, $action, $id, $update) {
       
    }

}
