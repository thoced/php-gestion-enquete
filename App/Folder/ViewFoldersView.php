<html>
  <head>
    <meta content="text/html; charset=windows-1252" http-equiv="content-type">
    <link rel="stylesheet" href="./Style/.AppCss.css">
    <script>
function mouseOver(tr){
    tr.style.backgroundColor = "#5dade2"
}

function mouseOut(tr){
    tr.style.backgroundColor = null;
}
    </script>
  </head>
  <body>
       <h1 style="text-align: center;">Selection d'un dossier</h1>
      <br>
    <br>
    <br>
<div class="list">
<table width=90%" align="center">
    <tr>
        <td>Num</td>
        <td>Nom</td>
        <td>Commentaire</td>
    </tr>
    <?php 
    $i =1;
    while($folder = $req->fetch())
    { 
        echo  "<tr onmouseover='mouseOver(this);' onmouseout='mouseOut(this);'>"
            . "<td>" . $i. "</td>" // 0 au lieu de id car la requete récupère plusieurs types d'id
            . "<td>" . $folder['nom'] . "</td>"
            . "<td>" . $folder['commentaire']. "</td>"
                . "<td><a class='contenu' href='?target_link=VIEWDOSSIERS&action=SELECT&id=" . $folder[0]."'>Cliquez ici pour sélectionner</a>"
                . "<td><a class='contenu' href='?target_link=VIEWDOSSIERS&action=FAITS&id=" . $folder[0]."'>Faits</a>"   
            . "</tr>";
        $i++;
    }
?>
</table>
</div>
<br>
 <a class="return" href="?target_link=MAINVIEW">Retour</a>
  </body>