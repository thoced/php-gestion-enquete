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
        <link rel="stylesheet" href="./jquery-ui-1.12.1/jquery-ui.css">
         <script src="jquery-3.2.1.js"></script>
         <script src="./jquery-ui-1.12.1/jquery-ui.js"></script>
         <script>
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
         </script>
        <title></title>
    </head>
    <body>
        <h1 style="text-align: center;">Suivi chronologique de l'enquête</h1>
        <div class="list">
            <table width="100%">
                <tr>
                    <td>Num:</td>
                    <td>Date</td>
                    <td>Commentaire</td>
                </tr>
                <?php
                    $i = 1;
                    while($row = $req->fetch()){
                        echo "<tr>"
                        . "<td>" . $i . ".</td>"
                        . "<td>" . $row['date'] . "</td>"
                           . "<td>" . $row['commentaire'] . "</td>"
                                . "</tr>";
                     $i++;
                    }
                   
                ?>
            </table>
        </div>
        <br>
        <div class="form">
            <form action="?target_link=VIEWSYNOPSIS&action=INSERT" method="POST" name="form_synopsis">
                <table width="100%">
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
