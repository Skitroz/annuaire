<?php

$dbConfig = file_get_contents("dbConnect.json");
$db = json_decode($dbConfig, true);

$db_host = $db['db_host'];
$db_user = $db['db_user'];
$db_password = $db['db_password'];
$db_name = $db['db_name'];

$connexion = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
} else {
    echo "Connexion réussie";
}
