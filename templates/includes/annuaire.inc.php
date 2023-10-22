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
                <!-- Boutons de spécialité -->
                <button class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-2 sm:p-4 rounded text-[#00a5a5] font-semibold transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bouton-specialite" onclick="filtrerParSpecialite('Tous')">Tous</button>
                <button class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-2 sm:p-4 rounded text-[#00a5a5] font-semibold transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bouton-specialite" onclick="filtrerParSpecialite('Développement Web')">Développement Web</button>
                <button class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-2 sm:p-4 rounded text-[#00a5a5] font-semibold transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bouton-specialite" onclick="filtrerParSpecialite('Web Marketing')">Web Marketing</button>
                <button class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-2 sm:p-4 rounded text-[#00a5a5] font-semibold transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bouton-specialite" onclick="filtrerParSpecialite('Communication Graphique')">Communication Graphique</button>
                <button class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-2 sm:p-4 rounded text-[#00a5a5] font-semibold transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bouton-specialite" onclick="filtrerParSpecialite('Community Management')">Community Management</button>
            </div>
        </div>

        <div class="flex justify-center items-center gap-16 mt-4">
            <div id="annee-bouton" class="sm:flex sm:justify-center sm:items-center sm:gap-8">
                <!-- Boutons d'année -->
                <button class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-2 sm:p-4 rounded text-[#00a5a5] font-semibold transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bouton-annee" onclick="filtrerParAnnee('Tous')">Tous</button>
                <button class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-2 sm:p-4 rounded text-[#00a5a5] font-semibold transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bouton-annee" onclick="filtrerParAnnee('A1')">A1</button>
                <button class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-2 sm:p-4 rounded text-[#00a5a5] font-semibold transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bouton-annee" onclick="filtrerParAnnee('A2')">A2</button>
                <button class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-2 sm:p-4 rounded text-[#00a5a5] font-semibold transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300 bouton-annee" onclick="filtrerParAnnee('A3')">A3</button>
            </div>
        </div>

        <?php
        $specialiteFiltre = ''; // Initialisez la variable
        $anneeFiltre = ''; // Initialisez la variable
        
        if (isset($_GET['specialite'])) {
            $specialiteFiltre = $_GET['specialite'];
        }
        
        if (isset($_GET['annee'])) {
            $anneeFiltre = $_GET['annee'];
        }
        ?>

        <div class="mx-auto mt-[86px]">
            <button class="w-[200px] transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">
                <a class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-4 rounded text-white bg-[#ca4b38] font-semibold" href="./ajoutEtudiant.inc.php">Ajouter un étudiant</a>
            </button>
        </div>
    </div>
    </div>
    <div class="flex justify-center items-center gap-4">
        <div class="text-center overflow-x-auto sm:overflow-x-hidden">
            <table id="tableau" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-[#00a5a5]">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                            Nom
                        </th>
                        <th scope="col" class "px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                            Prénom
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                            E-mail
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                            Année
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                            Spécialité
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                            Modifier
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                            Supprimer
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    require_once("../../src/toolkit.php");
                    $totalPages = nombrePage();
                    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                    annuaire($page);
                    ?>
                </tbody>
            </table>
            <?php
            echo "<div class='flex gap-16 justify-center my-4'>";
            if ($page > 1) {
                echo '<a href="annuaire.inc.php?page=' . ($page - 1) . '"><i class="fa-solid fa-chevron-left"></i></a>';
            }
            echo '<p class="border-b-[3px] border-[#ca4b38]">' . $page . '</p>';
            if ($page < $totalPages) {
                echo '<a href="annuaire.inc.php?page=' . ($page + 1) . '" class="underline"><i class="fa-solid fa-chevron-right"></i></a>';
            }
            echo "</div>";
            ?>
        </div>
    </div>
    
    <?php
    $exportUrl = '/annuaire/src/exportPdf.php?';
    if (!empty($specialiteFiltre)) {
        $exportUrl .= 'specialite=' . urlencode($specialiteFiltre) . '&';
    }
    if (!empty($anneeFiltre)) {
        $exportUrl .= 'annee=' . urlencode($anneeFiltre) . '&';
    }
    $exportUrl = rtrim($exportUrl, '&'); // Supprime le dernier '&' s'il existe
    ?>
    
    <a href="<?php echo $exportUrl; ?>" class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-4 rounded text-white bg-[#00a5a5] font-semibold">Exporter en PDF</a>
    <script type="text/javascript" src="../../scripts/annuaire.js"></script>
</body>

</html>
