<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ./connexion.inc.php');
    exit();
}

if (isset($_GET['id'])) {
    $etudiantId = $_GET['id'];
    require_once(__DIR__ . '/../../configs/bootstrap.php');

    $requete = "DELETE FROM etudiants WHERE id = ?";
    $stmt = $pdo->prepare($requete);

    if ($stmt->execute([$etudiantId])) {
        header("Location: ./annuaire.inc.php");
        exit();
    } else {
        echo "Une erreur s'est produite lors de la suppression de l'étudiant.";
    }
} else {
    header("Location: ./annuaire.inc.php");
    exit();
}
?>