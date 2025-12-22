<?php
$heroTypeArr = \App\Models\Heroes\HeroType::findAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DungeonXplorer - Créer un Héros</title>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-['Roboto'] text-[#E5E5E5] bg-[#1A1A1A] min-h-screen flex flex-col">

    <?php include_once (__DIR__ . "/Navbar/Navbar.php"); ?>

    <main class="flex-1 flex flex-col lg:flex-row p-8 gap-8 max-w-7xl mx-auto w-full">
        
        <aside class="w-full lg:w-1/4 flex flex-col gap-4">
            <div class="p-6 bg-[#2E2E2E] rounded-lg border border-[#C4975E]/20 shadow-lg sticky top-24">
                <h2 class="font-['Pirata_One'] text-3xl text-[#C4975E] mb-6 border-b border-[#C4975E]/10 pb-2">Actions</h2>
                
                <div class="flex flex-col gap-3">
                    <button type="submit" form="heroForm" id="btnSubmitAdventure" disabled
                        class="flex items-center justify-center gap-3 bg-[#555555] text-[#1A1A1A] px-4 py-3 rounded-md font-bold transition-all cursor-not-allowed opacity-50 shadow-md">
                        <i class="fas fa-book"></i> Commencer l'aventure
                    </button>

                    <a href="/DungeonXplorer/aventureaccueil" class="flex items-center justify-center gap-3 bg-[#1A1A1A] border border-[#C4975E]/30 text-[#C4975E] px-4 py-3 rounded-md hover:border-[#C4975E] transition-all">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>

                    <a href="/DungeonXplorer/logout" class="flex items-center justify-center gap-3 text-gray-500 hover:text-red-500 transition-colors mt-4 text-sm">
                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                    </a>

                    <p id="hintText" class="text-sm text-gray-400 mt-4 italic text-center uppercase tracking-widest">
                        Choisissez un héros et un pseudo
                    </p>
                </div>
            </div>
        </aside>

        <section class="flex-1">
            <h1 class="font-['Pirata_One'] text-5xl text-[#C4975E] mb-8 tracking-wide">Nouvel Aventurier</h1>

            <form action="hero/create" method="POST" id="heroForm" class="space-y-8">
                <input type="hidden" name="hero_type_id" id="selectedHeroId" value="" required>

                <div class="p-6 bg-[#2E2E2E] rounded-lg border border-[#C4975E]/20 shadow-xl">
                    <label class="block text-[#C4975E] font-['Pirata_One'] text-2xl mb-4 italic">
                        <i class="fas fa-feather-alt mr-2"></i>Pseudo de l'aventurier :
                    </label>
                    <input type="text" name="hero_nickname" required placeholder="Ex: Valerius le Brave"
                        class="w-full max-w-md bg-[#1A1A1A] border-2 border-[#C4975E]/30 p-4 rounded text-white focus:border-[#C4975E] outline-none transition-colors text-lg">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach($heroTypeArr as $herotype): ?>
                        <div onclick="selectHero(<?= $herotype->getId() ?>, this)" 
                            class="hero-card cursor-pointer bg-[#2E2E2E] p-6 rounded-lg border border-[#C4975E]/10 hover:border-[#C4975E]/50 transition-all flex flex-col items-center group shadow-lg relative overflow-hidden">
                            
                            <h3 class="font-['Pirata_One'] text-3xl text-[#C4975E] mb-4 group-hover:scale-110 transition-transform">
                                <?= htmlspecialchars($herotype->getName()); ?>
                            </h3>
                            
                            <div class="mb-4 overflow-hidden rounded-md border-2 border-[#1A1A1A] w-full">
                                <img src="<?= htmlspecialchars($herotype->getImage()); ?>" class="w-full h-48 object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                            </div>

                            <div class="text-center">
                                <p class="text-xs italic text-gray-400 mb-4 h-12">"<?= htmlspecialchars($herotype->getDescription()); ?>"</p>
                                
                                <div class="flex flex-wrap justify-center gap-3 text-sm font-bold text-[#C4975E] uppercase tracking-tighter bg-[#1A1A1A]/50 p-2 rounded border border-[#C4975E]/10">
                                    <span><i class="fas fa-heart mr-1"></i> <?= $herotype->getMaxPv() ?> PV</span>
                                    <span><i class="fas fa-fist-raised mr-1"></i> <?= $herotype->getMaxStrength() ?> FORCE</span>
                                    <span><i class="fas fa-bolt mr-1"></i> <?= $herotype->getMaxInitiative() ?> INITIATIVE</span>
                                </div>
                            </div>

                            <div class="absolute inset-0 border-4 border-[#C4975E] opacity-0 transition-opacity pointer-events-none rounded-lg selection-overlay"></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </form>
        </section>
    </main>

    <script>
        let isHeroSelected = false;

        function checkForm() {
            const nickname = document.querySelector('input[name="hero_nickname"]').value.trim();
            const btn = document.getElementById('btnSubmitAdventure');
            const hint = document.getElementById('hintText');

            if (isHeroSelected && nickname !== "") {
                btn.disabled = false;
                btn.classList.remove('bg-[#555555]', 'cursor-not-allowed', 'opacity-50');
                btn.classList.add('bg-[#C4975E]', 'hover:bg-[#8B1E1E]', 'hover:text-white', 'cursor-pointer');
                hint.innerText = "Prêt pour l'aventure !";
                hint.classList.replace('text-gray-400', 'text-green-500');
            } else {
                btn.disabled = true;
                btn.classList.add('bg-[#555555]', 'cursor-not-allowed', 'opacity-50');
                btn.classList.remove('bg-[#C4975E]', 'hover:bg-[#8B1E1E]', 'hover:text-white', 'cursor-pointer');
                hint.innerText = isHeroSelected ? "Entrez un pseudo..." : "Choisissez un héros...";
                hint.classList.replace('text-green-500', 'text-gray-400');
            }
        }

        function selectHero(id, element) {
            document.getElementById('selectedHeroId').value = id;
            isHeroSelected = true;

            document.querySelectorAll('.hero-card').forEach(card => {
                card.classList.remove('border-[#C4975E]', 'bg-[#3d3d3d]', 'scale-105', 'shadow-[0_0_20px_rgba(196,151,94,0.4)]');
                card.querySelector('.selection-overlay').classList.replace('opacity-100', 'opacity-0');
            });

            element.classList.add('border-[#C4975E]', 'bg-[#3d3d3d]', 'scale-105', 'shadow-[0_0_20px_rgba(196,151,94,0.4)]');
            element.querySelector('.selection-overlay').classList.replace('opacity-0', 'opacity-100');

            checkForm();
        }

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
