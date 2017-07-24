<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FolderCtrl
 *
 * @author Thonon
 */
class FolderCtrl implements IController
{
    private static $_instance;
    
    private $db;
    
    private function __construct() {
        
        $this->db = DbConnect::getInstance();
    }
    
    public function run() 
    {
        
    }
    
    public function showAllFolders()
    {
        
    }
    
    public static function getInstance()
    {
        if(self::$_instance !== null)
        {
            self::$_instance = new FolderCtrl();
            return self::$_instance;
        }
        else
            return self::$_instance;
    }

}
