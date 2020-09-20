<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <title>Modification</title>
</head>

<header class="header">
    <img src="images/mongodb.png" class="logoMongo" weight="80" height="80" alt="Mongodb">
    <img src="images/cine.png" class="logoCine" weight="80" height="80" alt="Mongodb">
    <h1 align=" center">Modification et Suppression</h1><br>
    <ul align=" center" id="nav">
        <li id="nav-home"><a href="index.php">Accueil</a></li>
        <li id="nav-about"><a href="ajout.php">Ajout</a></li>
        <li id=" nav-archive"><a href="modification.php">Modification</a></li>
    </ul>
</header>
<br>

<html>

<body class=body>
    <?php

    require 'vendor/autoload.php';
    $client = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $client->Cinema->acteur;
    $acteurs = $collection->find();
    ?>

    <h1 align=" center">Acteurs</h1>
    <br>

    <body>
        <table class='table' border=1 cellspacing=1 cellpadding=11>
            <tr>
                <td>Nom</td>
                <td>Prenom</td>
                <td>Action</td>
            </tr>
            <?php
            foreach ($acteurs as $row) {

            ?>
                <tr>
                    <td><?php echo $row['nomAct'] ?></td>
                    <td><?php echo $row['prenomAct'] ?></td>
                    <td><a href="updateActeur.php?id=<?php echo $row['_id']; ?>">Modifier</a> |
                        <a href="deleteActeur.php?id=<?php echo $row['_id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>



        <?php

        require 'vendor/autoload.php';
        $client = new MongoDB\Client("mongodb://localhost:27017");
        $collection = $client->Cinema->film;
        $films = $collection->find();
        ?>

        <br><br>
        <h1 align=" center">Films</h1>
        <br>

        <table class='table' border=1 cellspacing=1 cellpadding=11>
            <tr>
                <td>Titre</td>
                <td>Action</td>
            </tr>
            <?php
            foreach ($films as $row) {
            ?>
                <tr>
                    <td><?php echo $row['titre'] ?></td>
                    <td><a href="updateFilm.php?id=<?php echo $row['_id']; ?>">Modifier</a> |
                        <a href="deleteFilm.php?id=<?php echo $row['_id']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>


        <?php

        require 'vendor/autoload.php';
        $client = new MongoDB\Client("mongodb://localhost:27017");
        $collection = $client->Cinema->realisateur;
        $realisateurs = $collection->find();
        ?>


        <br><br>
        <h1 align=" center">Réalisateurs</h1>
        <br>

        <table class='table' border=1 cellspacing=1 cellpadding=11>
            <tr>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Action</td>
            </tr>
            <?php
            foreach ($realisateurs as $row) {
            ?>
                <tr>
                    <td><?php echo $row['nomReal'] ?></td>
                    <td><?php echo $row['prenomReal'] ?></td>
                    <td><a href="updateReal.php?id=<?php echo $row['_id']; ?>">Modifier</a> |
                        <a href="deleteReal.php?id=<?php echo $row['_id']; ?>">Supprimer</a>
                    </td>
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

</body>

</html>