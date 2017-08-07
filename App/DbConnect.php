<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DbConnect
 *
 * @author Thonon
 */

namespace App;

class DbConnect 
{
    private static $_instance = null;
    
    public $_dbb;
    
    private function __construct() 
    {
        $this->_dbb = new \PDO('mysql:host=localhost;dbname=db_gel;charset=utf8', 'gel', 'gel');
    }
      
    public static function getInstance()
    {

        if(self::$_instance !== null)
        {
            return self::$_instance;
        }
        else
        {
             
            self::$_instance = new DbConnect();
            return self::$_instance;
        }
    }
    
    public function checkLogin($login,$passwd)
    {
        if($this->_dbb !== null)
       {
            // codage du password
           $hash = password_hash($passwd, PASSWORD_BCRYPT); 
            
           $req = $this->_dbb->prepare('select * from t_users where login = :login');
           $req->execute(array(
               'login' => $login
           ));
           
           while($ret = $req->fetch())
           {
               if(password_verify($passwd, $ret['password'])){
                   return $ret['id'];
               }
           }
          
               return false;
           
       }
    }
}
