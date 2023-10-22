<?php
require_once(__DIR__ . '/../configs/bootstrap.php');
require_once(__DIR__ . '/../vendor/autoload.php'); // Charge l'autoload de Composer

use Dompdf\Dompdf;
use Dompdf\Options;

// Récupérez les paramètres de filtre depuis l'URL
$specialiteFiltre = isset($_GET['specialite']) ? $_GET['specialite'] : 'Tous';
$anneeFiltre = isset($_GET['annee']) ? $_GET['annee'] : 'Tous';
// Créez une instance Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);

$dompdf = new Dompdf($options);

// Créez une chaîne HTML pour le tableau
$htmlTable = '<table border="1" cellspacing="0" cellpadding="5">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>E-mail</th>
                    <th>Année</th>
                    <th>Spécialité</th>
                </tr>';

// Préparez la requête SQL pour récupérer les données des étudiants en fonction des filtres
$requete = "SELECT nom, prenom, mail, annee, spe FROM etudiants WHERE spe = :specialite AND annee = :annee";

// Exécutez la requête SQL en liant les valeurs des filtres
$stmt = $pdo->prepare($requete);
$stmt->bindParam(':specialite', $specialiteFiltre);
$stmt->bindParam(':annee', $anneeFiltre);
$stmt->execute();

// Récupérez toutes les lignes de résultats sous forme de tableau associatif
$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultats as $row) {
    $htmlTable .= '<tr>';
    $htmlTable .= '<td>' . $row['nom'] . '</td>';
    $htmlTable .= '<td>' . $row['prenom'] . '</td>';
    $htmlTable .= '<td>' . $row['mail'] . '</td>';
    $htmlTable .= '<td>' . $row['annee'] . '</td>';
    $htmlTable .= '<td>' . $row['spe'] . '</td>';
    $htmlTable .= '</tr>';
}

$htmlTable .= '</table>';

// Ajoutez le tableau au contenu HTML
$html = '<html><body><h1>Annuaire</h1>' . $htmlTable . '</body></html>';

$dompdf->loadHtml($html);

// Générez le PDF
$dompdf->render();

// Générez le PDF et proposez le téléchargement
$dompdf->stream('annuaire.pdf', array('Attachment' => 0));
