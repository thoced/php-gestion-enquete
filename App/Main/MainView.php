<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <title>MainView.php</title>
    <style type="text/css">
#Title {
  text-align: center;
  font-weight: bold;
  font-size: 30px;
}

#login {
  display: block;
  float: right;
  clear: right;
  position: static;
  background-color: #9999ff;
  border-radius: 0px;
  font-weight: bold;
  border-top-style: solid;
  border-right-style: solid;
  border-bottom-style: solid;
  border-left-style: solid;
  border-top-width: 2px;
  border-right-width: 2px;
  border-bottom-width: 2px;
  border-left-width: 2px;
  border-top-color: #ccccff;
  border-right-color: #ccccff;
  border-bottom-color: #ccccff;
  border-left-color: #ccccff;
}

</style></head>
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
          <td><br>
          </td>
          <td><br>
          </td>
        </tr>
      </tbody>
    </table>
    <p><br>
    </p>
  </body>
</html>
