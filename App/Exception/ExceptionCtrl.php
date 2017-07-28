<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExceptionCtrl
 *
 * @author Thonon
 */
class ExceptionCtrl 
{
   
    function __construct($exception) {
        // appel à la vue
        require './App/Exception/ExceptionView.php';
       
    }
    
    

}
