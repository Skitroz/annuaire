<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Connexion - AnnuNWS</title>
</head>

<body>
    <?php require_once('dbConnect.php'); ?>
    <?php require_once('../layouts/header.layout.php'); ?>

    <div class="mt-36 flex justify-center items-center">
        <div class="bg-white shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] w-[800px] p-10 rounded-lg">
            <h2 class="text-center font-bold text-[#00a5a5] text-[18px]">Connectez-vous pour pouvoir ajouter ou modifier un étudiant dans l'annuaire !</h2>
            <p class="text-center font-semibold text-[14px] text-[#746d6d]">Si vous souhaitez créer un compte, contactez l'administrateur du site.</p>
        </div>
    </div>

    <div class="flex justify-center items-center mt-24">
        <form action="#" method="post"
            class="bg-white shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] w-[800px] p-10 rounded-lg">
            <div class="flex flex-col gap-4">
                <h1 class="text-[#00a5a5] font-bold text-3xl">Connexion</h1>
                <div class="h-1 bg-[#00a5a5] w-10"></div>
            </div>
            <div class="flex flex-col mt-10 gap-6 justify-center items-center">
                <input type="text" name="username" placeholder="Nom d'utilisateur"
                    class="w-60 p-4 border-[#d1d1d1] border-2 rounded bg-[#f3f3f3]" required>
                <input type="password" name="password" placeholder="Mot de passe"
                    class="w-60 p-4 border-[#d1d1d1] border-2 rounded bg-[#f3f3f3]" required>
            </div>
            <div class="flex justify-center items-center">
                <input type="submit" name="connexion" placeholder="Se connecter"
                    class="mt-16 py-4 px-10 rounded-lg bg-[#00a5a5] text-white font-semibold cursor-pointer">
            </div>
        </form>
    </div>
</body>

</html>

<?php

if (isset($_POST["connexion"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM login WHERE username = ? AND password = ?");
    $stmt->execute([$username, $password]);

    if ($stmt->rowCount() > 0) {
        header("Location: accueil");
        exit();
    } else {
        echo "<p class='text-red-500 font-bold text-lg mt-8 text-center'>Le nom d'utilisateur ou le mot de passe est incorrect.</p>";
    }
}