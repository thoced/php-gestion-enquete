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
    <div id="login">Utilisateur :
      <?php echo $user;?> <br>
      Dossier en cours:
      <?php echo $folder;?> </div>
    <p><a href="?target_link=LOGOUT"></a><br>
    </p>
    <br>
    <p><br>
    </p>
    <table style="width: 100%" border="1">
      <tbody>
        <tr>
          <td style="width: 180.917px;">Gestion des Dossiers<br>
            <br>
            <a href="?target_link=VIEWDOSSIERS">Voir les dossiers</a></td>
          <td style="width: 404.7px;">Gestion des Personnes physique<br>
            <br>
            <a href="?target_link=VIEWPERSONNES">Voir les personnes</a></td>
          <td>Gestion des documents<br><br>
              <a href="?target_link=VIEWDOCUMENTS">Voir les documents</a>
          </td>
          <td> </td><br>
          </td>
        </tr>
      </tbody>
    </table>
    <p><br>
    </p>
  </body>
</html>
