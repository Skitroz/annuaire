<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Connexion - AnnuNWS</title>
</head>

<body>
    <?php require_once('../layouts/header.layout.php'); ?>
    <img src="https://normandiewebschool.fr/uploads/banner_contact.jpg" alt="Bannière Normandie Web School"
        class="h-[500px] w-screen">
    <div class="absolute top-[200px] bg-white p-8 rounded-lg left-[400px] gap-6 flex flex-col">
        <h2 class="text-[#ca4b38] font-bold text-3xl">Connexion</h2>
        <div class="h-1 bg-[#ca4b38] w-10"></div>
        <p class="text-[#746d6d] font-semibold text-2xl">Connectez-vous pour pouvoir ajouter<br>de nouveau élève dans
            l'annuaire<br>ou même les modifier.</p>
    </div>

    <div class="flex justify-center items-center mt-10">
        <form action="" method="post" class="bg-white shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] w-[800px] p-10 rounded-lg">
            <div class="flex flex-col gap-4">
                <h1 class="text-[#00a5a5] font-bold text-3xl">Connexion</h1>
                <div class="h-1 bg-[#00a5a5] w-10"></div>
            </div>
            <div class="flex flex-col mt-10 gap-6 justify-center items-center">
                <input type="text" name="username" placeholder="Nom d'utilisateur" class="w-60 p-4 border-[#d1d1d1] border-2 rounded bg-[#f3f3f3]">
                <input type="password" name="password" placeholder="Mot de passe" class="w-60 p-4 border-[#d1d1d1] border-2 rounded bg-[#f3f3f3]">
            </div>
            <div class="flex justify-center items-center">
            <input type="submit" placeholder="Se connecter" class="mt-24 py-4 px-10 rounded-lg bg-[#00a5a5] text-white font-semibold">
            </div>
        </form>
    </div>
</body>

</html>