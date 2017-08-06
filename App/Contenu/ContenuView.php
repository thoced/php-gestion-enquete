<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./Style/.AppCss.css"> 
        <title></title>
    </head>
    <body>
         <form name="form_contenu" action="<?php echo '?target_link=VIEWCONTENU&action=UPDATE&id=' . $id; ?>" method="POST">
        <div class="contenuArea">
            <p style="text-align: center;">
            <textarea  name="contenu" cols="128" rows="64"><?php echo $contenu;?></textarea>
            </p>
        </div>
         <p style="text-align: center;"><input type="submit" value="Enregistrer"></p>
         </form>
        <a class="return" href="#null"  onclick="javascript:history.back();">Retour</a>
    </body>
</html>
