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
class DbConnect 
{
    private static $_instance = null;
    
    public $_dbb;
    
    private function __construct() 
    {
        $this->_dbb = new PDO('mysql:host=localhost;dbname=db_gel;charset=utf8', 'root', '19868tt5425');
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
           $req = $this->_dbb->prepare('select * from t_users where login = :login AND password = :passwd');
           $req->execute(array(
               'login' => $login,
               'passwd' => $passwd
           ));
           
           $ret = $req->fetch();
           if(isset($ret))
           {
              return $ret['id'];
           }
           else
           {
               return false;
           }
       }
    }
}
