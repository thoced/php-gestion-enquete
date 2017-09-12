<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./jquery-ui-1.12.1/jquery-ui.css">
        <link rel="stylesheet" href="./Style/.AppCss.css"> 
         <script src="jquery-3.2.1.js"></script>
         <script src="./jquery-ui-1.12.1/jquery-ui.js"></script>
         <script  type="application/x-javascript">
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
    dateFormat: 'yy-mm-dd',
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

function validedelete(){
    if(confirm("Etes vous sûr de vouloir supprimer cet élément ?")){
        return true;
    }
    else {
        return false;
        }
}

function verifForm(){
    var date = document.getElementsByName("date_creation");
    if(date[0].value.length < 10){
        alert('Une date de création doit obligatoirement être fournie')
        return false;
    }
    
    return true;
    
}

function doneClick(checkedBox,id){
   
   if(!confirm("Vous êtes sur le point de modifier le statut de cette tâche, êtes-vous sûr de vouloir le modifier ?")){
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

function copyClipboard(elem){
    var clipboard = elem.getElementsByClassName('infoBulle')[0];
    var textArea = document.createElement("TEXTAREA");
    var t = document.createTextNode(clipboard.innerText);
    textArea.appendChild(t);
    document.body.appendChild(textArea);
    textArea.select();
    var successful = document.execCommand('copy');
    textArea.style.visibility = "hidden";
    if(!successful)
        alert("Une erreur est survenue lors de la copie de l'élement dans le presse papier")
    
}
         </script>
        <title></title>
    </head>
    <body>
        <h1 class="Title" style="text-align: center;">Tâches restantes à réaliser sur l'ensemble des dossiers</h1>
        <br>
        <div class="list">
            <table width="90%">
                <tr>
                    <td>Num:</td>
                    <td>Dossier:</td>
                    <td>Libelle:</td>
                    <td>Commentaire:</td>
                    <td>Date de création:</td>
                    <td>Date de rappel:</td>
                </tr>
                <?php
                    $i = 1;
                    while($row = $req->fetch()){
                        
                        $checked = "";
                        if($row['statut'] == 1)
                            $checked = "checked";
                        
                        echo "<tr onmouseover='mouseOver(this);' onmouseout='mouseOut(this);'>"
                        . "<td>" . $i . ".</td>"
                        . "<td><b>" . $row['nom'] . "</b></td>"
                        . "<td>" . $row['libelle'] . "</td>"
                        . "<td><a onclick='copyClipboard(this);' href='#'>" . substr($row['todocommentaire'], 0,16) . " ...<span id='copy' class='infoBulle'>" . $row['todocommentaire'] . "</span></a></td>"
                        . "<td>" . $row['date_creation'] . "</td>"
                        . "<td>" . $row['date_rappel'] . "</td>"
                        //. "<td><input " . $checked . " type='checkbox' name='done' onclick='return doneClick(this," . $row['id'] . ");'></td>"
                       // . "<td><a class='supprimer' onclick='return validedelete();'href='?target_link=VIEWTODO&action=DELETE&id=" . $row['id'] . "'>Supprimer</a></td>"
                        . "</tr>";
                     $i++;
                    }
                   
                ?>
                
            </table>
        </div>
        <br>
            
        <a class="return" href="?target_link=MAINVIEW">Retour</a>
    </body>
</html>
