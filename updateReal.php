<?php

require 'vendor/autoload.php'; // include Composer's autoloader

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->Cinema->realisateur;

if (isset($_GET['id'])) {
    $realisateurs = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
}

if (isset($_POST['submit'])) {

    $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
        ['$set' => [
            'idReal' => $_POST['idReal'],
            'nomReal' => $_POST['nomReal'],
            'prenomReal' => $_POST['prenomReal'],
            'nationalite' => $_POST['nationalite'],
            'filmRealise' => $_POST['filmRealise']
        ]]
    );

    $_SESSION['success'] = "Realisateur modifie";
    header("Location: modification.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modifier le realisateur</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body>


    <div class="container">
        <h1 align="center">Modifier le réalisateur</h1>
        <br>

        <form align="center" method="POST">
            Id : <input name="idReal" placeholder="ID" value="<?php echo $realisateurs["idReal"] ?>" /></br><br>
            Nom : <input name="nomReal" placeholder="Nom" value="<?php echo $realisateurs["nomReal"] ?>" /></br><br>
            Prenom : <input name="prenomReal" placeholder="prenomReal" value="<?php echo $realisateurs["prenomReal"] ?>" /></br></br>
            Nationalite : <input name="nationalite" placeholder="nationalite" value="<?php echo $realisateurs["nationalite"] ?>" /></br><br>
            Nom : <input name="nomReal" placeholder="Nom" value="<?php echo $realisateurs["nomReal"] ?>" /></br><br>
            Film realise : <input name="filmRealise" placeholder="filmRealise" value="<?php echo $realisateurs["filmRealise"] ?>" /></br><br>
            <input type="submit" name="submit" class="btn btn-success" value="Mettre a jour">
            <a href="modification.php" class="btn btn-primary">Retour</a>
        </form>


    </div>
</body>

</html>