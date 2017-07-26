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
 
  <body>&nbsp; <br>
    <br>
    <br>
  <div class="list">
    <table width="95%" align="center">
        <tr>
            <td>Nom:</td>
            <td>Prenom:</td>
            <td>Adresse:</td>
            <td>Date de naissance:</td>
            <td>Qualite</td>
        </tr>
    <?php
        while($row = $req->fetch()){
       echo "<tr onclick='updateScript(this," . $row['id']. ");'>"
    . "<td>" . $row['nom'] . '</td>'
               . '<td>' . $row['prenom'] . '</td>'
               . '<td>' . $row['adresse'] . '</td>'
               . '<td>' . $row['date_naissance'] . '</td>'
               . '<td>' . $row['qualite'] . '</td>'
               . '<td>' . '<a onclick="return verifDelete();" href="?target_link=VIEWPERSONNES&action=DELETE&id=' . $row['id'] . '">Supprimer</a>' . '</td>'
               . '</tr>';
        }
    ?>
    </table>
  </div>
    <br>
    <div class="form">
    <form method="POST" action="?target_link=VIEWPERSONNES" name="form_personne" id="form_personne">
      <table style="width: 100%;" border="0">
        <tbody>
          <tr>
            <td>Nom</td>
            <td><input maxlength="32" size="32" name="nom" type="text" id="nom"><br>
            </td>
          </tr>
          <tr>
            <td>Prenom</td>
            <td><input maxlength="32" size="32" name="prenom" type="text" id="prenom"></td>
          </tr>
          <tr>
            <td style="width: 133.683px;">Adresse</td>
            <td style="width: 495.317px;"><input maxlength="128" size="128" name="adresse" id="adresse"
                type="text"><br>
            </td>
          </tr>
          <tr>
            <td>Date de naissance</td>
            <td style="height: 40px;"><input name="date_naissance" id="datepicker"

                type="text"><br>
            </td>
          </tr>
          <tr>
            <td>Qualite</td>
            <td>
              <select name="qualite" id="qualite">
                <option value="Suspect">Suspect</option>
                <option value="Victime">Victime</option>
                <option value="Temoin">Temoin</option>
                <option value="Source">Source</option>
              </select>
              <br>
            </td>
          </tr>
          <tr>
              <td><input type="submit" value="Modifier"></td>
              <td><input type="submit" value="Ajouter" onclick="document.getElementById('form_personne').setAttribute('action','?target_link=VIEWPERSONNES&action=INSERT');"></td>
              
          </tr>
        </tbody>
      </table>
    </form>
    </div>
    <a href="?target_link=MAINVIEW">Retour</a><br>
  </body>
</html>
