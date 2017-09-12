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
$( ".datepicker" ).datepicker({
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
    dateFormat: 'dd-mm-yy',
    firstDay : 1,
    changeYear: true,
    yearRange:'-130:+0'
    });
});



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
function doneClick(checkedBox,id){
   
   if(!confirm("Vous êtes sur le point de modifier le statut de cette apostille, êtes-vous sûr de vouloir le modifier ?")){
       return false;
   }
   
   if(checkedBox.checked == true){
       // le checkedBox est checked
       var xhr = new XMLHttpRequest();
       xhr.open("GET", "index.php?target_link=VIEWTODO&action=UPDATE&id=" + id + "&checked=true", true);
       xhr.send(null);
   }
   else{
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "index.php?target_link=VIEWTODO&action=UPDATE&id=" + id + "&checked=false", true);
        xhr.send(null);
    } 
    
    return true;
}

function valide_filtre(){
   
   // récupération de l'id selectionné sur le select de dossiers
   var id_folders = document.getElementById("filtre_id_folders").value;
   var id_cloture = document.getElementById("filtre_cloture").value;
   
    var xhr = new XMLHttpRequest();  
     xhr.onreadystatechange = function(event){
         if(xhr.readyState == XMLHttpRequest.DONE){
             if(xhr.status === 200){
                
                var p = document.createElement("TABLE");
                p.innerHTML = xhr.responseText;
                var div = document.getElementById("div_show");
               while (div.firstChild) {
                    div.removeChild(div.firstChild);
               }
               p.setAttribute("width","95%");
               p.setAttribute("align","center");
               div.appendChild(p);
               // div.removeNode(p);
              
             }
         }
     };
     // xhr.setRequestHeader('Content-Type',  'text/xml');
     xhr.open("GET", "index.php?target_link=VIEWAPOSTILLES&action=FILTRE&idfolderselected=" + id_folders + "&CLOTURE=" + id_cloture, true);
     xhr.send(null);
}

function selectRow(id){
        var xhr = new XMLHttpRequest();  
     xhr.onreadystatechange = function(event) {
    // XMLHttpRequest.DONE === 4
    if (this.readyState === XMLHttpRequest.DONE) {
        if (this.status === 200) {
      
             parser = new DOMParser();
             xmlDoc = parser.parseFromString(this.responseText, "text/xml");
             // reception des elements du XML
             var num = xmlDoc.getElementsByTagName("numero")[0].childNodes[0].nodeValue;
             var date_apostille = xmlDoc.getElementsByTagName("date_apostille")[0].childNodes[0].nodeValue;
             var date_in = xmlDoc.getElementsByTagName("date_in")[0].childNodes[0].nodeValue;
             var date_apostille = xmlDoc.getElementsByTagName("date_apostille")[0].childNodes[0].nodeValue;
             var reference = xmlDoc.getElementsByTagName("reference")[0].childNodes[0].nodeValue;
             var magistrat = xmlDoc.getElementsByTagName("magistrat")[0].childNodes[0].nodeValue;
             var sujet = xmlDoc.getElementsByTagName("sujet")[0].childNodes[0].nodeValue;
             var attribue = xmlDoc.getElementsByTagName("attribue")[0].childNodes[0].nodeValue;
             var ref_id_folders = xmlDoc.getElementsByTagName("ref_id_folders")[0].childNodes[0].nodeValue;
            
            
             document.getElementById('id').value = id;
             document.getElementById('numero').value = num;
             document.getElementById('date_apostille').value = date_apostille;
             document.getElementById('date_in').value = date_in;
             document.getElementById('reference').value = reference;
             document.getElementById('magistrat').value = magistrat;
             document.getElementById('sujet').value = sujet;
             document.getElementById('attribue').value = attribue;
             document.getElementById('ref_id_folders').value = ref_id_folders;
             
             
        } else {
            console.log("Status de la réponse: %d (%s)", this.status, this.statusText);
         
        }
    }
};
     
    // xhr.setRequestHeader('Content-Type',  'text/xml');
     xhr.open("GET", "index.php?target_link=VIEWAPOSTILLES&action=SELECT&id=" + id, true);
     xhr.send(null);
   
}

function cloture(idCloture){
    // reception du div
    var clo = document.getElementById("apostille_cloture");
    clo.style.visibility = "visible";
    // reception du document id
    document.getElementById("idCloture").value = idCloture;
}

function cloture_annuler(){
    var clo = document.getElementById("apostille_cloture");
    clo.style.visibility = "hidden";
    return false;
}

function valide_cloture(){
    var d = document.getElementById("date_out");
    if(d.value.length == 0){
    var date = new Date();
    var j = date.getDate();
    var m = date.getMonth() + 1;
    var y = date.getFullYear();
    var t = j + "-" + m + "-" + y;
    d.value = t;
    return false;
    }
   return true;
}


    </script>
  </head>
 
  <body>
       <h1 class="Title" style="text-align: center;">Gestion des apostilles</h1>
    <br>
    <br>
    <div class="apostille_cloture" id="apostille_cloture">
        <p style="text-align: center;">Cloture de l'apostille</p><br>
        <form method="POST" action="?target_link=VIEWAPOSTILLES&action=CLOTURE" name="form_cloture" id="form_cloture">
            <table>
                 <tr>
                   <td><input type="hidden" name="idCloture" id="idCloture"></td>
                </tr>
                <tr>
                    <td>Référence de cloture: </td>
                    <td><input type="text" name="ref_cloture" id="ref_cloture"></td>
                </tr>
                <tr>
                    <td>Date de cloture: </td>
                    <td><input name="date_out" class="datepicker" type="text" id="date_out"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Cloturer" onclick="return valide_cloture();"></td>
                    <td><input type="button" value="Annuler" onclick="return cloture_annuler();"></td>
                </tr>
            </table>
        </form>
        
    </div>  
    
    <div class="filtre">
        <table width="100%">
            <tr>
                <td> Dossiers: <select onchange="valide_filtre();" name="filtre_id_folders" id="filtre_id_folders">
                    echo "<option value='-1'>Tous les dossiers</option>
                    <?php 
                         foreach ($array_folders as $row){
                             echo "<option value='" . $row['id'] . "'>" . $row['nom'] . "</option>";
                         }
                    ?>
                </select>
                </td>
                <td>
                    Cloturé: <select onchange="valide_filtre();" name="filtre_cloture" id="filtre_cloture">
                        <option value="ALL">Tous</option>
                        <option value="INPROGRESS">En cours</option>
                        <option value="CLOTURED">Cloturé</option>
                    </select>
                </td>
            </tr>
        </table>
       
        
    </div> 
    <br>
  <div class="list" id="div_show">
    <table width="95%" align="center">
        <tr>
            <td>Numero:</td>
            <td>Nom du dossier:</td>
            <td>Date apostille:</td>
            <td>Date IN:</td>
            <td>Référence:</td>
            <td>Magistrat:</td>
            <td>Sujet:</td>
            <td>Attribué à:</td>
            <td>Référence de cloture</td>
            <td>Date OUT</td>
            <td>Cloturé ?</td>
            <td>Option</td>
        </tr>
        </tr>
        </tr>
    <?php
        while($row = $req->fetch()){
        // variable checked
        $checked = "";
        if(!is_null($row['date_out'])){
            $checked = "checked";
        }
            
       echo "<tr onmouseover='mouseOver(this);' onmouseout='mouseOut(this);' onclick='selectRow(" . $row['idApostille']. ");'>"
    . "<td><b>" . $row['numero'] . '</b></td>'
               . '<td><b>' . $row['nom']. '</b></td>'
               . '<td>' . $row['date_apostille'] . '</td>'
               . '<td>' . $row['date_in'] . '</td>'
               . '<td>' . $row['reference'] . '</td>'
               . '<td>' . $row['magistrat'] . '</td>'
               . '<td>' . $row['sujet'] . '</td>'
               . '<td>' . $row['attribue'] . '</td>'
               . '<td>' . $row['ref_cloture'] . '</td>'
               . '<td>' . $row['date_out'] . '</td>'
               . '<td><input ' . $checked . ' type="checkbox" onclick="return cloture(' . $row['idApostille'] . ');"></input></td>'
               . '<td>' . '<a class="supprimer" class="supprimer" onclick="return verifDelete();" href="?target_link=VIEWAPOSTILLES&action=DELETE&id=' . $row['idApostille'] . '">Supprimer</a>' . '</td>'
               . '</tr>';
        }
    ?>
    </table>
  </div>
    <br>
    <div class="form">
    <form method="POST" action="?target_link=VIEWAPOSTILLES&action=INSERT" name="form_apostille" id="form_apostille">
      <table style="width: 100%;" border="0">
        <tbody>
            <tr>
                <td><input type="hidden" name="id" id="id"></td>
            </tr>
          <tr>
            <td>Numéro</td>
            <td><input maxlength="32" size="32" name="numero" type="text" id="numero"><br>
            </td>
          </tr>
          <tr>
            <td>Date de l'apostille</td>
            <td><input name="date_apostille" class="datepicker" type="text" id="date_apostille"></td>
          </tr>
          <tr>
            <td style="width: 133.683px;">Date IN</td>
            <td style="width: 495.317px;"><input name="date_in" class="datepicker" type="text" id="date_in"><br>
            </td>
          </tr>
          <tr>
            <td>Référence</td>
            <td style="height: 40px;"><input name="reference" id="reference" type="text"><br>
            </td>
          </tr>
           <tr>
            <td>Magistrat</td>
            <td><input  name="magistrat" id="magistrat" type="text"><br>
            </td>
          </tr>
          <tr>
            <td>Sujet</td>
            <td><input size="96" name="sujet" id="sujet" type="text"><br>
            </td>
          </tr>
           <tr>
            <td>Attribué à</td>
            <td><input name="attribue" id="attribue" type="text"><br>
            </td>
           </tr>
            <tr>
            <td>Associé au dossier</td>
            <td><select name="ref_id_folders" id="ref_id_folders">
            <?php
               
                 foreach ($array_folders as $row){
                 echo "<option value='" . $row['id'] . "'>" . $row['nom'] . "</option>";
                }
            ?>
                </select>
            </td>
           </tr>
          <tr>
              <td><input type="submit" name="ajouter" value="Ajouter"></td>
          </tr>
           <tr>
              <td><input type="submit" name="modifier" formmethod="POST" form="form_apostille" formaction="?target_link=VIEWAPOSTILLES&action=UPDATE" value="Modifier"></td>
          </tr>
        </tbody>
      </table>
    </form>
    </div>
     <a class="return" href="?target_link=MAINVIEW">Retour</a>
  </body>
</html>
