<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'DbConnect.php';
require_once './App/Login/LoginModel.php';
require_once './App/Personne/PersonneCtrl.php';
require_once './App/Folder/FolderCtrl.php';
require_once './App/Documents/DocumentCtrl.php';
require_once './App/Main/MainCtrl.php';
require_once './App/Setting/SettingModel.php';


if(!isset($_SESSION))
    session_start();

// code de vérification relatif au login
if(!isset($_SESSION['LOGIN']))
{
    // l'utilisateur n'est pas logué
    // verification target_link
    if(isset($_GET['target_link']))
    {
        $target = $_GET['target_link'];
        switch($target)
        {
            case 'CHECKLOGIN':if(IsLoged()){
                new MainCtrl();
                die;
                break;
            }
        }
    }
   
    require './App/Login/LoginCtrl.php';
    die;
   
}

// un login est présent

if(isset($_SESSION['LOGIN']))
 {
    $login = new LoginModel('','');
    $login->unserialize($_SESSION['LOGIN']);
    
    $setting = new SettingModel();
    if(isset($_SESSION['SETTING'])){
    $setting->unserialize($_SESSION['SETTING']);
    }
   
    // reception de la valeur pour le dispatch
    if(isset($_GET['target_link'])){
        $target = $_GET['target_link'];
    }
    
    
    switch($target)
      {
        
      case 'VIEWDOSSIERS': 
                        new FolderCtrl();
                        break;
                    
      case 'VIEWPERSONNES':  new PersonneCtrl();
                        die;
                        break;
                    
     case 'VIEWDOCUMENTS':  new DocumentCtrl();
                        die;
                        break;

      case 'LOGOUT':
                        session_destroy();
                        header('Location: .');
                        break;
                    
      case 'MAINVIEW':  
      default:          new MainCtrl();
                        die;
                        break;
                    
      }
 }


 function IsLoged()
{
         
            if(isset($_POST['login']) && isset($_POST['passwd']))
            {
                $login = $_POST['login'];
                $passwd = $_POST['passwd'];
                if(isset($login) && isset($passwd))
                {
                    // verification
                    $db = DbConnect::getInstance();
                    $idUser = $db->checkLogin($login,$passwd);
                    if($idUser !== false){
                        // le login est ok
                        $logModel = new LoginModel($login, $passwd);
                        $logModel->isLoged = true;
                        $logModel->idUser = $idUser;
                        // on place le tout dans la session
                        if(!isset($_SESSION))
                            session_start();

                        $_SESSION['LOGIN'] = $logModel->serialize();

                        // appel au FrondEnd
                      
                        return true;
                }

                }

            }
           
            return false;
     
}