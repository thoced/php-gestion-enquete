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
            if($db->checkLogin($login,$passwd)){
                // le login est ok
                $logModel = new LoginModel($login, $passwd);
                $logModel->isLoged = true;
                // on place le tout dans la session
                $_SESSION['LOGIN'] = $logModel;
              
                
                // appel au FrondEnd
                require './App/FrontEnd.php';
                die;
                
                
            }
                    
        }
    }
    
}
require './App/Login/LoginView.php';
