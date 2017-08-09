<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <link rel="stylesheet" href="./Style/.AppCss.css"> 
    <title>login</title>
  </head>
  <body>
    <p><br>
    </p>
    <br>
    <p><h1 style="text-align: center; font-size: 92px; font-stretch:  semi-condensed;">G.E.L</h1></p>
    <p><h3 style="text-align: center; font-size: 48px;">Gestion d'enquête locale</h1></p>
    <div class="login">
    <form method="POST" action="?target_link=CHECKLOGIN" name="form_login">
      <table style="width: 100%;height: 100%;" border="0">
        <tbody>
          <tr>
            <td style="width:25%;">Login</td>
            <td style="width:75%;"><input maxlength="64" size="64" name="login" type="text"><br>
            </td>
          </tr>
          <tr>
            <td>Passwd</td>
            <td><input maxlength="64" size="64" name="passwd" type="password"><br>
            </td>
          </tr>
          <tr>
               <p><a class="user" href="?target_link=NEWUSER">Nouvel utilisateur ?</a>
          </tr>
        </tbody>
      </table>
      <input formmethod="post" name="submit" type="submit" value="Se connecter">
    </form>
    </div>
    <p class="copyright">Developpé par Thonon Cédric.</p>
</body></html>
   