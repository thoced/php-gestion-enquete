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
        <div class="exception">
            <p style="text-align: center;">

        <?php
        
        echo "Message: <b>" . $exception->getMessage() . "</b><br><br>";
        echo "File: <b>" . $exception->getFile() . "</b><br>";
        echo "Line: <b>" . $exception->getLine() . "</b><br><br>";
        
        echo "<p style='background-color: #dc7633 ;text-align:center;'>Trace: " . $exception->getTraceAsString() . "</p><br>";
        ?>
                <br>
            <a href=".">Retour à l'application</a>
            </p>
        </div>
    </body>
</html>
