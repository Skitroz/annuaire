<?php
require_once(__DIR__ . '/../configs/bootstrap.php');
require_once(__DIR__ . '/../vendor/autoload.php');

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);

$dompdf = new Dompdf($options);

$htmlTable = '<table border="1" cellspacing="0" cellpadding="5">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>E-mail</th>
                    <th>Année</th>
                    <th>Spécialité</th>
                </tr>';

$requete = "SELECT nom, prenom, mail, annee, spe FROM etudiants";

$stmt = $pdo->prepare($requete);
$stmt->execute();

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

$html = '<html><body><h1>Liste des étudiants enregistrés</h1>' . $htmlTable . '</body></html>';

$dompdf->loadHtml($html);

$dompdf->render();

$dompdf->stream('annuaire.pdf', array('Attachment' => 0));
