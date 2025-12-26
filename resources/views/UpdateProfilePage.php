<!DOCTYPE html>
<html lang="fr">
    <head>
        <link rel="icon" href="/DungeonXplorer/favicon.ico" type="image/x-icon">
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
        <?php include_once ("Navbar/Navbar.php"); ?>
        </header>
        <main class="flex justify-center">
            <div class="font-['Roboto'] text-3xl text-[#E5E5E5] mt-8">
                <h2 class="font-['Pirata_one'] text-5xl text-center text-[#C4975E] mb-6">Votre profil </h2>
                <hr class="border-[#C4975E] mb-6">
                <form action='<?php echo "/DungeonXplorer/update/".$_SESSION["userId"];?>' method="POST">
                    <label for="username">Votre nom : </label>
                    <input name="username" class="mb-5 bg-[#2E2E2E] rounded-md p-1" type="text" placeholder='<?php echo htmlspecialchars($updateProfileController->get_Name())?>'>
                    </br>
                     <label for="gender">Votre genre : </label>
                    <input name="gender" value="female" class="mb-5 bg-[#2E2E2E] rounded-md p-1" type="radio" <?php if($updateProfileController->get_Gender() == 'Female') {echo "checked";}?>>
                    <label for="femme">femme </label>
                    <input name="gender"  value="male" class="mb-5 bg-[#2E2E2E] rounded-md p-1" type="radio" <?php if($updateProfileController->get_Gender() == 'male') {echo "checked";}?>>
                    <label for="homme">homme </label>

                    <input name="gender"  value="other" class="mb-5 bg-[#2E2E2E] rounded-md p-1" type="radio" <?php if($updateProfileController->get_Gender() == 'other') {echo "checked";}?>>

                    <label for="homme">autre </label>
                    <input name="gender"  value="prefer_not_to_say" class="mb-5 bg-[#2E2E2E] rounded-md p-1" type="radio" <?php if($updateProfileController->get_Gender() == 'prefer_not_to_say') {echo "checked";}?>>

                    <label for="homme">ne souhaite pas communiquer </label>

                    </br>
                    <label for="email">Votre adresse mail : </label>
                    <input name="email" class="mb-5 bg-[#2E2E2E] rounded-md p-1" type="text" placeholder='<?php echo htmlspecialchars($updateProfileController->get_Email())?>'>
                    </br>
                    <label for="password">Votre mot de passe : </label>
                    <input name="password" class="mb-5 bg-[#2E2E2E] rounded-md p-1" type="password" min="1925-01-01" max="2025-12-02">
                    </br>
                    <div class="flex justify-center ">
                        <a href='<?php echo "/DungeonXplorer/profile/".$_SESSION["userId"];?>' class=" bg-[#C4975E] m-1 hover:bg-[#8B1E1E] rounded-md p-2">Annuler</a>
                        <input type="submit" value="Valider" class=" bg-[#C4975E] m-1 hover:bg-[#8B1E1E] rounded-md p-2">
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