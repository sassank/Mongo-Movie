<?php

session_start();
require 'config.php';

if (isset($_GET['id'])) {
    $acteurs = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
}

if (isset($_POST['submit'])) {


    $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
        ['$set' => [
            'idAct' => $_POST['idAct'],
            'nomAct' => $_POST['nomAct'],
            'prenomAct' => $_POST['prenomAct'],
            'filmJoue' => $_POST['filmJoue'],
        ]]
    );

    $_SESSION['success'] = "Acteur modifie";
    header("Location: modification.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modif Acteur</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body>

    <h1 align="center">Modifier l'acteur</h1>
    <br>
    <div class="container">
        <form align="center" method="POST">
            Id : <input name="idAct" placeholder="Id" value="<?php echo $acteurs["idAct"] ?>" /></br><br><br>
            Nom : <input name="nomAct" placeholder="Nom" value="<?php echo $acteurs["nomAct"] ?>" /></br><br><br>
            Prenom : <input name="prenomAct" placeholder="Prenom" value="<?php echo $acteurs["prenomAct"] ?>" /></br></br></br>
            Film joue : <input name="filmJoue" placeholder="" value="<?php echo $acteurs["filmJoue"] ?>" /></br></br></br>
            <input type="submit" name="submit" class="btn btn-success" value="Mettre a jour">
            <a href="modification.php" class="btn btn-primary">Retour</a>
        </form>

    </div>
</body>

</html>