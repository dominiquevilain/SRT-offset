<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Décaler les codes temporels d’un Srt</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<form id="sendSrt" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <div>
        <label for="srt">Fichier srt &agrave; transformer</label>
        <input type="file" name="srt" id="srt">
    </div>
    <div id="values">
        <div>
            <label for="offset">Secondes </label>
            <input type="text" name="offset" id="offset" size="5">
        </div>
        <div>
            <label for="plus">Ajouter</label>
            <input type="radio" name="sign" id="plus" value="+">
        </div>
        <div>
            <label for="moins">Supprimer</label>
            <input type="radio" name="sign" id="moins" value="-">
        </div>
    </div>
    <div>
        <input type="submit" value="Envoyer">
    </div>
</form>
</body>
</html>
