<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Login;

require_once './App/Controller/BaseController.php';

use App\Controller\BaseController;
use App\DbConnect;
/**
 * Description of NewUserCtrl
 *
 * @author Thonon
 */
class NewUserCtrl extends BaseController{
    //put your code here
    public function delete($login, $setting, $action, $id, $update) {
        
    }

    public function insert($login, $setting, $action, $id, $update) {
        if(!isset($update)){
            throw new \Exception("Erreur dans la variable update");
        }
        
        if(!isset($update["passwd"]) || !isset($update["passwd2"])){
             throw new \Exception("Erreur dans la variable update");
        }
        
        if(strlen($update["passwd"]) < 8 || strlen($update["passwd2"]) < 8){
             throw new \Exception("password trop petit, minimum 8 caractères");
        }
        
        if($update["passwd"] != $update["passwd2"]){
             throw new \Exception("les deux passwords ne sont pas identiques, un erreur est survenue");
        }
        
        if(!isset($update["login"]) || strlen($update["login"]) != 9){
            throw new \Exception("Le login doit avoir 9 caractères");
        }
        
        if(!isset($update["nom"]) || !isset($update["prenom"])){
            throw new \Exception("Nom et/ou prénom manquant(s)");
        }
        
        if(strlen($update["nom"]) < 1 || strlen($update["prenom"]) < 1){
             throw new \Exception("Le nom et prenom doivent être remplis");
        }
        
        // cryptage du password
        $hash = password_hash($update['passwd'],PASSWORD_BCRYPT);
              
        $db = DbConnect::getInstance();
        $req = $db->_dbb->prepare("insert into t_users (login,nom,prenom,password,reset) values (:login,"
                . ":nom,"
                . ":prenom,"
                . ":password,"
                . "0)");
            if($req->execute(array("login" => $update['login'],
                                   "nom" => $update['nom'],
                                   "prenom" => $update['prenom'],
                                   "password" => $hash)) == false){
                throw new \Exception("La modification n'a pas eu lieu, une erreur est survenue");
            }
            
       // appel à la vue
       require './App/Login/LoginView.php';
    }

    public function select($login, $setting, $action, $id, $update) {
        
    }

    public function show($login, $setting, $action, $id, $update) {
        
        require './App/Login/NewUserView.php';
    }

    public function update($login, $setting, $action, $id, $update) {
        
    }

}
