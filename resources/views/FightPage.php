<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>DungeonXplorer</title>
        <link href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:wght@400;700&display=swap');
        </style>
        <script src="../resources/js/FightSystem.js" defer></script>
    </head>

    <body class="font-['Roboto'] text-[#E5E5E5] bg-[#1A1A1A] min-h-screen flex flex-col">
        <header class="bg-[#2E2E2E] p-4">
            <?php include_once ("Navbar/Navbar.php"); ?>
        </header>

        <main class="flex flex-col md:flex-row justify-center items-center gap-8 p-8">
           
            <div class="bg-[#2E2E2E] p-6 rounded-lg w-full max-w-xs text-center shadow-lg">
                <h2 class="text-xl font-semibold mb-4 text-[#C4975E]">Héros</h2>
                <div class="flex justify-center text-center">
                    <p>Pv : </p>
                    <p id="pv_heros" class="text-lg mb-2">000</p>
                </div>
                <div class="flex justify-center text-center">
                <p>Mana : </p>
                    <p id="mana_heros" class="text-lg mb-4">000</p>
                

                <h3 class="font-medium text-lg text-[#C4975E] mb-2">Choix de l'attaque</h3>
                <button id="attaque" class="bg-[#C4975E] hover:bg-[#8B1E1E] rounded-md py-2 px-4 mb-2">Lancer une attaque</button>

                <h3 class="font-medium text-lg text-[#C4975E] mb-2">Choix du sort</h3>
                <div class="flex flex-col gap-2">
                    <button id="sort_empoisonnement" class="bg-[#C4975E] hover:bg-[#8B1E1E] rounded-md py-2 px-4">Sort d'empoisonnement : -30 pv pour l'ennemi</button>
                    <button id="sort_soin" class="bg-[#C4975E] hover:bg-[#8B1E1E] rounded-md py-2 px-4">Sort de soin : 20 pv</button>
                    <button id="sort_attaque" class="bg-[#C4975E] hover:bg-[#8B1E1E] rounded-md py-2 px-4">Sort d'attaque : 20</button>
                    <button id="sort_mana" class="bg-[#C4975E] hover:bg-[#8B1E1E] rounded-md py-2 px-4">Sort de mana : 20</button>
                </div>

                <h3 class="font-medium text-lg text-[#C4975E] mb-2">Choix de la potion</h3>
                <div class="flex flex-col gap-2">
                    <button id="potion_soin" class="bg-[#C4975E] hover:bg-[#8B1E1E] rounded-md py-2 px-4">Potion de soin : 50 pv</button>
                    <button id="potion_attaque" class="bg-[#C4975E] hover:bg-[#8B1E1E] rounded-md py-2 px-4">Potion de force : 40</button>
                    <button id="potion_mana" class="bg-[#C4975E] hover:bg-[#8B1E1E] rounded-md py-2 px-4">Potion de mana : 30</button>
                </div>
            </div>

           
            <div class="bg-[#2E2E2E] p-6 rounded-lg w-full max-w-xs text-center shadow-lg">
                <h2 class="text-xl font-semibold mb-4 text-[#C4975E]">Monstre</h2>
                <p id="nom_monstre" class="text-lg mb-2">Monstre</p>
                <div class="flex justify-center text-center">
                    <p>Pv : </p>
                    <p id="pv_monstre" class="text-lg mb-2">000</p>
                </div>
            </div>
        </main>

        <footer class="bg-[#2E2E2E] text-center p-4 mt-auto">
            <p class="mb-2">&copy; 2025 DungeonXplorer. Tous droits réservés.</p>
            <a href="https://github.com/Briiice3R/DungeonXplorer" class="text-[#C4975E] mx-2 text-2xl">
                <i class="fa-brands fa-github"></i>
            </a>
        </footer>
    </body>
</html>
<script>
     const heroData = <?= json_encode($heroData) ?>;
     const monsterData = <?= json_encode($monsterData) ?>;
 </script>