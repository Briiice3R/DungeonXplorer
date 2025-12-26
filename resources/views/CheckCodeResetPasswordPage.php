<?php

if (!isset($_SESSION["incorrectCode"])) {
    $_SESSION["incorrectCode"] = false;
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="icon" href="/DungeonXplorer/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - DungeonXplorer</title>
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
    
    <h1 class="font-['Pirata_One'] text-5xl text-center text-[#C4975E] mt-8 mb-6">Réinitilisation du mot de passe</h1>
    <div class="max-w-md mx-auto bg-[#2E2E2E] rounded-lg shadow-2xl p-8 border-2 border-[#C4975E]/30">
        <p class="block text-[#C4975E] text-xl mb-4">Si l'adresse email est correcte, un code de vérification y a été envoyé. Celui-ci expirera dans 15 minutes.</p>
        <form action="checkResetPassword" method="POST" class="max-w-md mx-auto">
            <?php 
                if($_SESSION["incorrectCode"]==True){
                    echo "<label class='block text-[#8B1E1E] text-xl mb-4'>Code incorrecte et/ou expiré</label>";
                }
                
            ?>
            <label class="block text-[#C4975E] text-xl mb-2">Code de vérification : </label>
            <input id="code" name="code" type="text" inputmode="numeric" pattern="[0-9]*" maxlength="6" placeholder="XXXXXX" class="w-full bg-[#2E2E2E] border border-[#C4975E] text-[#E5E5E5] rounded p-2 mb-2 focus:outline-none focus:border-[#8B1E1E]" required>

            <input type="submit" value="Réinitialiser" class="w-full bg-[#C4975E] hover:bg-[#8B1E1E] text-white rounded-md p-2 cursor-pointer font-['Pirata_One'] text-2xl">
        </form>
        
    </div>
</body>
</html>