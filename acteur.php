<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <title>Acteurs</title>
</head>

<header class="header">
    <img src="images/mongodb.png" class="logoMongo" weight="80" height="80" alt="Mongodb">
    <img src="images/cine.png" class="logoCine" weight="80" height="80" alt="Mongodb">
    <h1 align=" center">Les Acteurs</h1><br>
    <ul align=" center" id="nav">
        <li id="nav-home"><a href="index.php">Accueil</a></li>
        <li id="nav-about"><a href="ajout.php">Ajout</a></li>
        <li id=" nav-archive"><a href="modification.php">Modification</a></li>
    </ul>
</header>
<br>

<body class=body>
    <br>
    <div>
        <!-- Show acteurs -->
        <?php
        // This path should point to Composer's autoloader
        require 'vendor/autoload.php'; // include Composer's autoloader

        $client = new MongoDB\Client("mongodb://localhost:27017");
        $collection = $client->Cinema->acteur;
        $acteurs = $collection->find();
        foreach ($acteurs as $key => $acteur) {

            $data = json_encode([
                '_id'             => (string) $acteur['_id'],
                'idAct'             => (string) $acteur['idAct'],
                'nomAct'         => $acteur['nomAct'],
                'prenomAct'     => $acteur['prenomAct'],
                'filmJoue'     => $acteur['filmJoue'],
            ], true);

            echo '<div>
								<div>
                                    <div align="center" class="col-md-20">
                                    <img src="images/' . $acteur['fileName'] . '"width="300" height="300"></div>
									<div align="center" class="col-md-20"><br>
                                        <strong>Object Id: ' . $acteur['_id'] . '</strong>
                                        <p>Id:  ' . $acteur['idAct'] . '</p>
                                        <p >Prénom:  ' . $acteur['prenomAct'] . '</p>
										<p>Nom:  ' . $acteur['nomAct'] . '</p>
                                        <p >Film joué:  ' . $acteur['filmJoue'] . '</p>
                                        <br><br>                                        
                                    </div>';
        }
        ?>
        <div align="center">
            <a class="btn btn-primary" href="index.php" align="center">Retour</a>
            <br><br>
        </div>
    </div>
</body>

</html>