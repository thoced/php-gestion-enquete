<html>
  <head>
    <meta content="text/html; charset=windows-1252" http-equiv="content-type">
   <link rel="stylesheet" href="./jquery-ui-1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="./Style/.AppCss.css"> 
    <script src="jquery-3.2.1.js"></script>
    <script src="./jquery-ui-1.12.1/jquery-ui.js"></script>
    <script>
function mouseOver(tr){
    tr.style.backgroundColor = "#5dade2"
}

function mouseOut(tr){
    tr.style.backgroundColor = null;
}

     
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
       <h1 class="Title" style="text-align: center;">Vue des faits associés au dossier</h1>
      <br>
    <br>
    <br>
<div class="list">
<table width=90%" align="center">
    <tr>
        <td>Num</td>
        <td>Fait</td>
        <td>Date Basse</td>
        <td>Date Haute</td>
        <td>Numero de pv initial</td>
    </tr>
    <?php 
    $i =1;
    while($row = $req->fetch())
    { 
        echo  "<tr onmouseover='mouseOver(this);' onmouseout='mouseOut(this);'>"
            . "<td>" . $i. "</td>" // 0 au lieu de id car la requete récupère plusieurs types d'id
            . "<td>" . $row['fait'] . "</td>"
            . "<td>" . $row['date_basse']. "</td>"
            . "<td>" . $row['date_haute']. "</td>"
            . "<td>" . $row['pv']. "</td>"
            . "<td><a onclick='return verifDelete();'class='supprimer' href='?target_link=VIEWDOSSIERS&action=DELFAITS&id=" . $row[0] . "&ref_id_folders=" . $row['ref_id_folders'] ."'>Supprimer</a></td>"
            . "</tr>";
        $i++;
    }
?>
</table>
</div>
<br>

<br>
    <div class="form">
    <form method="POST" action="?target_link=VIEWDOSSIERS&action=ADDFAITS" name="form_fait">
      <table>
        <tbody>
          <tr>
            <td>Fait</td>
           <td>
              <select name="fait" id="fait">
              <?php
                while($row = $reqListFait->fetch())
                    echo "<option value='" . $row['id'] . "'>" . $row['fait'] . "</option>";
               ?>
              </select>
        </td>
          </tr>
          <tr>
            <td>Date Basse</td>
            <td><input class="datepicker" name="date_basse" type="text"></td>
          </tr>
          <tr>
            <td>Date Haute</td>
            <td style="height: 40px;"><input class="datepicker" name="date_haute" type="text"><br>
            </td>
          </tr>
          <tr>
            <td>Pv Initial</td>
            <td>
              <input maxlength="64" size="64" name="pv" id="reference"
                type="text">
              <br>
            </td>
          </tr>
          <tr>
                  <tr width="100%">
                   <td width="20%"><input type="submit" value="Ajouter"></td>
          </tr>
          <tr>
         <td><input type="hidden" name="ref_id_folders" value="<?php echo $ref_id_folders; ?>"></td>
         
          </tr>
        </tbody>
      </table>
    </form>
    </div>
 <a class="return" href="?target_link=MAINVIEW">Retour</a>
  </body>