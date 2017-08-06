<html>
    <head>
    <meta content="text/html; charset=windows-1252" http-equiv="content-type">
    <link rel="stylesheet" href="./jquery-ui-1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="./Style/.AppCss.css"> 
        <title></title>
    </head>
<script>
function openNewWindow(id){
       window.open("?target_link=VIEWSELECTANNEXES&action=SELECT&id=" + id);
}        
</script>
<body>
<div class="listAnnexe">
            <table width="90%" align="center">
                <tr>
                    <td><b><u>Libelle</u></b></td>
                    <td><b><u>Commentaire</u></b></td>
                </tr>
                    <td><br></td>
                    <td></td>
                <br>
                </tr>
                <?php
                   while($row = $req->fetch()){
                       echo "<tr>" ;
                       echo "<td>" . $row['libelle'] ."</td>";
                       echo "<td>" . $row['commentaire'] ."</td>";
                       echo "<td><a onclick='openNewWindow(" . $row['id'] . ");return false;' href='#'>Voir le document</a></td>";
                       echo "<tr>";
                   }
                ?>
            </table>
        </div>
    
    <br>
    <br>
    <br>
    <div class="listAnnexe" style="cursor: default;">
      <form action="<?php echo "?target_link=VIEWSELECTANNEXES&action=INSERT&id=" . $id; ?>" name="form_annexe" method="POST" enctype="multipart/form-data">
        <table width="90%" align="center">
            <tr>
                <td>Libelle</td>
                <td><input type="text" name="libelle">
            </tr>
            <tr>
                <td>Commentaire</td>
                <td><input type="text" name="commentaire">
            </tr>
            <tr>
                <td>Fichier à attacher</td>
                <td><input type="file" name="raw" accept="application/pdf">
            </tr>
            <tr>
                <td><input type="submit" value="Enregistrer l'annexe"</td>
            </tr>
        </table>
      </form>
    </div>
     <a class="return" href="?target_link=VIEWDOCUMENTS">Retour</a>
</body>
</html>
