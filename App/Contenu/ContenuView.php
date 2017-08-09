<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./Style/.AppCss.css"> 
        <title></title>
    </head>
    <body>
         <h1 style="text-align: center;">Vue sur le contenu</h1>
         <form name="form_contenu" action="<?php echo '?target_link=VIEWCONTENU&action=UPDATE&id=' . $id; ?>" method="POST">
        <div class="contenuArea">
            <p style="text-align: center;">
            <textarea  name="contenu" cols="128" rows="42"><?php echo $contenu;?></textarea>
            </p>
        </div>
         <p style="text-align: center;"><input type="submit" value="Enregistrer"></p>
         </form>
        <a class="return" href="?target_link=VIEWDOCUMENTS">Retour</a>
    </body>
</html>
