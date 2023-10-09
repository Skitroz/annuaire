<?php
function recherche()
{
    require('./configs/bootstrap.php');
    $resultat = [];

    if (isset($_GET["etudiant"])) {
        $etudiant = '%' . $_GET["etudiant"] . '%';

        $requete = "SELECT * FROM etudiants WHERE nom LIKE :etudiant OR prenom LIKE :etudiant";

        $stmt = $pdo->prepare($requete);
        $stmt->bindParam(':etudiant', $etudiant, PDO::PARAM_STR);
        $stmt->execute();

        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return $resultat;
}

$resultatDeLaRecherche = recherche();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/84f029610c.js" crossorigin="anonymous"></script>
    <title>Accueil - AnnuNWS</title>
</head>

<body>
    <?php require_once('templates/layouts/header.layout.php'); ?>
    <section class="relative">
        <img src="https://normandiewebschool.fr/uploads/banniere_etudiants_nws.jpg"
            alt="Bannière des étudiants de la Normandie Web School" class="h-auto w-screen">
        <div class="absolute inset-0 bg-black opacity-40"></div>
    </section>

    <form action="index.php" method="get" class="relative top-[-25px] flex justify-center items-center">
        <div class="w-[400px] p-2 rounded-lg bg-[#f3f3f3] flex justify-evenly">
            <input type="text" name="etudiant" placeholder="Rechercher un étudiant"
                class="bg-[#f3f3f3] focus:outline-none text-xl" required>
            <button type="submit"
                class="transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300"><i
                    class="fas fa-search bg-[#00a5a5] text-white p-4 rounded-full"></i></button>
        </div>
    </form>
    <?php
    if (isset($_GET["etudiant"])) {
        if (count($resultatDeLaRecherche) > 0) {
            echo '<div class="max-w-screen-md mx-auto mt-8">';
            echo '<table class="min-w-full divide-y divide-gray-200">';
            echo '<thead class="bg-gray-50">';
            echo '<tr>';
            echo '<th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    ';
            echo '<th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prénom
                    </th>';
            echo '<th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">E-mail
                    </th>';
            echo '<th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Année
                </th>';
            echo '<th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Spécialité
            </th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody class="bg-white divide-y divide-gray-200">';

            foreach ($resultatDeLaRecherche as $resultats) {
                echo '<tr>';
                echo '<td class="px-6 py-4 whitespace-nowrap">' . $resultats["nom"] . '</td>';
                echo '<td class="px-6 py-4 whitespace-nowrap">' . $resultats["prenom"] . '</td>';
                echo '<td class="px-6 py-4 whitespace-nowrap">' . $resultats["mail"] . '</td>';
                echo '<td class="px-6 py-4 whitespace-nowrap">' . $resultats["annee"] . '</td>';
                echo '<td class="px-6 py-4 whitespace-nowrap">' . $resultats["spe"] . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo "<p class='mt-8 text-center'>Aucun étudiant trouvé.</p>";
        }
    }
    ?>
</body>

</html>