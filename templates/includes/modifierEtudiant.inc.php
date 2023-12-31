<?php
session_start();

require_once (__DIR__ . '/../../src/toolkit.php');
require_once(__DIR__ . '/../../configs/bootstrap.php');

verifConnexion();

$etudiant = null;

if (isset($_GET['id'])) {
    $etudiantId = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');

    $requete = "SELECT * FROM etudiants WHERE id = ?";
    $stmt = $pdo->prepare($requete);
    $stmt->execute([$etudiantId]);

    if ($stmt->rowCount() == 1) {
        $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Étudiant non trouvé.";
        exit;
    }
} else {
    echo "ID d'étudiant non spécifié.";
    exit;
}

if (isset($_POST['modifier'])) {
    $nouveauPrenom = htmlspecialchars($_POST['prenom'], ENT_QUOTES, 'UTF-8');
    $nouveauNom = htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8');
    $nouveauMail = htmlspecialchars($_POST['mail'], ENT_QUOTES, 'UTF-8');
    $nouvelleAnnee = htmlspecialchars($_POST['annee'], ENT_QUOTES, 'UTF-8');
    $nouvelleSpecialite = htmlspecialchars($_POST['specialite'], ENT_QUOTES, 'UTF-8');

    if ($etudiant !== null) {
        $etudiantId = $etudiant['id'];
        $requete = "UPDATE etudiants SET prenom = ?, nom = ?, mail = ?, annee = ?, spe = ? WHERE id = ?";
        $stmt = $pdo->prepare($requete);
        $stmt->execute([$nouveauPrenom, $nouveauNom, $nouveauMail, $nouvelleAnnee, $nouvelleSpecialite, $etudiantId]);
    }

    header('Location: ./annuaire.inc.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Modifier un étudiant - AnnuNWS</title>
</head>

<body>
    <?php require_once('../layouts/header.layout.php'); ?>

    <div class="mt-36 flex justify-center items-center">
        <form action="#" method="post"
            class="bg-white shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] w-screen sm:w-[800px] p-10 rounded-lg">
            <div class="flex flex-col gap-4">
                <h1 class="text-[#00a5a5] font-bold text-3xl">Modifier un étudiant</h1>
                <div class="h-1 bg-[#00a5a5] w-10"></div>
            </div>
            <div class="flex mt-10 gap-6 justify-center items-center">
                <div class="flex mt-10 gap-6 justify-center items-center">
                    <input type="text" name="prenom" placeholder="Prénom"
                        class="w-[180px] sm:w-60 p-4 border-[#d1d1d1] border-2 rounded bg-[#f3f3f3]"
                        value="<?php echo $etudiant['prenom']; ?>" required>
                    <input type="text" name="nom" placeholder="Nom"
                        class="w-[180px] sm:w-60 p-4 border-[#d1d1d1] border-2 rounded bg-[#f3f3f3]"
                        value="<?php echo $etudiant['nom']; ?>" required>
                </div>
            </div>
            <div class="mt-10 flex justify-center items-center">
                <input type="email" name="mail" placeholder="E-mail"
                    class="w-[460px] sm:w-[505px] p-4 border-[#d1d1d1] border-2 rounded bg-[#f3f3f3]"
                    value="<?php echo $etudiant['mail']; ?>" required>
            </div>
            <div class="flex mt-10 gap-6 justify-center items-center">
                <select name="annee" class="w-[100px] sm:w-60 p-4 border-[#d1d1d1] border-2 rounded bg-[#f3f3f3]">
                    <option value="A1" <?php if ($etudiant['annee'] == 'A1') echo 'selected'; ?>>A1</option>
                    <option value="A2" <?php if ($etudiant['annee'] == 'A2') echo 'selected'; ?>>A2</option>
                    <option value="A3" <?php if ($etudiant['annee'] == 'A3') echo 'selected'; ?>>A3</option>
                </select>
                <select name="specialite" class="w-[240px] sm:w-60 p-4 border-[#d1d1d1] border-2 rounded bg-[#f3f3f3]">
                    <option value="Développement Web" <?php if ($etudiant['spe'] == 'Développement Web') echo 'selected'; ?>>
                        Développement Web
                    </option>
                    <option value="Web Marketing" <?php if ($etudiant['spe'] == 'Web Marketing') echo 'selected'; ?>>Web Marketing</option>
                    <option value="Communication Graphique" <?php if ($etudiant['spe'] == 'Communication Graphique') echo 'selected'; ?>>
                        Communication Graphique
                    </option>
                    <option value="Community Management" <?php if ($etudiant['spe'] == 'Community Management') echo 'selected'; ?>>
                        Community Management
                    </option>
                </select>
            </div>
            <div class="flex justify-center items-center">
                <input type="submit" name="modifier" value="Enregistrer"
                    class="mt-16 py-4 px-10 rounded-lg bg-[#00a5a5] text-white font-semibold cursor-pointer">
            </div>
        </form>
    </div>
</body>
</html>
