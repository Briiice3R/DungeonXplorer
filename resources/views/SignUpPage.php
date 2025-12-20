<?php
use App\Utils\SessionInitializer;
if (!isset($_SESSION["alreadyUsedEmail"])) {
    $_SESSION["alreadyUsedEmail"] = "False";
}
if (!isset($_SESSION["alreadyUsedUsername"])) {
    $_SESSION["alreadyUsedUsername"] = "False";
}
if (!isset($_SESSION["registrationError"])) {
    $_SESSION["registrationError"] = "False";
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - DungeonXplorer</title>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:wght@400;700&display=swap');
    </style>
</head>
<body class="font-['Roboto'] text-[#E5E5E5] bg-[#1A1A1A] min-h-screen flex flex-col">
    <h1 class="font-['Pirata_One'] text-5xl text-center text-[#C4975E] mt-8 mb-6">Inscription</h1>
    
    <form action="/signup" method="POST" class="max-w-md mx-auto">
        <?php 
            if($_SESSION["registrationError"]=="True"){
                echo "<label class='block text-[#8B1E1E] text-xl mb-4'>Une erreur est survenue.</label>";
            }
        ?>
        <label class="block text-[#C4975E] text-xl mb-2">Nom d'utilisateur : </label>
        <input id="username" name="username" type="text" class="w-full bg-[#2E2E2E] border border-[#C4975E] text-[#E5E5E5] rounded p-2 mb-2 focus:outline-none focus:border-[#8B1E1E]" required>
        <?php 
            if($_SESSION["alreadyUsedUsername"]=="True"){
                echo "<label class='block text-[#8B1E1E] mb-4'>Nom d'utilisateur déjà utilisé</label>";
            }
        ?>
        <label class="block text-[#C4975E] text-xl mb-2">Adresse email : </label>
        <input id="email" name="email" type="email" class="w-full bg-[#2E2E2E] border border-[#C4975E] text-[#E5E5E5] rounded p-2 mb-2 focus:outline-none focus:border-[#8B1E1E]" required>
        <?php 
            if($_SESSION["alreadyUsedEmail"]=="True"){
                echo "<label class='block text-[#8B1E1E] mb-4'>Adresse email déjà utilisé</label>";
            }
        ?>
        <label class="block text-[#C4975E] text-xl mb-2">Mot de passe : </label>
        <input id="password_1" name="password_1" type="password" class="w-full bg-[#2E2E2E] border border-[#C4975E] text-[#E5E5E5] rounded p-2 mb-4 focus:outline-none focus:border-[#8B1E1E]" required>
        <label class="block text-[#C4975E] text-xl mb-2">Confirmer le mot de passe : </label>
        <input id="password_2" name="password_2" type="password" class="w-full bg-[#2E2E2E] border border-[#C4975E] text-[#E5E5E5] rounded p-2 mb-4 focus:outline-none focus:border-[#8B1E1E]" required>
        
        <input type="submit" value="Send" class="w-full bg-[#C4975E] hover:bg-[#8B1E1E] text-white rounded-md p-2 cursor-pointer font-['Pirata_One'] text-2xl">
    </form>

</body>
</html>