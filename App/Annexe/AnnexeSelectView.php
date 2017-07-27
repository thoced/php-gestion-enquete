<script>
function openNewWindow(id){
       window.open("?target_link=VIEWSELECTANNEXES&action=SELECT&id=" + id);
}        
</script>
<div class="listAnnexe">
            <table width="90%" align="center">
                <tr>
                    <td><b><u>Libelle</u<</b></td>
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

