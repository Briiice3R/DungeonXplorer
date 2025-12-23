<?php require("FightManagement.php")?>
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
    </head>

    <body class="font-['Roboto'] text-[#E5E5E5] bg-[#1A1A1A] min-h-screen flex flex-col">
        <header>
            <?php include_once ("Navbar/Navbar.php"); ?>
        </header>
        <main class="flex justify-center">
            <div class="flex justify-left">
                <p>Héros</p>
                <p id="name_heros"></p>
                <p id="pv_heros"></p>
                <p id="force_heros"></p>
                <p id="force_heros"></p>
                <button id="sort_soin">Potion de soin</button>
            </div>
            <div class= "flex justify-right">
                <p>Monstre</p>
                <p id="pv_monstre"></p>
                <p id="description_monstre"></p>
                <p id="force_monstre"></p>
                
            </div>
        </main>
        <footer>
            <p class="mb-2">&copy; 2025 DungeonXplorer. Tous droits réservés.</p>
                <a href="https://github.com/Briiice3R/DungeonXplorer" class="text-[#C4975E] mx-2 text-2xl">
                    <i class="fa-brands fa-github"></i>
                </a>
        </footer>
    </body>
</html>
