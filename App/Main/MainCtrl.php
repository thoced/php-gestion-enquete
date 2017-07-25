<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



// récupération d'information du login
if(isset($_SESSION['LOGIN']))
    $login = $_SESSION['LOGIN'];

require 'MainView.php';