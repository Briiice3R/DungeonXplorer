<?php
session_start();
include_once "pdo_agile.php";
include_once "connexion.php";
$db_username = $db_usernameOracle;		
$db_password = $db_passwordOracle;	
$db = $dbOracle;
$conn = OuvrirConnexionPDO($db,$db_username,$db_password);

$heroTypeArr = \App\Models\Heroes\HeroType::findAll();
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
                <i class="fas fa-book"></i> Nouvelle Aventure
            </a>
            <a href="/" class="flex items-center gap-2 bg-[#C4975E] text-[#1A1A1A] px-4 py-2 rounded-md font-['Roboto'] text-base hover:bg-[#8B1E1E] transition-colors">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a>
        </div>
    </div>

    <!-- Contenu Principale droite -->
    <section class="flex-1">
            <form action="/hero/create" method="POST">
                
                <div class="bg-[#2E2E2E] p-8 rounded-lg shadow-xl border-l-4 border-[#C4975E] mb-8">
                    <h2 class="font-pirata text-3xl text-[#C4975E] mb-4 text-center md:text-left">Identité de l'aventurier</h2>
                    <div class="max-w-md">
                        <label for="nickname" class="block text-gray-400 text-sm mb-2 uppercase tracking-widest">Nom du héros</label>
                        <input type="text" id="nickname" name="hero_nickname" required 
                               class="w-full bg-[#1A1A1A] border-2 border-[#C4975E]/50 p-3 rounded text-white focus:outline-none focus:border-[#C4975E] transition-colors"
                               placeholder="Ex: Valerius le Hardi">
                    </div>
                </div>

                <h2 class="font-pirata text-4xl text-[#C4975E] mb-6 text-center">Choisissez votre destinée</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach($heroTypeArr as $herotype): ?>
                        <div class="bg-[#2E2E2E] p-6 rounded-lg shadow-xl border border-[#C4975E]/10 flex flex-col hover:border-[#C4975E]/60 transition-all group">
                            
                            <h3 class="font-pirata text-3xl text-[#C4975E] mb-4 group-hover:translate-x-2 transition-transform">
                                <?php echo htmlspecialchars($herotype->getName()); ?>
                            </h3>
                            
                            <div class="mb-4 overflow-hidden rounded-md border-2 border-[#1A1A1A] group-hover:border-[#C4975E]/30 transition-colors">
                                <img src="<?php echo htmlspecialchars($herotype->getImage()); ?>" 
                                     alt="Classe <?php echo htmlspecialchars($herotype->getName()); ?>" 
                                     class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>

                            <div class="flex-1">
                                <p class="italic text-gray-400 mb-4 text-sm leading-relaxed">
                                    "<?php echo htmlspecialchars($herotype->getDescription()); ?>"
                                </p>
                                
                                <div class="grid grid-cols-2 gap-y-2 gap-x-4 text-xs bg-[#1A1A1A] p-3 rounded border border-gray-700">
                                    <p class="flex justify-between"><span class="text-[#8B1E1E] font-bold">PV:</span> <span><?php echo $herotype->getMaxPv(); ?></span></p>
                                    <p class="flex justify-between"><span class="text-[#4A90E2] font-bold">Mana:</span> <span><?php echo $herotype->getMaxMana(); ?></span></p>
                                    <p class="flex justify-between"><span class="text-[#C4975E] font-bold">Force:</span> <span><?php echo $herotype->getMaxStrength(); ?></span></p>
                                    <p class="flex justify-between"><span class="text-[#45a049] font-bold">Init:</span> <span><?php echo $herotype->getMaxInitiative(); ?></span></p>
                                </div>
                            </div>
                            
                            <button type="submit" name="hero_type_id" value="<?php echo $herotype->getId(); ?>" 
                                    class="mt-6 w-full bg-[#3a3a3a] text-[#C4975E] py-3 rounded font-bold border border-[#C4975E]/30 hover:bg-[#C4975E] hover:text-[#1A1A1A] transition-all uppercase tracking-widest text-sm">
                                Invoquer ce héros
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </form>
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
