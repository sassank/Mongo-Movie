<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <title>Cinema</title>
</head>

<header class="header">
    <img src="images/mongodb.png" class="logoMongo" weight="80" height="80" alt="Mongodb">
    <img src="images/cine.png" class="logoCine" weight="80" height="80" alt="Mongodb">
    <h1 align=" center">Supprimer des acteurs, films ou realisateurs</h1><br>
    <ul align=" center" id="nav">
        <li id="nav-home"><a href="index.php">Accueil</a></li>
        <li id="nav-about"><a href="ajout.php">Ajout</a></li>
        <li id=" nav-archive"><a href="modification.php">Modification</a></li>
        <li id="nav-lab"><a href="suppression.php">Suppression</a></li>
    </ul>
</header>
<br>

<body class=body>
    <p align="center">Supprimer un Realisateur</p>
    <br>
    <form align="center" action="suppression.php" method="post">
        <input type="text" name="nomReal" placeholder="Nom Real.">
        <input class="bouton" type="submit" value="Supprimer">
    </form><br>

    <?php
    // This path should point to Composer's autoloader
    require 'vendor/autoload.php';

    if ($_POST) {
        $client = new MongoDB\Client("mongodb://localhost:27017");

        $cinemaDB = $client->Cinema;
        $collection = $cinemaDB->realisateur;

        $deleteResult = $collection->delete(
            ['nomReal' =>  $_POST["nomReal"]],
        );
        print_r("Realisateur Supprime", $deleteResult->getDeletedCount());
    }

    ?>

</body>

</html>