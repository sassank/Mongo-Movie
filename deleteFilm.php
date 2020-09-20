<?php

require 'vendor/autoload.php';

use MongoDB\BSON\ObjectId;

$id = $_GET['id'];
$connection = new MongoDB\Client("mongodb://localhost:27017");
$db = $connection->Cinema->film;
$id = new ObjectId($id);
$db->deleteMany(array('_id' => $id));
header('location:modification.php');
