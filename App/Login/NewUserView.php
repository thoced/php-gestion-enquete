<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./Style/.AppCss.css"> 
        <title></title>
        <script>
 function valideForm(){
     var pass1 = document.getElementById("passwd");
     var pass2 = document.getElementById("passwd2");
     var login = document.getElementById("login");
     
     if(login.value.length != 9){
        var error = document.getElementById("error");
        error.innerHTML = "Erreur, Le login doit avoir 9 caractères";
        pass1.value = "";
        pass2.value = "";
        return false;
     }
     
     if(pass1.value.length < 8 || pass2.value.length < 8){
        var error = document.getElementById("error");
        error.innerHTML = "Erreur, Les passwords doivent avoir un minimum de 8 caractères";
        pass1.value = "";
        pass2.value = "";
        return false;
     }
 
     if(pass1.value != pass2.value){
        var error = document.getElementById("error");
        error.innerHTML = "Erreur, les deux passwords ne sont pas identiques";
        pass1.value = "";
        pass2.value = "";
        return false;
     }
      
     return true;  
     
 }           
        </script>
    </head>
    <body>
         <h1 style="text-align: center;">Nouvel utilisateur</h1>
        <div class="login">
       <form method="POST" action="?target_link=NEWUSER&action=INSERT" name="form_newuser">
      <table style="width: 100%;height: 100%;" border="0">
        <tbody>
           <tr>
            <td style="width:25%;">Nom</td>
            <td style="width:75%;"><input maxlength="64" size="64" name="nom" type="text"><br>
            </td>
          </tr> 
           <tr>
            <td style="width:25%;">Prenom</td>
            <td style="width:75%;"><input maxlength="64" size="64" name="prenom" type="text"><br>
            </td>
          </tr>
          <tr>
              <td><br></td>
           </tr>
          <tr>
            <td style="width:25%;">Login</td>
            <td style="width:75%;"><input maxlength="64" size="64" name="login" type="text" id="login"><br>
            </td>
          </tr>
          <tr>
            <td>Passwd</td>
            <td><input maxlength="64" size="64" name="passwd" type="password" id="passwd"><br>
            </td>
          </tr>
           <tr>
            <td>Retape Passwd</td>
            <td><input maxlength="64" size="64" name="passwd2" type="password" id="passwd2"><br>
            </td>
          </tr>
          
          </tr>
           <tr>
               <td><input formmethod="post" name="submit" type="submit" value="Créer" onclick="return valideForm();"></td>
           </tr>
          
        </tbody>
      </table>
           <br>
            <p style="color:red; text-align: center;" id="error">
    </form>
        </div> 
           <a class="return" href="?target_link=LOGINVIEW">Retour</a><br>
            <p class="copyright">Developpé par Thonon Cédric.</p>
    </body>
</html>
