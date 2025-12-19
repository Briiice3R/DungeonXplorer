<?php
session_start();
include_once "pdo_agile.php";
include_once "connexion.php";
$db_username = $db_usernameOracle;		
$db_password = $db_passwordOracle;	
$db = $dbOracle;
$conn = OuvrirConnexionPDO($db,$db_username,$db_password);
?>

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
    <?php include_once ("Navbar/Navbar.php"); ?>

    <!-- Conteneur principal -->
    <div class="flex flex-1 p-8 gap-8">

        <!-- Boutons de navigation -->
        <div class="flex flex-col gap-4 w-fit p-4 bg-[#2E2E2E] rounded-lg shadow-lg">
            <a href="/" class="flex items-center gap-2 bg-[#C4975E] text-[#1A1A1A] px-4 py-2 rounded-md font-['Roboto'] text-base hover:bg-[#8B1E1E] transition-colors">
                <i class="fas fa-play"></i> Reprendre
            </a>
            <a href="/" class="flex items-center gap-2 bg-[#C4975E] text-[#1A1A1A] px-4 py-2 rounded-md font-['Roboto'] text-base hover:bg-[#8B1E1E] transition-colors">
                <i class="fas fa-book"></i> Nouvelle Aventure
            </a>
            <a href="/" class="flex items-center gap-2 bg-[#C4975E] text-[#1A1A1A] px-4 py-2 rounded-md font-['Roboto'] text-base hover:bg-[#8B1E1E] transition-colors">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a>
        </div>
    </div>

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
