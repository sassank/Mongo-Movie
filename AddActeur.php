<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <title>Ajout d'un acteur</title>
</head>

<header class="header">
    <img src="images/mongodb.png" class="logoMongo" weight="80" height="80" alt="Mongodb">
    <img src="images/cine.png" class="logoCine" weight="80" height="80" alt="Mongodb">
    <h1 align=" center">Ajoutez des acteurs, films ou realisateurs</h1><br>
    <ul align=" center" id="nav">
        <li id="nav-home"><a href="index.php">Accueil</a></li>
        <li id="nav-about"><a href="ajout.php">Ajout</a></li>
        <li id=" nav-archive"><a href="modification.php">Modification</a></li>
    </ul>
</header><br>

<body class=body>
    <div class="container">
        <h1 class="text-center" align="center" style="margin-top: 5px; padding-top: 10px;">Ajout d'un Acteur</h1>
        <hr>
        <div align="center" class="text-center">

            <?php

            require 'vendor/autoload.php'; // include Composer's autoloader

            use MongoDB\BSON\ObjectId;

            $client = new MongoDB\Client("mongodb://localhost:27017");
            $dataBase     = $client->selectDatabase('Cinema');
            $collection = $dataBase->selectCollection('acteur');

            if (isset($_POST['create'])) {
                $data         = [
                    'idAct'         => $_POST['idAct'],
                    'nomAct'         => $_POST['nomAct'],
                    'prenomAct'     => $_POST['prenomAct'],
                    'filmJoue'     => $_POST['filmJoue']
                ];

                if ($_FILES['file']) {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], 'images/' . $_FILES['file']['name'])) {
                        $data['fileName'] = $_FILES['file']['name'];
                    } else {
                        echo "Le fichier n'a pas put etre uploade !";
                    }
                }

                $result = $collection->insertOne($data);
                if ($result->getInsertedCount() > 0) {
                    echo "l'Acteur a été ajouté";
                } else {
                    echo "Il y a eu un probleme";
                }
            }

            if (isset($_POST['update'])) {

                $filter        = ['_id' => new MongoDB\BSON\ObjectId($_POST['_id'])];

                $data         = [
                    'idAct'         => $_POST['idAct'],
                    'nomAct'         => $_POST['nomAct'],
                    'prenomAct'     => $_POST['prenomAct'],
                    'filmJoue'     => $_POST['filmJoue']
                ];

                $result = $collection->updateOne($filter, ['$set' => $data]);

                if ($result->getModifiedCount() > 0) {
                    echo "les informations de l'Acteur ont etes modifies..";
                } else {
                    echo "Probleme lors de la mise a jour";
                }
            }

            if (isset($_GET['action']) && $_GET['action'] == 'delete') {

                $filter        = ['_id' => new MongoDB\BSON\ObjectId($_GET['aid'])];

                $acteur = $collection->findOne($filter);
                if (!$acteur) {
                    echo "Aucun acteur trouve.";
                }

                $fileName = 'images/' . $acteur['fileName'];
                if (file_exists($fileName)) {
                    if (!unlink($fileName)) {
                        echo "Echec de la suppression.";
                        exit;
                    }
                }

                $result = $collection->deleteOne($filter);

                if ($result->getDeletedCount() > 0) {
                    echo "Acteur supprimee..";
                } else {
                    echo "Echec de la suppression de l'Acteur";
                }
            }

            ?>
        </div>
        <div>
            <div class="col-md-67">
                <form align="center" method="post" action="" enctype="multipart/form-data">
                    <fieldset>

                        <div class="form-group" align="center">
                            <label class="col-md-12" for="description">ID</label>
                            <div class="col-md-35">
                                <input type="text" id="idAct" name="idAct" placeholder="saisir un identifiant" class="form-control"></input>
                            </div>
                        </div><br>

                        <!-- Text input-->
                        <div class="form-group" align="center">
                            <label class="col-md-12" for="description">Nom</label>
                            <div class="col-md-35">
                                <input type="text" id="nomAct" name="nomAct" placeholder="saisir le nom de l'Acteur" class="form-control"></input>
                            </div>
                        </div><br>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-12" for="author">Prénom</label>
                            <div class="col-md-35">
                                <input type="text" id="prenomAct" name="prenomAct" placeholder="saisir le prenom de l'Acteur" class="form-control input-md">
                            </div>
                        </div><br>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-12" for="author">Film joué</label>
                            <div class="col-md-35">
                                <input type="text" id="filmJoue" name="filmJoue" placeholder="saisir un film" class="form-control input-md">
                            </div>
                        </div><br>

                        <!-- File input-->
                        <div class="form-group" id="fileInput">
                            <label class="col-md-12" for="file">Selectionnez une photo de profil</label><br><br>
                            <div class="col-md-50">
                                <input id="file" name="file" type="file" placeholder="Choisir un fichier" class="form-control input-md">
                            </div>
                        </div><br>

                        <button id="create" name="create" class="btn btn-primary">Ajouter l'acteur</button>
                        <a href="acteur.php" class="btn btn-primary">Afficher les acteurs</a>
                        <a href="ajout.php" class="btn btn-primary">Retour</a>

                    </fieldset>
                </form>
            </div><br>

</html>