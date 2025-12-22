<?php
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

    <!-- Contenue principale -->
    <form action="hero/create" method="POST" id="heroForm">
    
        <input type="hidden" name="hero_type_id" id="selectedHeroId" value="" required>

        <div class="flex flex-1 p-8 gap-8">
            <aside class="flex flex-col gap-4 w-fit h-fit p-4 bg-[#2E2E2E] rounded-lg shadow-lg sticky top-8">
                
                <button type="submit" id="btnSubmitAdventure" disabled
                    class="flex items-center gap-2 bg-[#555555] text-[#1A1A1A] px-4 py-2 rounded-md font-['Roboto'] text-base transition-all cursor-not-allowed opacity-50">
                    <i class="fas fa-book"></i> Nouvelle Aventure
                </button>

                <a href="logout" class="flex items-center gap-2 bg-[#C4975E] text-[#1A1A1A] px-4 py-2 rounded-md font-['Roboto'] text-base hover:bg-[#8B1E1E] hover:text-white transition-colors">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
                
                <p id="hintText" class="text-[20px] text-gray-400 mt-2 italic">Choisissez un héros pour commencer</p>
            </aside>

            <section class="flex-1">
                <div class="mb-8 p-6 bg-[#2E2E2E] rounded-lg border border-[#C4975E]/20">
                    <label class="block text-[#C4975E] font-['Pirata_One'] text-2xl mb-2">Pseudo de l'aventurier :</label>
                    <input type="text" name="hero_nickname" required 
                        class="w-full max-w-md bg-[#1A1A1A] border-2 border-[#C4975E]/50 p-3 rounded text-white focus:border-[#C4975E] outline-none">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach($heroTypeArr as $herotype): ?>
                        <div onclick="selectHero(<?= $herotype->getId() ?>, this)" 
                            class="hero-card cursor-pointer bg-[#2E2E2E] p-6 rounded-lg border border-[#C4975E]/10 hover:border-[#C4975E]/50 transition-all flex flex-col items-center group">
                            
                            <h1 class="font-['Pirata_One'] text-3xl text-[#C4975E] mb-4 group-hover:scale-110 transition-transform">
                                <?= htmlspecialchars($herotype->getName()); ?>
                            </h1>
                            
                            <div class="mb-4 overflow-hidden rounded-md border-2 border-[#1A1A1A]">
                                <img src="<?= htmlspecialchars($herotype->getImage()); ?>" class="w-full h-48 object-cover">
                            </div>

                            <div class="text-center">
                                <p class="text-s italic text-gray-400 mb-2">"<?= htmlspecialchars($herotype->getDescription()); ?>"</p>
                                
                                <div class="flex justify-center gap-4 mt-2 mb-4 text-[20px] font-bold text-[#C4975E] uppercase tracking-tighter">
                                    <span><i class="fas fa-heart mr-1"></i> <?= $herotype->getMaxPv() ?> PV</span>
                                    <span><i class="fas fa-fist-raised mr-1"></i> <?= $herotype->getMaxStrength() ?> FORCE</span>
                                    <span><i class="fas fa-bolt mr-1"></i> <?= $herotype->getMaxInitiative() ?> INITIATIVE</span>
                                </div>

                                <span class="text-[20px] uppercase tracking-widest text-[#C4975E] opacity-70 group-hover:opacity-100">Cliquer pour sélectionner</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </form>

    <script>
            let isHeroSelected = false;

            function checkForm() {
                const nickname = document.querySelector('input[name="hero_nickname"]').value.trim();
                const btn = document.getElementById('btnSubmitAdventure');
                const hint = document.getElementById('hintText');

                if (isHeroSelected && nickname !== "") {
                    // Activer le bouton
                    btn.disabled = false;
                    btn.classList.remove('bg-[#555555]', 'cursor-not-allowed', 'opacity-50');
                    btn.classList.add('bg-[#C4975E]', 'hover:bg-[#8B1E1E]', 'hover:text-white', 'cursor-pointer');
                    hint.innerText = "Prêt pour l'aventure !";
                    hint.classList.replace('text-gray-400', 'text-green-500');
                } else {
                    // Désactiver le bouton
                    btn.disabled = true;
                    btn.classList.add('bg-[#555555]', 'cursor-not-allowed', 'opacity-50');
                    btn.classList.remove('bg-[#C4975E]', 'hover:bg-[#8B1E1E]', 'hover:text-white', 'cursor-pointer');
                    
                    if (!isHeroSelected) {
                        hint.innerText = "Choisissez un héros...";
                    } else if (nickname === "") {
                        hint.innerText = "Entrez un pseudo d'aventurier...";
                    }
                    hint.classList.replace('text-green-500', 'text-gray-400');
                }
            }

            function selectHero(id, element) {
                // 1. Mettre à jour l'ID caché
                document.getElementById('selectedHeroId').value = id;
                isHeroSelected = true;

                // 2. Réinitialiser le style de toutes les cartes
                document.querySelectorAll('.hero-card').forEach(card => {
                    card.classList.remove('border-[#C4975E]', 'bg-[#3d3d3d]', 'scale-105', 'shadow-[0_0_15px_rgba(196,151,94,0.3)]');
                    card.classList.add('border-[#C4975E]/10', 'bg-[#2E2E2E]');
                });

                // 3. Appliquer le style "Sélectionné"
                element.classList.remove('border-[#C4975E]/10', 'bg-[#2E2E2E]');
                element.classList.add('border-[#C4975E]', 'bg-[#3d3d3d]', 'scale-105', 'shadow-[0_0_15px_rgba(196,151,94,0.3)]');

                checkForm(); // Vérifier si on peut activer le bouton
            }

            // Écouter quand l'utilisateur tape son pseudo
            document.querySelector('input[name="hero_nickname"]').addEventListener('input', checkForm);
    </script>
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
