<table>
    <tr>
        <td>Num</td>
        <td>Nom</td>
        <td>Commentaire</td>
    </tr>
    <?php foreach($listFolders as $folder)
    { 
        echo  "<tr>"
            . "<td>" . $folder->id . "</td>"
            . "<td>" . $folder->nom . "</td>"
            . "<td>" . $folder->commentaire . "</td>"
                . "<td><a href='?target_link=VIEWDOSSIERS&IDSELECT=" . $folder->id ."'>Cliquez ici pour sélectionner</a>"   
            . "</tr>";
        
    }
?>
</table>
<br>
<a href="?target_link=MAINVIEW">Retour</a>