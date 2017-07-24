<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'DbConnect.php';
require_once './App/Login/LoginModel.php';


// reception de la valeur pour le dispatch
if(isset($_GET['target_link'])){
    $target = $_GET['target_link'];
    
    switch($target){
        
        case 'CHECKLOGIN':
            break;
    }
    
}

// vérification si l'utilisateur est logué
session_name("GESTION_ENQUETE_SESSION");
if(isset($_SESSION['LOGIN'])){
    $login = $_SESSION['LOGIN'];
}
else // pas d'objet dans la sessin login : appel de loginctrl
{
    require './App/Login/LoginCtrl.php';
    die;
  
}

if(!$login->isLoged)
{
      require './App/Login/LoginCtrl.php';
      die;
}

// le systeme à passé toutes les vérifications, on lance l'application

