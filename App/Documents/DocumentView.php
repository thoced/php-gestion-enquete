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

function updateScriptDocument(tr,id){
    
    // tr : contient la ligne complète selectionné
    var listTd = tr.childNodes;
    // récupératin des td
   
        // ajout du contenu des td dans les inputs
        var att = document.createAttribute("value");
        att.value = listTd[0].innerHTML;
        input = document.getElementById("titre");
        input.setAttributeNode(att);
        
        var att = document.createAttribute("value");
        att.value = listTd[1].innerHTML;
        input = document.getElementById("commentaire");
        input.setAttributeNode(att);
        
        var att = document.createAttribute("value");
        att.value = listTd[2].innerHTML;
        input = document.getElementById("datepicker");
        input.setAttributeNode(att);
        
        var att = document.createAttribute("value");
        att.value = listTd[3].innerHTML;
        input = document.getElementById("reference");
        input.setAttributeNode(att);
        
        input = document.getElementById("type");
         for(i=0;i<input.options.length;i++){
             if(input.options[i].text === listTd[4].innerText)
                 input.options[i].selected = true;
        }  
        
        // changement d'action pour le form
        document.getElementById("form_document").setAttribute("action","?target_link=VIEWDOCUMENTS&action=UPDATE&id=" + id);
      

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
 
  <body>&nbsp; <br>
    <br>
    <br>
  <div class="list">
    <table width="95%" align="center">
        <tr>
            <td>Titre:</td>
            <td>Commentaire:</td>
            <td>Date:</td>
            <td>Reference:</td>
            <td>Type de document:</td>
        </tr>
    <?php
        while($row = $req->fetch()){
       echo "<tr onmouseover='mouseOver(this);' onmouseout='mouseOut(this);' onclick='updateScriptDocument(this," . $row[0]. ");'>"
    . "<td>" . $row['titre'] . '</td>'
               . '<td>' . $row['commentaire'] . '</td>'
               . '<td>' . $row['date'] . '</td>'
               . '<td>' . $row['reference'] . '</td>'
               . '<td>' . $row['type'] . '</td>'
               . '<td>' . '<a href="?target_link=VIEWSELECTANNEXES&id=' . $row[0] . '">Annexes</a>' . '</td>'
               . '<td>' . '<a class="supprimer" onclick="return verifDelete();" href="?target_link=VIEWDOCUMENTS&action=DELETE&id=' . $row[0] . '">Supprimer</a>' . '</td>'
               . '<td>' . '<a class="contenu" href="?target_link=VIEWCONTENU&id=' . $row['0'] . '">Contenu</a>'.  '</td>'
               . '</tr>';
        }
    ?>
    </table>
  </div>
    <br>
    <div class="form">
    <form method="POST" action="?target_link=VIEWDOCUMENTS" name="form_document" id="form_document">
      <table>
        <tbody>
          <tr>
            <td>Titre</td>
            <td><input maxlength="32" size="32" name="titre" type="text" id="titre"><br>
            </td>
          </tr>
          <tr>
            <td>Commentaire</td>
            <td><input maxlength="64" size="64" name="commentaire" type="text" id="commentaire"></td>
          </tr>
          <tr>
            <td>Date</td>
            <td style="height: 40px;"><input name="date" id="datepicker"

                type="text"><br>
            </td>
          </tr>
          <tr>
            <td>Reference</td>
            <td>
              <input maxlength="64" size="64" name="reference" id="reference"
                type="text">
              <br>
            </td>
          </tr>
          <tr>
        <td>Type</td>
        <td>
              <select name="type" id="type">
              <?php
                while($type = $reqType->fetch())
                    echo "<option value='" . $type['id'] . "'>" . $type['type'] . "</option>";
               ?>
              </select>
        </td>
          </tr>
          <tr width="100%">
              <td width="20%"><input type="submit" value="Modifier"></td>
              <td width="20%"><input type="submit" value="Ajouter" onclick="document.getElementById('form_document').setAttribute('action','?target_link=VIEWDOCUMENTS&action=INSERT');"></td
          </tr>
        </tbody>
      </table>
    </form>
    </div>
    <a class="return" href="?target_link=MAINVIEW">Retour</a><br>
  </body>
</html>
