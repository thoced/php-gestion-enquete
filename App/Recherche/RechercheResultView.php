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
        <title></title>
    </head>
    <body>
         <h1 style="text-align: center;">Résultat des recherches</h1>
        <div class="list">
            <table style="width: 100%;">
            <?php
            $i = 1;
            while($row = $req->fetch()){
       echo "<tr><td>" . $i . "</td>"
               . "<td>" . $row['type'] . "</td>" 
    . "<td>" . $row['titre'] . '</td>'
               . '<td>' . $row['commentaire'] . '</td>'
               . '<td>' . $row['date'] . '</td>'
               . '<td>' . $row['reference'] . '</td>'
               . '<td>' . '<a href="?target_link=VIEWSELECTANNEXES&id=' . $row[0] . '">Annexes</a>' . '</td>'
               . '<td>' . '<a class="contenu" href="?target_link=VIEWCONTENU&id=' . $row['0'] . '">Contenu</a>'.  '</td>'
               . '</tr>';
       $i++;
            }
           
            ?>
                
            </table>
        </div>
         <a class="return" href="?target_link=VIEWRECHERCHES">Retour</a>
    </body>
</html>
