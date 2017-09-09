<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseController
 *
 * @author Thonon
 */
namespace App\Controller;

use App\Login\LoginModel;
use App\Setting\SettingModel;

abstract class BaseController 
{
   // abstract public function run($login, $setting,$action,$id,$update);
    
    abstract public function show($login,$setting,$action,$id,$update);
    
    abstract public function update($login,$setting,$action,$id,$update);
    
    abstract public function delete($login,$setting,$action,$id,$update);
    
    abstract public function insert($login,$setting,$action,$id,$update);
    
    abstract public function select($login,$setting,$action,$id,$update);
    
    protected $login,$setting,$action,$id,$update;
    
    public function __construct() 
    {
        // pompe à récupération d'information
        $login = new LoginModel("","","");
        $setting = new SettingModel();
        $action = null;
        $id = null;
        $update = array();
       
        if(isset($_SESSION['LOGIN'])){
            $login->unserialize($_SESSION['LOGIN']);
            $this->login = $login;
        }
        
        if(isset($_SESSION['SETTING'])){
            $setting->unserialize($_SESSION['SETTING']);
            $this->setting = $setting;
        }
        
        if(isset($_GET['action'])){
            $action = $_GET['action'];
            $this->action = $action;
        }
        
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $this->id = $id;
        }
        
        if(isset($_POST)){
            $update = $_POST;
            $this->update = $update;
            
        }
        
        
        
        switch($action)
        {
            case 'DELETE':  $this->delete($login,$setting,$action,$id,$update);
                            break;
            case 'UPDATE':  $this->update($login,$setting,$action,$id,$update);
                            break;
            case 'INSERT':  $this->insert($login,$setting,$action,$id,$update);
                            break;
            case 'SELECT':  $this->select($login, $setting, $action, $id, $update);
                            break;
            default      :  
                            // appel à la reflectionclass pour déterminer si l'objet possède une methode passé en parametre de l'url
                            $this->reflection($action);
                            $this->show($login,$setting,$action,$id,$update);
                            break;
        }
        // appel au methode run des enfants
       // $this->run($login,$setting,$action,$id,$update);
        
    }
    
    protected function reflection($action){
        // reflexion
        $reflexion = new \ReflectionClass($this);
        $nameMethode = strtolower($action);
        if($reflexion->hasMethod($nameMethode)){
            $method = $reflexion->getMethod($nameMethode);
            return $method->invoke($this);
            //return true; // return true si l'invocation à eu lieu
        }
        return false; // return false si pas de methode trouvé donc pas d'invocation.

    }
    
    
}
