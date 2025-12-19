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
    <title>DungeonXplorer - Accueil</title>
    <!-- Polices Google -->
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Configuration des polices et couleurs pour Tailwind */
        @import url('https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:wght@400;700&display=swap');
    </style>
</head>
<body class="font-['Roboto'] text-[#E5E5E5] bg-[#1A1A1A] min-h-screen flex flex-col">

    <!-- Header -->
    <?php include_once ("Navbar/Navbar.php"); ?>

    <!-- Section Hero -->
    <section class="bg-cover bg-center h-96 flex flex-col justify-center items-center text-center text-[#E5E5E5]"
             style="background-image: url('https://source.unsplash.com/random/1600x900/?dark-fantasy');">
        <h1 class="font-['Pirata_One'] text-5xl mb-4">Bienvenue dans DungeonXplorer</h1>
        <p class="text-xl mb-6">Bienvenue sur DungeonXplorer, l'univers de dark fantasy où se mêlent aventure, stratégie et immersion
            totale dans les récits interactifs.
        </p>
        <a href="/aventurecreate" class="bg-[#C4975E] text-[#1A1A1A] px-6 py-3 rounded-lg font-['Pirata_One'] text-xl cursor-pointer hover:bg-[#8B1E1E] transition-colors">
                <i class="fas fa-book"></i> Commencer l'aventure
        </a>
    </section>

    <!-- Section Contenu -->
    <section class="p-8 max-w-5xl mx-auto">
        <h2 class="font-['Pirata_One'] text-3xl text-[#C4975E] border-b-2 border-[#8B1E1E] pb-2">À propos du projet</h2>
        <div class="mt-4 text-lg">
            <p>Ce projet est né de la volonté de l’association Les Aventuriers du Val Perdu de raviver l’expérience unique
                des livres dont vous êtes le héros. Notre vision : offrir à la communauté un espace où chacun peut
                incarner un personnage et plonger dans des quêtes épiques et personnalisées.
            </p><br>
            <p>Dans sa première version, DungeonXplorer permettra aux joueurs de créer un personnage parmi trois
                classes emblématiques — guerrier, voleur, magicien — et d’évoluer dans un scénario captivant, tout en
                assurant à chacun la possibilité de conserver sa progression.
            </p><br>
            <p>Nous sommes enthousiastes de partager avec vous cette application et espérons qu'elle saura vous
                plonger au cœur des mystères du Val Perdu !
            </p>
        </div>
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