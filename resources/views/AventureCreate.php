<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DungeonXplorer - Aventure</title>
    <!-- Polices Google -->
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:wght@400;700&display=swap');
    </style>
</head>
<body class="font-['Roboto'] text-[#E5E5E5] bg-[#1A1A1A] min-h-screen flex flex-col">

    <!-- Header -->
    <header class="flex justify-between items-center bg-[#2E2E2E] p-2 w-full">
        <img src="resources/images/logoDungeon.png" class="w-20">
        <h1 class="font-['Pirata_One'] text-4xl text-[#C4975E] m-0 pl-4">DUNGEONXPLORER</h1>
        <div class="flex items-center flex-1 relative pr-4">
            <nav class="flex absolute left-1/2 transform -translate-x-1/2">
                <a href="/" class="text-[#C4975E] mx-4 font-['Pirata_One'] text-3xl no-underline hover:text-[#8B1E1E]">Accueil</a>
                <a href="/aventure" class="text-[#C4975E] mx-4 font-['Pirata_One'] text-3xl no-underline hover:text-[#8B1E1E]">Aventure</a>
            </nav>
            <nav class="flex ml-auto">
                <a href="/profile" class="text-[#C4975E] mx-4 font-['Pirata_One'] text-3xl no-underline hover:text-[#8B1E1E]"><i class="fa-solid fa-user mx-4"></i>Profil</a>
            </nav>
        </div>
    </header>

    <!-- Conteneur principal -->
    <div class="flex flex-1 p-8 gap-8">

        <!-- Boutons de navigation -->
        <div class="flex flex-col gap-4 w-fit p-4 bg-[#2E2E2E] rounded-lg shadow-lg">
            <a href="/" class="flex items-center gap-2 bg-[#C4975E] text-[#1A1A1A] px-4 py-2 rounded-md font-['Roboto'] text-base hover:bg-[#8B1E1E] transition-colors">
                <i class="fas fa-book"></i> Nouvelle Aventure
            </a>
            <a href="/" class="flex items-center gap-2 bg-[#C4975E] text-[#1A1A1A] px-4 py-2 rounded-md font-['Roboto'] text-base hover:bg-[#8B1E1E] transition-colors">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a>
        </div>
    </div>

    <!-- Contenu Principale droite -->
    <section>
        <?php
        /** @var HeroType $herotype */
            foreach($heroTypeArr as $herotype){
                
            }
        ?>
        <h1><?php echo $herotype->getName(); ?></h1>
        <img src="<?php echo $herotype->getImage(); ?>" alt="Image du hero" style="max-width: 100%; height: auto;">
        <p>Description: <?php echo $herotype->getDescription(); ?></p>
        <p>Points de Vie Max: <?php echo $herotype->getMaxPv(); ?></p>
        <p>Mana Max: <?php echo $herotype->getMaxMana(); ?></p>
        <p>Force Max: <?php echo $herotype->getMaxStrength(); ?></p>
        <p>Initiative Max: <?php echo $herotype->getMaxInitiative(); ?></p>
        <p>Objets Max: <?php echo $herotype->getMaxItems(); ?></p>
    </section>

    <!-- Footer -->
    <footer class="bg-[#2E2E2E] text-center p-4 mt-auto">
        <p class="mb-2">&copy; 2025 DungeonXplorer. Tous droits réservés.</p>
        <a href="https://github.com/Briiice3R/DungeonXplorer" class="text-[#C4975E] mx-2 text-2xl">
            <i class="fa-brands fa-github"></i>
        </a>
    </footer>

    <!-- Script Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
