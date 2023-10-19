<!-- <?php
session_start();
?> -->

<header class="absolute bg-white top-0 w-screen z-50">
    <div class="h-8 bg-[#ca4b38]">
        <p class="text-center my-auto text-white font-semibold pt-1">Nouvel annuaire de la Normandie Web School !</p>
    </div>
    <nav class="shadow-xl py-8 sm:py-5 sm:px-24 flex justify-evenly items-center">
        <a href="/annuaire"><img src="https://normandiewebschool.fr/uploads/logo_nws.svg"
                alt="L'école des métiers du numérique" class="sm:w-[150px] w-[75px]"></a>
        <ul class="flex gap-4 sm:gap-8">
            <li class="transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">
                <a href="/annuaire/templates/includes/annuaire.inc.php"
                    class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-3 sm:p-4 rounded text-[#00a5a5] font-semibold">Annuaire</a>
            </li>
            <li class="transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300">
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<a href="/annuaire/templates/includes/deconnexion.inc.php" class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-3 sm:p-4 rounded text-[#00a5a5] font-semibold">Déconnexion</a>';
                } else {
                    echo '<a href="/annuaire/templates/includes/connexion.inc.php" class="shadow-[0_1px_10px_1px_rgba(0,0,0,0.4)] p-3 sm:p-4 rounded text-[#00a5a5] font-semibold">Mon compte</a>';
                }
                ?>
            </li>
        </ul>


    </nav>
</header>