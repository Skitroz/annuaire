<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/84f029610c.js" crossorigin="anonymous"></script>
    <title>Annuaire - Annu-NWS</title>
</head>

<body>
    <?php require_once('../layouts/header.layout.php'); ?>

    <div class="mb-10 mt-36 flex flex-col">
        <div class="mb-4">
            <div id="specialite-bouton" class="text-center sm:flex sm:justify-center sm:items-center sm:gap-8">
                <button
                    class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-2 sm:p-4 rounded text-[#00a5a5] font-semibold transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bouton-specialite"
                    onclick="filtrerParSpecialite('Tous')">Tous</button>
                <button
                    class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-2 sm:p-4 rounded text-[#00a5a5] font-semibold transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bouton-specialite"
                    onclick="filtrerParSpecialite('Développement Web')">Développement Web</button>
                <button
                    class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-2 sm:p-4 rounded text-[#00a5a5] font-semibold transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bouton-specialite"
                    onclick="filtrerParSpecialite('Web Marketing')">Web Marketing</button>
                <button
                    class="my-2 shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-2 sm:p-4 rounded text-[#00a5a5] font-semibold transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bouton-specialite"
                    onclick="filtrerParSpecialite('Communication Graphique')">Communication Graphique</button>
                <button
                    class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-2 sm:p-4 rounded text-[#00a5a5] font-semibold transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bouton-specialite"
                    onclick="filtrerParSpecialite('Community Management')">Community Management</button>
            </div>
        </div>

        <div class="flex justify-center items-center gap-16 mt-4">
            <div id="annee-bouton" class="sm:flex sm:justify-center sm:items-center sm:gap-8">
                <button
                    class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-2 sm:p-4 rounded text-[#00a5a5] font-semibold transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bouton-annee"
                    onclick="filtrerParAnnee('Tous')">Tous</button>
                <button
                    class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-2 sm:p-4 rounded text-[#00a5a5] font-semibold transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bouton-annee"
                    onclick="filtrerParAnnee('A1')">A1</button>
                <button
                    class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-2 sm:p-4 rounded text-[#00a5a5] font-semibold transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bouton-annee"
                    onclick="filtrerParAnnee('A2')">A2</button>
                <button
                    class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-2 sm:p-4 rounded text-[#00a5a5] font-semibold transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bouton-annee"
                    onclick="filtrerParAnnee('A3')">A3</button>
            </div>
        </div>
        <div class="mx-auto mt-[86px]">
            <button
                class="w-[200px] transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300"><a
                    class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-4 rounded text-white bg-[#00a5a5] font-semibold"
                    href="./ajoutEtudiant.inc.php">Ajouter
                    un
                    étudiant</a></button>
        </div>
    </div>
    </div>
    <div class="flex justify-center items-center gap-4">
        <div class="text-center overflow-x-auto">
            <table id="tableau" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-[#00a5a5]">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                            Nom</th>
                        <th scope="col"
                            class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                            Prénom</th>
                        <th scope="col"
                            class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                            E-mail
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Année
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                            Spécialité</th>
                        <th scope="col"
                            class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                            Modifier</th>
                        <th scope="col"
                            class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                            Supprimer</th>
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
                            echo '<td class="px-6 py-4 whitespace-nowrap transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300"><a href="./modifierEtudiant.inc.php?id=' . $resultats["id"] . '"><i class="fas fa-edit"></i></a></td>';
                            echo '<td class="px-6 py-4 whitespace-nowrap transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300"><a href="./supprimerEtudiant.inc.php?id=' . $resultats["id"] . '"><i class="fas fa-trash"></i></a></td>';
                            echo '</tr>';
                        }
                    }
                    annuaire();
                    ?>
                </tbody>
            </table>
        </div>

        <script>
            let specialiteFiltre = 'Tous';
            let anneeFiltre = 'Tous';

            function filtrerParSpecialite(specialite) {
                specialiteFiltre = specialite;
                const tableau = document.querySelectorAll('#tableau tbody tr');
                const boutonSpecialite = document.querySelectorAll('#specialite-bouton .bouton-specialite');

                boutonSpecialite.forEach(b => {
                    b.classList.remove('bg-[#00a5a5]', 'text-white');
                });

                boutonSpecialite.forEach(bouton => {
                    if (bouton.textContent === specialite) {
                        bouton.classList.add('bg-[#00a5a5]', 'text-white');
                    }
                });

                tableau.forEach(function (tableau) {
                    const colonneSpecialite = tableau.querySelector('td:nth-child(5)').textContent;
                    const colonneAnnee = tableau.querySelector('td:nth-child(4)').textContent;

                    if ((specialiteFiltre === 'Tous' || colonneSpecialite === specialiteFiltre) &&
                        (anneeFiltre === 'Tous' || colonneAnnee === anneeFiltre)) {
                        tableau.style.display = 'table-row';
                    } else {
                        tableau.style.display = 'none';
                    }
                });
            }

            filtrerParSpecialite('Tous');

            function filtrerParAnnee(annee) {
                anneeFiltre = annee;
                const tableau = document.querySelectorAll('#tableau tbody tr');
                const boutonAnnee = document.querySelectorAll('#annee-bouton .bouton-annee');

                boutonAnnee.forEach(b => {
                    b.classList.remove('bg-[#00a5a5]', 'text-white');
                });

                boutonAnnee.forEach(bouton => {
                    if (bouton.textContent === annee) {
                        bouton.classList.add('bg-[#00a5a5]', 'text-white');
                    }
                });

                tableau.forEach(function (tableau) {
                    const colonneSpecialite = tableau.querySelector('td:nth-child(5)').textContent;
                    const colonneAnnee = tableau.querySelector('td:nth-child(4)').textContent;

                    if ((specialiteFiltre === 'Tous' || colonneSpecialite === specialiteFiltre) &&
                        (anneeFiltre === 'Tous' || colonneAnnee === anneeFiltre)) {
                        tableau.style.display = 'table-row';
                    } else {
                        tableau.style.display = 'none';
                    }
                });
            }
        </script>
</body>

</html>