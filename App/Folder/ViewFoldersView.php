<table>
    <tr>
        <td>Num</td>
        <td>Nom</td>
        <td>Commentaire</td>
    </tr>
    <?php while($folder = $req->fetch())
    { 
        echo  "<tr>"
            . "<td>" . $folder[0]. "</td>" // 0 au lieu de id car la requete récupère plusieurs types d'id
            . "<td>" . $folder['nom'] . "</td>"
            . "<td>" . $folder['commentaire']. "</td>"
                . "<td><a href='?target_link=VIEWDOSSIERS&action=SELECT&id=" . $folder[0]."'>Cliquez ici pour sélectionner</a>"   
            . "</tr>";
        
    }
?>
</table>
<br>
<a href="?target_link=MAINVIEW">Retour</a>