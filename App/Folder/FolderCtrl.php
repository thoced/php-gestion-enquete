<?php

require_once './App/Folder/FolderModel.php';

// reception de l'objet login
if(!isset($_SESSION))
    session_start();

$login = $_SESSION['LOGIN'];

// reception de la liste des folders
$folderModel = new FolderModel();
$listFolders = $folderModel->getFolders($login);

require 'ViewFoldersView.php';

