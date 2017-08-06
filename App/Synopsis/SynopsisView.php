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
         </script>
        <title></title>
    </head>
    <body>
        <h1 style="text-align: center;">Suivi chronologique de l'enquête</h1>
        <br>
        <div class="list">
            <table width="90%">
                <tr>
                    <td>Num:</td>
                    <td>Date</td>
                    <td>Commentaire</td>
                </tr>
                <?php
                    $i = 1;
                    while($row = $req->fetch()){
                        echo "<tr onmouseover='mouseOver(this);' onmouseout='mouseOut(this);'>"
                        . "<td>" . $i . ".</td>"
                        . "<td>" . $row['date'] . "</td>"
                        . "<td>" . $row['commentaire'] . "</td>"
                        . "<td><a class='supprimer' onclick='return validedelete();'href='?target_link=VIEWSYNOPSIS&action=DELETE&id=" . $row['id'] . "'>Supprimer</a></td>"
                        . "</tr>";
                     $i++;
                    }
                   
                ?>
            </table>
        </div>
        <br>
        <div class="form">
            <form action="?target_link=VIEWSYNOPSIS&action=INSERT" method="POST" name="form_synopsis">
                <table width="90%">
                     <tr>
                        <td>Date:</td>
                        <td><input name="date" id="datepicker"></td>
                    </tr>
                    <tr>
                        <td>Commentaire:</td>
                        <td><input name="commentaire" type="text" maxlength="64" size="64"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Enregistrer"</td>
                    </tr>
                </table>
            </form>
        </div>
        
        <a class="return" href="?target_link=MAINVIEW">Retour</a>
    </body>
</html>
