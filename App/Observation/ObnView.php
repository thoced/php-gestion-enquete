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
    prevText: 'Précédent',
    nextText: 'Suivant',
    currentText: 'Aujourd\'hui',
    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    monthNamesShort: ['Janv.', 'F�vr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Ao�t', 'Sept.', 'Oct.', 'Nov.', 'D�c.'],
    dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
    dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
    dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
    weekHeader: 'Sem.',
    dateFormat: 'yy-mm-dd',
    firstDay : 1,
    changeYear: true,
    yearRange:'-130:+1'
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

function valide_hour(input){
    
   var res = input.value.split(":");
   if(res.length != 2){
       alert("L'heure doit être du format suivant : hh:mm");
       input.value = "";
       return false;
   }
   
   if(res[0].length > 2 || res[0].length < 1){
       alert("L'heure doit être du format suivant : hh:mm");
       input.value = "";
       return false;
   }
   
    if(res[1].length > 2 || res[1].length < 1){
       alert("L'heure doit être du format suivant : hh:mm");
       input.value = "";
       return false;
   }
   
   if(isNaN(res[0]) || isNaN(res[1])){
       alert("L'heure doit être du format suivant : hh:mm");
       input.value = "";
       return false;
   }
    
    return true;
}



   </script>
        <title></title>
    </head>
    <body>
        <h1 class="Title" style="text-align: center;">Rapport d'observation</h1>
        <br>
        <div class="list">
            <table width="90%">
                <tr>
                    <td><b>Date et Heure</b></td>
                    <td><b>Observation</b></td>
                    <td><b>Option</b></td>
                </tr>
                <?php
                    foreach($array_obn as $row){
                          
                        echo "<tr onmouseover='mouseOver(this);' onmouseout='mouseOut(this);'>"
                        . "<td>" . $row['date'] . "</td>"
                        . "<td>" . $row['rapport'] . "</td>"
                        . "<td><a class='supprimer' onclick='return validedelete();'href='?target_link=VIEWOBN&action=DELETE&id=" . $row['id'] . "'>Supprimer</a></td>"
                        . "</tr>";
                    }
                   
                ?>
                
            </table>
        </div>
        <br>
       
        
        <div class="form">
            <form action="?target_link=VIEWOBN&action=INSERT" method="POST" name="form_obn">
                <table width="90%">
                    <tr>
                        <td>Date:</td>
                        <td><input class="datepicker" name="date" ></td>
                    </tr>
                    <tr>
                        <td>Heure:</td>
                        <td><input type="text" name="heure" onchange="valide_hour(this);"> <i>(hh:mm)</i></td>
                    </tr>
                    <tr>
                        <td>Observation:</td>
                        <td><textarea name="rapport" rows="8" cols="64"></textarea></td>
                    </tr>
                     <tr>
                        <td></td>
                        <td><input type="submit" value="Enregistrer" onclick="return verifForm();"></td>
                    </tr>
                    
                </table>
            </form>
        </div>
        
               
        <a class="return" href="?target_link=MAINVIEW">Retour</a>
    </body>
</html>
