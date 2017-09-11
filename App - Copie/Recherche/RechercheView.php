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
        <h1 class="Title" style="text-align: center;">Module de recherche de contenu</h1>
        <div class="form">
            <form action="?target_link=VIEWRECHERCHES&action=SELECT" method="POST" name="form_recherche_contenu">
            <table style="width:100%;">
                <tr>
                    <td>
                        Contenu à rechercher:
                    </td>
                    <td>
                        <textarea cols="64" rows="8" name="contenu"></textarea>
                    </td>
                </tr> 
                <tr>
                    <td>
                        <br>
                    </td>
                    <td>
                        <input type="submit" value="Rechercher">
                    </td>
                </tr>
            </table>
            </form>
        </div>
        <a class="return" href="?target_link=MAINVIEW">Retour</a>
    </body>
</html>
