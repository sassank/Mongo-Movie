<?php

require 'vendor/autoload.php'; // include Composer's autoloader

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->Cinema->film;

if (isset($_GET['id'])) {
    $films = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
}

if (isset($_POST['submit'])) {


    $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
        ['$set' => [
            'idFilm' => $_POST['idFilm'],
            'titre' => $_POST['titre'],
            'realisateur' => $_POST['realisateur'],
            'duree' => $_POST['duree'],
            'sortie' => $_POST['sortie'],
            'films' => $_POST['films'],
        ]]
    );

    $_SESSION['success'] = "Film modifie";
    header("Location: modification.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modifier le film</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body>


    <div class="container">
        <h1 align="center">Modifier le film</h1>
        <br>

        <form align="center" method="POST">
            Id : <input name="idFilm" placeholder="ID" value="<?php echo $films["idFilm"] ?>" /></br><br>
            Titre : <input name="titre" placeholder="Titre" value="<?php echo $films["titre"] ?>" /></br><br>
            Realisateur : <input name="realisateur" placeholder="realisateur" value="<?php echo $films["realisateur"] ?>" /></br></br>
            Duree : <input name="duree" placeholder="duree" value="<?php echo $films["duree"] ?>" /></br><br>
            Sortie : <input name=" sortie" placeholder="sortie" value="<?php echo $films["sortie"] ?>" /></br></br>
            Acteurs : <input name="acteurs" placeholder="acteurs" value="<?php print_r($films["acteurs"]) ?>" /></br><br>
            <input type="submit" name="submit" class="btn btn-success" value="Mettre a jour">
            <a href="modification.php" class="btn btn-primary">Retour</a>
        </form>


    </div>
</body>

</html>