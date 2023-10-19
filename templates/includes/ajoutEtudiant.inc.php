<?php

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ./connexion.inc.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Ajouter un étudiant - AnnuNWS</title>
</head>

<body>
    <?php require_once('../layouts/header.layout.php'); ?>
    <div class="mt-36">
        <div class="flex justify-center items-center mt-24">
            <form action="#" method="post"
                class="bg-white shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] w-screen sm:w-[800px] p-10 rounded-lg">
                <div class="flex flex-col gap-4">
                    <h1 class="text-[#00a5a5] font-bold text-3xl">Ajouter un étudiant</h1>
                    <div class="h-1 bg-[#00a5a5] w-10"></div>
                </div>
                <div class="flex mt-10 gap-6 justify-center items-center">
                    <input type="text" name="prenom" placeholder="Prénom"
                        class="w-[180px] sm:w-60 p-4 border-[#d1d1d1] border-2 rounded bg-[#f3f3f3]" required>
                    <input type="text" name="nom" placeholder="Nom"
                        class="w-[180px] sm:w-60 p-4 border-[#d1d1d1] border-2 rounded bg-[#f3f3f3]" required>
                </div>
                <div class="mt-10 flex justify-center items-center">
                    <input type="mail" name="mail" placeholder="E-mail"
                        class="w-[460px] sm:w-[505px] p-4 border-[#d1d1d1] border-2 rounded bg-[#f3f3f3]" required>
                </div>
                <div class="flex mt-10 gap-6 justify-center items-center">
                    <select name="annee" class="w-[100px] sm:w-60 p-4 border-[#d1d1d1] border-2 rounded bg-[#f3f3f3]">
                        <option value="A1">A1</option>
                        <option value="A2">A2</option>
                        <option value="A3">A3</option>
                    </select>
                    <select name="specialite" class="w-[240px] sm:w-60 p-4 border-[#d1d1d1] border-2 rounded bg-[#f3f3f3]">
                        <option value="Développement Web">Développement Web</option>
                        <option value="Web Marketing">Web Marketing</option>
                        <option value="Communication Graphique">Communication Graphique</option>
                        <option value="Community Management">Community Management</option>
                    </select>
                </div>
                <div class="flex justify-center items-center">
                    <input type="submit" name="enregistrer" value="Enregistrer"
                        class="mt-16 py-4 px-10 rounded-lg bg-[#00a5a5] text-white font-semibold cursor-pointer">
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['enregistrer'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $mail = $_POST['mail'];
    $annee = $_POST['annee'];
    $specialite = $_POST['specialite'];

    require_once(__DIR__ . '/../../configs/bootstrap.php');

    $requete = "INSERT INTO etudiants (prenom, nom, mail, annee, spe) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($requete);
    $stmt->execute([$prenom, $nom, $mail, $annee, $specialite]);

    echo "<p class='text-[#00a5a5] font-bold text-lg mt-8 text-center'>L'étudiant a bien été ajouté.</p>";
    exit;
}