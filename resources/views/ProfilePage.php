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
        <!-- Header -->
        <?php include_once ("Navbar/Navbar.php"); ?>

        <main class="flex justify-center">
            <div class="font-['Roboto'] text-3xl text-[#E5E5E5] mt-8">
                <h2 class="font-['Pirata_one'] text-5xl text-center text-[#C4975E] mb-6">Votre profil </h2>
                <hr class="border-[#C4975E] mb-6">
                <p class="mb-3">Votre nom : <?php echo $profileController->get_Name() ?> </p>
                <p class="mb-3">Votre genre : <?php echo $profileController->traduit_genre()?> </p>
                <p class="mb-3">Votre adresse mail : <?php echo $profileController->get_Email()?> </p>
                 <p class="mb-8">Date de création du compte : <?php echo $profileController->get_Created_at()?></p>
                <div class="flex justify-center">
                        <a href='<?php echo "/updateprofile/".$profileController->get_Id()?>' class=" bg-[#C4975E] m-1 hover:bg-[#8B1E1E] rounded-md p-2">Modifier</a>
                        <a href='<?php echo "/delete/".$profileController->get_Id()?>' class=" bg-[#C4975E] m-1 hover:bg-[#8B1E1E] rounded-md p-2">Supprimer</a>
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