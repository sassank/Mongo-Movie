<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <title>Réalisateurs</title>
</head>

<header class="header">
    <img src="images/mongodb.png" class="logoMongo" weight="80" height="80" alt="Mongodb">
    <img src="images/cine.png" class="logoCine" weight="80" height="80" alt="Mongodb">
    <h1 align=" center">Les Réalisateurs</h1><br>
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
    $collection = $client->Cinema->realisateur;
    $realisateurs = $collection->find();
    ?>

    <html>

    <body>
        <table class='table' border=1 cellspacing=1 cellpadding=11>
            <tr>
                <td>Id</td>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Nationalité</td>
                <td>Film réalisé</td>
            </tr>
            <?php
            foreach ($realisateurs as $row) {
            ?>
                <tr>
                    <td><?php echo $row['idReal'] ?></td>
                    <td><?php echo $row['nomReal'] ?></td>
                    <td><?php echo $row['prenomReal'] ?></td>
                    <td><?php echo $row['nationalite'] ?></td>
                    <td><?php echo $row['filmRealise'] ?></td>
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