<?php

$configPath = __DIR__ . '/../configs/dbConnect.json';
$dbConfig = file_get_contents($configPath);
$db = json_decode($dbConfig, true);

$db_host = $db['db_host'];
$db_user = $db['db_user'];
$db_password = $db['db_password'];
$db_name = $db['db_name'];

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion réussie";
} catch (PDOException $e) {
    die("Échec de la connexion à la base de données : " . $e->getMessage());
}