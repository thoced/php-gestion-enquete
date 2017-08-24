<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <link rel="stylesheet" href="./Style/.AppCss.css"> 
    <title>MainView.php</title>
</head>
  <body>
    <p id="Title">Gestion Enquête Locale</p>
    <p><a href="?target_link=LOGOUT">Logout</a></p>
    <div id="loginInfo">Utilisateur :
      <?php echo "<b>" . $user . "</b>" ?> <br>
      Dossier en cours:
      <?php echo "<b>" . $folder . "</b>"?><br>
      Nom utilisateur:
      <?php echo $nom;?>
      
    </div>
    <p><a href="?target_link=LOGOUT"></a><br>
    </p>
    <br>
    <p><br>
    </p>
    <div class="list">
    <table style="width: 100%" border="0">
      <tbody>
        <tr>
          <td style="width: 25%;">Gestion des Dossiers<br>
            <br>
            <a class="contenu" href="?target_link=VIEWDOSSIERS">Voir les dossiers</a><br>
            <a class="contenu" href="?target_link=VIEWDOSSIERS&action=SHOWNEWFOLDER">Créer un dossier</a>
          </td>
          <td style="width: 25%;">Gestion des Personnes physique<br>
            <br>
            <a class="contenu" href="?target_link=VIEWPERSONNES">Voir les personnes</a></td>
          <td style="width:25%;">Gestion des documents<br><br>
              <a class="contenu" href="?target_link=VIEWDOCUMENTS">Voir les documents</a>
          </td>
          <td style="width:25%;">Recherches<br><br>
              <a class="contenu" href="?target_link=VIEWRECHERCHES">Recherche de contenu</a> 
          </td>
        </tr>
        <tr>
            <td style="width:25%;">Synopsis<br><br>
                <a class="contenu" href="?target_link=VIEWSYNOPSIS">Suivi de l'enquêtes</a><br>
                <a class="contenu" href="?target_link=VIEWTODO">Planification - Tâches à réaliser</a>   
            </td>
        </tr>
      </tbody>
    </div>
    </table>
    <p><br>
    </p>
  </body>
</html>
