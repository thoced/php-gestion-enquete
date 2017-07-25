<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginModel
 *
 * @author Thonon
 */



class LoginModel 
{
      
   public $isLoged = false;
   
   public $login;
   
   public $passwd;
   
   public $idUser;
   
   public $nom;
   
    
   public function __construct($login,$passwd) 
   {
      $this->login = $login;
      $this->passwd = $passwd;
       
   }
   
  
   
   
}
