<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <title>Recherche</title>
</head>

<header class="header">
    <img src="images/mongodb.png" class="logoMongo" weight="80" height="80" alt="Mongodb">
    <img src="images/cine.png" class="logoCine" weight="80" height="80" alt="Mongodb">
    <h1 align=" center">Recherchez des éléments</h1><br>
    <ul align=" center" id="nav">
        <li id="nav-home"><a href="index.php">Accueil</a></li>
        <li id="nav-about"><a href="ajout.php">Ajout</a></li>
        <li id=" nav-archive"><a href="modification.php">Modification</a></li>
    </ul>
</header>
<br><br>

<B>Recherche des réalisateurs de nationalité </B>
<br><br>

<body class="body" align="center">
    <form method="POST">
        <input type="text" name="search">
        <input type="submit" name="search" value="Rechercher">
    </form>
</body>
<br>

<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->Cinema->realisateur;

if (isset($_POST['search'])) {

    $query = [
        'nationalite' => 'américain'
    ];

    $options = [];

    $cursor = $collection->find($query, $options);

    foreach ($cursor as $document) {
        echo $document['prenomReal'] . "\n";
        echo $document['nomReal'] . "\n -> ";
        echo $document['nationalite'] . "\n, ";
    }
}


?>
<br><br>

<B>Afficher le(s) film(s) sorti(s) entre 2 dates</B>
<br><br>
<form method="POST">
    Date 1 : <input type="number" placeholder="YYYY" min="1950" max="2100"><br><br>
    Date 2 : <input type="number" placeholder="YYYY" min="2017" max="2100"><br><br>
    <input type="submit" name="search2">
</form>
<br>
<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->Cinema->film;

if (isset($_POST['search2'])) {
    $query = [
        'sortie' => [
            '$gt' => 1950.0
        ]
    ];

    $options = [];

    $cursor = $collection->find($query, $options);

    foreach ($cursor as $document) {
        echo $document['titre'] . "\n -> ";
        echo $document['sortie'] . " \n  ";
    }
}
?>
<br><br>

<B>Recherche d’acteurs dont le prénom commence par la lettre</B>
<br><br>
<form method="POST">
    <input type="text">
    <input type="submit" name="search3" value="Rechercher">
    <br><br>

    <?php
    require 'vendor/autoload.php';

    use MongoDB\BSON\Regex;
    use MongoDB\Client;

    $client = new Client('mongodb://localhost:27017');
    $collection = $client->Cinema->acteur;

    if (isset($_POST['search3'])) {
        $query = [
            'prenomAct' => new Regex('J')
        ];

        $options = [];

        $cursor = $collection->find($query, $options);

        foreach ($cursor as $document) {
            echo $document['prenomAct'] . "\n, ";
        }
    }

    ?> <br><br><br>
    <div align="center">
        <a class="btn btn-primary" href="index.php" align="center">Retour</a>
        <br><br>
    </div>

</html>