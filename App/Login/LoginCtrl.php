<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once './App/Login/LoginModel.php';

if(isset($_GET['target_link']))
{
    $target = $_GET['target_link'];
    if($target == "CHECKLOGIN")
    {
        if(isset($_POST['login']) && isset($_POST['passwd']))
        {
            $login = $_POST['login'];
            $passwd = $_POST['passwd'];
            // verification
            $db = DbConnect::getInstance();
            $idUser = $db->checkLogin($login,$passwd);
            if($idUser !== false){
                // le login est ok
                $logModel = new LoginModel($login, $passwd);
                $logModel->isLoged = true;
                $logModel->idUser = $idUser;
                // on place le tout dans la session
               // session_name("GESTION_ENQUETE_SESSION");
                $_SESSION['LOGIN'] = $logModel;

                // appel au FrondEnd
                require './App/FrontEnd.php';
                die;
                
                
            }
                    
        }
    }
    
}
require './App/Login/LoginView.php';
