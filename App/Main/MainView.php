<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <link rel="stylesheet" href="./Style/.AppCss.css"> 
    <title>MainView.php</title>
</head>
  <body>
    <p class="Title">Gestion Enquête Locale</p>
    <p><a href="?target_link=LOGOUT">Logout</a></p>
    <div id="loginInfo">Utilisateur :
      <?php echo "<b>" . $user . "</b>" ?> <br>
      Dossier en cours:
      <?php echo "<b>" . $folder . "</b>"?><br>
      Nom utilisateur:
      <?php echo $nom;?>
      
    </div>
    <p><a class="logout" href="?target_link=LOGOUT"></a><br>
    </p>
     <div class="list">
    <table style="width: 100%" border="0">
      <tbody>
        <tr>
          <td style="width: 25%;">Gestion des Dossiers
              <ul>
                  <li><a class="contenu" href="?target_link=VIEWDOSSIERS"><span class="menu">Voir les dossiers</span></a></li>
                  <li><a class="contenu" href="?target_link=VIEWDOSSIERS&action=SHOWNEWFOLDER"><span class="menu">Créer un dossier</span></a></li>
                  <li><a class="contenu" href="?target_link=VIEWAPOSTILLES"><span class="menu">Gestion des apostilles</span></a></li>
              </ul>
          </td>
          <td  style="width: 25%;">Gestion des tâches
              <ul>
                  <li><a class="contenu" href="?target_link=VIEWTODO&action=ALLTODO"><span class="menu">Voir l'ensemble des tâches</span></a></li>
              </ul>
          </td>
        </tr>
      </tbody>
        </table>
    </div>
    <br>
    <p><br>
    </p>
    <div class="list">
    <table style="width: 100%" border="0">
      <tbody>
          <td style="width: 25%;">Gestion des Personnes physique
              <ul>
                  <li><a class="contenu" href="?target_link=VIEWPERSONNES"><span class="menu">Voir les personnes</span></a></li>
             </ul>
          </td>
          <td style="width:25%;">Gestion des documents
              <ul>
                  <li><a class="contenu" href="?target_link=VIEWDOCUMENTS"><span class="menu">Voir les documents</span></a></li>
              </ul>
          </td>
          <td style="width:25%;">Recherches
              <ul>
                  <li><a class="contenu" href="?target_link=VIEWRECHERCHES"><span class="menu">Recherche de contenu</span></a></li> 
              </ul>
          </td>
        </tr>
        <tr>
            <td style="width:25%;">Synopsis
                <ul>
                    <li><a class="contenu" href="?target_link=VIEWSYNOPSIS"><span class="menu">Suivi de l'enquêtes</span></a></li>
                    <li><a class="contenu" href="?target_link=VIEWTODO"><span class="menu">Planification - Tâches à réaliser</span></a></li> 
                </ul>
            </td>
        </tr>
      </tbody>
        </table>
    </div>
  
    <p><br>
    </p>
  </body>
</html>
