<!--?php
/*  * To change this license header, choose License Headers in Project Properties. * To change this template file, choose Tools | Templates * and open the template in the editor. */-->
<html>
  <head>
    <meta content="text/html; charset=windows-1252" http-equiv="content-type">
    <link rel="stylesheet" href="./jquery-ui-1.12.1/jquery-ui.css">
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
    dateFormat: 'dd-mm-yy',
    firstDay : 1
    });
});
    </script>
  </head>
 
  <body>&nbsp; <br>
    <br>
    <br>
    <table width="100%">
    <?php
        while($row = $req->fetch()){
       echo "<tr>"
    . "<td>" . $row['nom'] . '</td>'
               . '<td>' . $row['prenom'] . '</td>'
               . '<td>' . $row['adresse'] . '</td>'
               . '<td>' . $row['date_naissance'] . '</td>'
               . '<td>' . $row['qualite'] . '</td>'
               . '<td>' . '<a href="?target_link=VIEWPERSONNES&action=DELETE&id=' . $row['id'] . '">Supprimer</a>' . '</td>';
        }
    ?>
    </table>
    <br>
    <form method="POST" action="?target_link=VIEWPERSONNES" name="form_personne">
      <table style="width: 100%;" border="0">
        <tbody>
          <tr>
            <td>Nom</td>
            <td><input maxlength="32" size="32" name="nom" type="text"><br>
            </td>
          </tr>
          <tr>
            <td>Prenom</td>
            <td><input maxlength="32" size="32" name="prenom" type="text"></td>
          </tr>
          <tr>
            <td style="width: 133.683px;">Adresse</td>
            <td style="width: 495.317px;"><input maxlength="128" size="128" name="adresse"

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
              <select name="qualite">
                <option value="Suspect">Suspect</option>
                <option value="Victime">Victime</option>
                <option value="Temoin">Temoin</option>
                <option value="Source">Source</option>
              </select>
              <br>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
    <a href="?target_link=MAINVIEW">Retour</a><br>
  </body>
</html>
