<?php
require_once ('./src/toolkit.php');
recherche();

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
            alt="Bannière des étudiants de la Normandie Web School" class="mt-[110px] sm:-mt-0 sm:h-auto sm:w-screen">
        <div class="absolute inset-0 bg-black opacity-40"></div>
    </section>

    <form action="index.php" method="get" class="relative top-[-25px] flex justify-center items-center">
        <div class="w-[300px] sm:w-[400px] p-2 rounded-lg bg-[#f3f3f3] flex justify-evenly">
            <input type="text" name="etudiant" placeholder="Rechercher un étudiant"
                class="bg-[#f3f3f3] focus:outline-none sm:text-xl" required>
            <button type="submit"
                class="transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300"><i
                    class="fas fa-search bg-[#00a5a5] text-white p-2 sm:p-4 rounded-full"></i></button>
        </div>
    </form>
    <?php
    if (isset($_GET["etudiant"])) {
        if (count($resultatDeLaRecherche) > 0) {
            echo '<div class="flex justify-center items-center gap-4">';
            echo '<div class="text-center overflow-x-auto">';
            echo '<table class="min-w-full divide-y divide-gray-200">';
            echo '<thead class="bg-[#00a5a5]">';
            echo '<tr>';
            echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nom</th>';
            echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Prénom</th>';
            echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">E-mail</th>';
            echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Année</th>';
            echo '<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Spécialité</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody class="bg-white divide-y divide-gray-200">';

            foreach ($resultatDeLaRecherche as $resultats) {
                echo '<tr>';
                echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($resultats["nom"]) . '</td>';
                echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($resultats["prenom"]) . '</td>';
                echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($resultats["mail"]) . '</td>';
                echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($resultats["annee"]) . '</td>';
                echo '<td class="px-6 py-4 whitespace-nowrap">' . htmlspecialchars($resultats["spe"]) . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            echo '</div>';
        } else {
            echo "<p class='mt-8 text-center'>Aucun étudiant trouvé.</p>";
        }
    }
    ?>
</body>

</html>