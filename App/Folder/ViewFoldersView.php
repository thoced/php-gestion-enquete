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
    <?php while($folder = $req->fetch())
    { 
        echo  "<tr onmouseover='mouseOver(this);' onmouseout='mouseOut(this);'>"
            . "<td>" . $folder[0]. "</td>" // 0 au lieu de id car la requete récupère plusieurs types d'id
            . "<td>" . $folder['nom'] . "</td>"
            . "<td>" . $folder['commentaire']. "</td>"
                . "<td><a class='contenu' href='?target_link=VIEWDOSSIERS&action=SELECT&id=" . $folder[0]."'>Cliquez ici pour sélectionner</a>"   
            . "</tr>";
        
    }
?>
</table>
</div>
<br>
 <a class="return" href="?target_link=MAINVIEW">Retour</a>
  </body>