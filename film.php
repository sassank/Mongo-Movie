<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <title>Films</title>
</head>

<header class="header">
    <img src="images/mongodb.png" class="logoMongo" weight="80" height="80" alt="Mongodb">
    <img src="images/cine.png" class="logoCine" weight="80" height="80" alt="Mongodb">
    <h1 align=" center">Les Films</h1><br>
    <ul align=" center" id="nav">
        <li id="nav-home"><a href="index.php">Accueil</a></li>
        <li id="nav-about"><a href="ajout.php">Ajout</a></li>
        <li id=" nav-archive"><a href="modification.php">Modification</a></li>
    </ul>
</header>
<br>

<body class=body>
    <?php

    require 'vendor/autoload.php';
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $client->Cinema->film;
    $films = $collection->find();
    ?>

    <html>

    <head>

    </head>

    <body>
        <table class='table' border=1 cellspacing=1 cellpadding=11>
            <tr>
                <td>Id</td>
                <td>Titre</td>
                <td>Réalisateur</td>
                <td>Durée (minutes)</td>
                <td>Année de sortie</td>
                <td>Acteurs</td>
            </tr>
            <?php
            foreach ($films as $row) {
            ?>
                <tr>
                    <td><?php echo $row['idFilm'] ?></td>
                    <td><?php echo $row['titre'] ?></td>
                    <td><?php echo $row['realisateur'] ?></td>
                    <td><?php echo $row['duree'] ?></td>
                    <td><?php echo $row['sortie'] ?></td>
                    <td><?php print_r($row->acteurs) ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
        <div align="center">
            <a class="btn btn-primary" href="index.php" align="center">Retour</a>
            <br><br>
        </div>
    </body>

    </html>