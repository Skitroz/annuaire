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
            alt="Bannière des étudiants de la Normandie Web School" class="h-[500px] w-screen">
            <div class="absolute inset-0 bg-black opacity-50"></div>
    </section>

    <form action="index.php" method="get" class="relative top-[-25px] flex justify-center items-center">
        <div class="w-[400px] p-2 rounded-lg bg-[#f3f3f3] flex justify-evenly">
            <input type="text" name="nom" placeholder="Rechercher un étudiant" class="bg-[#f3f3f3] focus:outline-none text-xl" required>
            <button type="submit" class="transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300"><i class="fas fa-search bg-[#00a5a5] text-white p-4 rounded-full"></i></button>
        </div>
    </form>
</body>

</html>