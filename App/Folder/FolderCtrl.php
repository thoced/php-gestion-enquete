<?php

require_once './App/Folder/FolderModel.php';
require_once './App/Setting/SettingModel.php';

// reception de l'objet login
if(!isset($_SESSION))
    session_start();

$login = new LoginModel('','');
$login->unserialize($_SESSION['LOGIN']);

// reception de la liste des folders
$folderModel = new FolderModel();
$listFolders = $folderModel->getFolders($login);
// code de sélection

if(isset($_GET['IDSELECT']))
{
    $idselect = $_GET['IDSELECT'];
    if(is_numeric($idselect))
    {
        if(isset($_SESSION['SETTING'])){
              
             $setting = new SettingModel();
             $setting->unserialize($_SESSION['SETTING']);
             $setting->setIdFolderSelected($idselect);
             $_SESSION['SETTING'] = $setting->serialize();
        }
        else
        {
              
            $setting = new SettingModel();
            $setting->setIdFolderSelected($idselect);
            $_SESSION['SETTING'] = $setting->serialize();
        }
     
    }
    header('location: .?target_link=MAINVIEW');
    die;
}

require 'ViewFoldersView.php';

