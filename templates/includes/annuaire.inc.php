<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/84f029610c.js" crossorigin="anonymous"></script>
    <title>Annuaire - Annu-NWS</title>
</head>

<body>
    <?php require_once('../layouts/header.layout.php'); ?>

    <div class="mb-10 mt-[200px] flex flex-col">
        <div class="flex justify-center items-center gap-16 mb-4">
            <button class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-4 rounded text-[#00a5a5] font-semibold"
                onclick="filtrerParSpecialite('Tous')">Tous</button>
            <button class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-4 rounded text-[#00a5a5] font-semibold"
                onclick="filtrerParSpecialite('Développement Web')">Développement Web</button>
            <button class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-4 rounded text-[#00a5a5] font-semibold"
                onclick="filtrerParSpecialite('Web Marketing')">Web Marketing</button>
            <button class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-4 rounded text-[#00a5a5] font-semibold"
                onclick="filtrerParSpecialite('Communication Graphique')">Communication Graphique</button>
            <button class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-4 rounded text-[#00a5a5] font-semibold"
                onclick="filtrerParSpecialite('Community Management')">Community Management</button>
        </div>
        <div class="flex justify-center items-center gap-16">
            <button class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-4 rounded text-[#00a5a5] font-semibold"
                onclick="filtrerParAnnee('A1')">A1</button>
            <button class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-4 rounded text-[#00a5a5] font-semibold"
                onclick="filtrerParAnnee('A2')">A2</button>
            <button class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-4 rounded text-[#00a5a5] font-semibold"
                onclick="filtrerParAnnee('A3')">A3</button>
        </div>
    </div>
    <div class="max-w-screen-md text-center mx-auto">
        <table id="tableau" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nom</th>
                    <th scope="col"
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Prénom</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">E-mail
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Année
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Spécialité</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php
                function annuaire()
                {
                    require(__DIR__ . '/../../configs/bootstrap.php');

                    $requete = "SELECT * FROM etudiants";

                    $stmt = $pdo->prepare($requete);
                    $stmt->execute();

                    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($resultat as $resultats) {
                        echo '<tr>';
                        echo '<td class="px-6 py-4 whitespace-nowrap">' . $resultats["nom"] . '</td>';
                        echo '<td class="px-6 py-4 whitespace-nowrap">' . $resultats["prenom"] . '</td>';
                        echo '<td class="px-6 py-4 whitespace-nowrap">' . $resultats["mail"] . '</td>';
                        echo '<td class="px-6 py-4 whitespace-nowrap">' . $resultats["annee"] . '</td>';
                        echo '<td class="px-6 py-4 whitespace-nowrap">' . $resultats["spe"] . '</td>';
                        echo '</tr>';
                    }
                }
                annuaire();
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function filtrerParSpecialite(specialite) {
            const tableau = document.querySelectorAll('#tableau tbody tr');
            tableau.forEach(function (tableau) {
                const colonneSpecialite = tableau.querySelector('td:nth-child(5)').textContent;
                if (specialite === 'Tous' || colonneSpecialite === specialite) {
                    tableau.style.display = 'table-row';
                } else {
                    tableau.style.display = 'none';
                }
            });
        }
        // Appelez cette fonction pour afficher tous les étudiants au chargement de la page.
        filtrerParSpecialite('Tous');

        function filtrerParAnnee(annee) {
            const tableau = document.querySelectorAll('#tableau tbody tr');
            tableau.forEach(function (tableau) {
                const colonneAnnee = tableau.querySelector('td:nth-child(4)').textContent;
                if (annee === 'Tous' || colonneAnnee === annee) {
                    tableau.style.display = 'table-row';
                } else {
                    tableau.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>