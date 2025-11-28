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
        <main class="flex justify-center">
            <div class="font-['Roboto'] text-3xl text-[#E5E5E5] mt-8">
                <h2 class="font-['Pirata_one'] text-5xl text-center text-[#C4975E] mb-6">Votre profil </h2>
                <hr class="border-[#C4975E] mb-6">
                <form action="" method="post">
                <label for="full_name">Votre nom : </label>
                <input class="mb-5 bg-[#2E2E2E] rounded-md p-1" type="text" placeholder=" <?php echo $updateProfileController->get_Name() ?>">
                </br>
                <label for="gender">Votre genre : </label>
                <input class="mb-5 bg-[#2E2E2E] rounded-md p-1" type="text" placeholder=" <?php echo $updateProfileController->get_Gender(); ?>">
                </br>
                <label for="email">Votre adresse mail : </label>
                <input class="mb-5 bg-[#2E2E2E] rounded-md p-1" type="text" placeholder=" <?php echo $updateProfileController->get_Email()?>">
                </br>
                <label for="date_of_birth">Votre date de naissance : </label>
                <input class="mb-5 bg-[#2E2E2E] rounded-md p-1" type="text" placeholder=" <?php echo $updateProfileController->get_Date_of_Birth()?>">
                </br>
                
                <div class="flex justify-center ">
                        <a href="/profile" class=" bg-[#C4975E] m-1 hover:bg-[#8B1E1E] rounded-md p-2">Annuler</a>
                        <a class=" bg-[#C4975E] m-1 hover:bg-[#8B1E1E] rounded-md p-2">Valider</a>
                </div>
            </form>
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