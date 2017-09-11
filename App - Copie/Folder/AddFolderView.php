<!--?php
/*  * To change this license header, choose License Headers in Project Properties. * To change this template file, choose Tools | Templates * and open the template in the editor. */-->
<html>
  <head>
    <meta content="text/html; charset=windows-1252" http-equiv="content-type">
    <link rel="stylesheet" href="./jquery-ui-1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="./Style/.AppCss.css"> 
    <script src="jquery-3.2.1.js"></script>
    <script src="./jquery-ui-1.12.1/jquery-ui.js"></script>
    <script type="application/x-javascript">
      
    $(function() {
$( "#datepicker" ).datepicker({
    altField: "#datepicker",
    closeText: 'Fermer',
    prevText: 'Pr�c�dent',
    nextText: 'Suivant',
    currentText: 'Aujourd\'hui',
    monthNames: ['Janvier', 'F�vrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Ao�t', 'Septembre', 'Octobre', 'Novembre', 'D�cembre'],
    monthNamesShort: ['Janv.', 'F�vr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Ao�t', 'Sept.', 'Oct.', 'Nov.', 'D�c.'],
    dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
    dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
    dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
    weekHeader: 'Sem.',
    dateFormat: 'yy-mm-dd',
    firstDay : 1,
    changeYear: true,
    yearRange:'-130:+0'
    });
});

function updateScript(tr,id){
    
    // tr : contient la ligne complète selectionné
    var listTd = tr.childNodes;
    // récupératin des td
   
        // ajout du contenu des td dans les inputs
        var nom = document.createAttribute("value");
        nom.value = listTd[0].innerHTML;
        inputNom = document.getElementById("nom");
        inputNom.setAttributeNode(nom);
        
        var prenom = document.createAttribute("value");
        prenom.value = listTd[1].innerHTML;
        inputPrenom = document.getElementById("prenom");
        inputPrenom.setAttributeNode(prenom);
        
        var adresse = document.createAttribute("value");
        adresse.value = listTd[2].innerHTML;
        inputAdresse = document.getElementById("adresse");
        inputAdresse.setAttributeNode(adresse);
        
        var date_naissance = document.createAttribute("value");
        date_naissance.value = listTd[3].innerHTML;
        inputDate = document.getElementById("datepicker");
        inputDate.setAttributeNode(date_naissance);
        
         inputQualite = document.getElementById("qualite");
         for(i=0;i<inputQualite.options.length;i++){
             if(inputQualite.options[i].text === listTd[4].innerText)
                 inputQualite.options[i].selected = true;
        }
        
        // changement d'action pour le form
        document.getElementById("form_personne").setAttribute("action","?target_link=VIEWPERSONNES&action=UPDATE&id=" + id);
      

}



function mouseOver(tr){
      tr.style.backgroundColor = "#5dade2"
}

function mouseOut(tr){
   tr.style.backgroundColor = null;
}

function verifDelete()
{
    if(confirm("Etes vous sûr de vouloir supprimer cet élément ?")){
        return true;
    }
    else {
        return false;
        }
}
    </script>
  </head>
  
  <body>
       <h1 class="Title" style="text-align: center;">Création d'un dossier</h1>
    <br>

    <div class="form">
    <form method="POST" action="?target_link=VIEWDOSSIERS&action=INSERT" name="form_folder" id="form_folder">
      <table style="width: 100%;" border="0">
        <tbody>
          <tr>
            <td>Nom du dossier</td>
            <td><input maxlength="32" size="32" name="nom_folder" type="text" id="nom_folder"><br>
            </td>
          </tr>
          <tr>
            <td>Commentaire</td>
            <td><textarea rows="5" cols="64" size="" name="commentaire" type="text" id="commentaire"></textarea></td>
          </tr>
          <tr>
            <td>Owner</td>
            <td>
                <select name="owner" id="owner">
                <?php
                   while($row = $req->fetch()){
                       echo "<option value='" . $row['id'] . "'>" . $row['nom'] . " " . $row['prenom'] . " (" . $row['login'] .  ")</option>";
                   }
                ?>
              </select>
            </td>
          <tr>
              <td>Groupe associé</td>
              <td>
                 <select name="group[]" id="group" multiple>
                <?php
                   while($row = $reqGroup->fetch()){
                       echo "<option value='" . $row['id'] . "'>" . $row['group_name'] . "</option>";
                   }
                ?>
                 </select>
              </td>
              <td width='25%'>
                  <p style="text-align:left;"><i>Pour sélectionner plusieurs groupes, maintenez la touche (CTRL-Gauche ou SHIFT-Gauche) enfoncée et sélectionnez ceux-ci à l'aide de la souris</i></p>
              </td>
          </tr>
          </tr>
           <tr>
              <td><input type="submit" value="Créer le dossier" onclick="document.getElementById('form_personne').setAttribute('action','?target_link=VIEWPERSONNES&action=INSERT');"></td>
          </tr>
        </tbody>
      </table>
    </form>
    </div>
     <a class="return" href="?target_link=MAINVIEW">Retour</a>
  </body>
</html>
