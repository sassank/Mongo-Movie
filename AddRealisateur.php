<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <title>Ajout d'un réalisateur</title>
</head>

<header class="header">
    <img src="images/mongodb.png" class="logoMongo" weight="80" height="80" alt="Mongodb">
    <img src="images/cine.png" class="logoCine" weight="80" height="80" alt="Mongodb">
    <h1 align=" center">Ajoutez des acteurs, films ou réalisateurs</h1><br>
    <ul align=" center" id="nav">
        <li id="nav-home"><a href="index.php">Accueil</a></li>
        <li id="nav-about"><a href="ajout.php">Ajout</a></li>
        <li id=" nav-archive"><a href="modification.php">Modification</a></li>
    </ul>
</header>
<br><br>

<body class=body align="center">
    <h1 class="text-center" align="center" style="margin-top: 5px; padding-top: 10px;">Ajout d'un Réalisateur</h1>
    <br>
    <form align="center" action="AddRealisateur.php" method="post">
        <input type="text" name="idReal" placeholder="Identifiant">
        <input type="text" name="nomReal" placeholder="Nom du realisateur">
        <input type="text" name="prenomReal" placeholder="Prenom du realisateur">
        <input type="text" name="nationalite" placeholder="Nationalite du real.">
        <input type="text" name="filmRealise" placeholder="Entrer un film">
        <input class="bouton" type="submit" value="Ajouter"><br><br><br>
        <a class="btn btn-primary" href="ajout.php" align="center">Retour</a>

    </form><br>
</body>


<?php

require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->Cinema->realisateur;

if ($_POST) {
    $insertOneResult = $collection->insertOne([
        'idReal' => $_POST["idReal"],
        'nomReal' => $_POST["nomReal"],
        'prenomReal' => $_POST["prenomReal"],
        'nationalite' => $_POST["nationalite"],
        'filmRealise' => $_POST["filmRealise"],
    ]);
    printf("Ajout d'un realisateur ayant pour ID :\n", $insertOneResult->getInsertedCount());
    var_dump($insertOneResult->getInsertedId());
}
?>

</html>