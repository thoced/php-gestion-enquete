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

function copyClipboard(elem){
    var clipboard = elem.getElementsByClassName('infoBulle')[0];
    var textArea = document.createElement("TEXTAREA");
    var t = document.createTextNode(clipboard.innerText);
    textArea.appendChild(t);
    document.body.appendChild(textArea);
    textArea.select();
    var successful = document.execCommand('copy');
    textArea.style.visibility = "hidden";
    if(!successful)
        alert("Une erreur est survenue lors de la copie de l'élement dans le presse papier")
    
}
function valide_filtre(id){
   
    var xhr = new XMLHttpRequest();  
     xhr.onreadystatechange = function(event){
         if(xhr.readyState == XMLHttpRequest.DONE){
             if(xhr.status === 200){
               
                var p = document.createElement("TABLE");
                p.innerHTML = xhr.responseText;
                var div = document.getElementById("div_show");
               while (div.firstChild) {
                    div.removeChild(div.firstChild);
               }
               p.setAttribute("width","90%");
               p.setAttribute("align","center");
               div.appendChild(p);
               // div.removeNode(p);
              
             }
         }
     };
     // xhr.setRequestHeader('Content-Type',  'text/xml');
     xhr.open("GET", "index.php?target_link=VIEWDOSSIERS&action=FILTRE&idgroupselected=" + id.value, true);
     xhr.send(null);
}

    </script>
  </head>
  <body>
       <h1 class="Title" style="text-align: center;">Selection d'un dossier</h1>
      <br>
       <div class="filtre">
       Filtre de sélection: <select onchange="valide_filtre(this);" name="filtre_id_group" id="filtre_id_group">
            echo "<option value='-1'>Tous les groupes</option>
            <?php 
                 foreach ($array_group as $row){
                     echo "<option value='" . $row['id'] . "'>" . $row['group_name'] . "</option>";
                 }
            ?>
        </select>
       </div> 
    <br>
    <br>
<div class="list" id="div_show">
<table width=90%" align="center">
    <tr>
        <td>Num</td>
        <td>Nom</td>
        <td>Commentaire</td>
    </tr>

    <?php 
    $i = 1;
    while($folder = $req->fetch())
    { 
        echo  "<tr onmouseover='mouseOver(this);' onmouseout='mouseOut(this);'>"
            . "<td>" . $i. "</td>" // 0 au lieu de id car la requete récupère plusieurs types d'id
            . "<td>" . $folder['nom'] . "</td>"
            . "<td><a onclick='copyClipboard(this);'href='#'>" . substr($folder['commentaire'],0,16) . " ...<span class='infoBulle'>"  .$folder['commentaire'] . "</span></td>"
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
