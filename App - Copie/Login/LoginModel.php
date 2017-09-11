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

namespace App\Login;

class LoginModel implements \Serializable
{
      
   public $isLoged = false;
   
   public $login;
   
   public $passwd;
   
   public $idUser;
   
   public $nom;
   
    
   public function __construct($login,$passwd,$nom) 
   {
      $this->login = $login;
      $this->passwd = $passwd;
      $this->nom = $nom;
       
   }
      
    public function serialize() {
        return serialize(array('isLoged' => $this->isLoged, 'login' => $this->login, 'passwd' => $this->passwd, 'idUser' => $this->idUser, 'nom' => $this->nom));
    }

    public function unserialize( $serialized) {
        $a = array();
        $a = unserialize($serialized);
        $this->isLoged = $a['isLoged'];
        $this->login = $a['login'];
        $this->passwd = $a['passwd'];
        $this->idUser = $a['idUser'];
        $this->nom = $a['nom'];
    }

}
