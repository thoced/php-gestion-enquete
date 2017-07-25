<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once './App/Setting/SettingModel.php';
require_once './App/Login/LoginModel.php';

$user = '';
$folder = 'Aucun dossier sélectionné';

// récupération d'information du login
 if(!isset($_SESSION))
        session_start();

if(isset($_SESSION['LOGIN']))
    {
    $login = new LoginModel('','');
    $login->unserialize($_SESSION['LOGIN']);
    $user = $login->login;
}
// récupération du setting
if(isset($_SESSION['SETTING'])){
    
    $setting = new SettingModel();
    $setting->unserialize($_SESSION['SETTING']);
    $folder = $setting->getNomFolderSelected();
}



require 'MainView.php';