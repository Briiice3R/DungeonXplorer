<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DungeonXplorer - Vos Aventures</title>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-['Roboto'] text-[#E5E5E5] bg-[#1A1A1A] min-h-screen flex flex-col">
    
    <?php include_once (__DIR__ . "/Navbar/Navbar.php"); ?>

    <main class="flex-1 flex flex-col lg:flex-row p-8 gap-8 max-w-7xl mx-auto w-full">

        <aside class="w-full lg:w-1/4 flex flex-col gap-4">
            <div class="p-6 bg-[#2E2E2E] rounded-lg border border-[#C4975E]/20 shadow-lg sticky top-24">
                <h2 class="font-['Pirata_One'] text-3xl text-[#C4975E] mb-6 border-b border-[#C4975E]/10 pb-2">Menu</h2>
                
                <div class="flex flex-col gap-3">
                    <a href="/DungeonXplorer/aventurecreate" class="flex items-center justify-center gap-3 bg-[#C4975E] text-[#1A1A1A] px-4 py-3 rounded-md font-bold hover:bg-[#8B1E1E] hover:text-white transition-all shadow-md">
                        <i class="fas fa-scroll"></i> Nouvelle Aventure
                    </a>

                    <a href="/DungeonXplorer/logout" class="flex items-center justify-center gap-3 text-gray-500 hover:text-red-500 transition-colors mt-4 text-sm">
                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                    </a>
                </div>
            </div>
        </aside>

        <section class="flex-1">
            <h1 class="font-['Pirata_One'] text-5xl text-[#C4975E] mb-8 tracking-wide">Reprendre le périple</h1>

            <?php if (!empty($ongoingAdventures)): ?>
                <div class="grid grid-cols-1 gap-6">
                    <?php foreach ($ongoingAdventures as $adv): ?>
                        <div class="group bg-[#2E2E2E] rounded-lg border border-[#C4975E]/10 hover:border-[#C4975E]/50 transition-all flex flex-col md:flex-row overflow-hidden shadow-xl">
                            
                            <div class="w-full md:w-32 h-32 md:h-auto bg-[#1A1A1A] flex-shrink-0 border-r border-[#C4975E]/10">
                                <img src="<?= htmlspecialchars($adv['hero_img']) ?>" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity" alt="Héros">
                            </div>

                            <div class="p-6 flex-1 flex flex-col md:flex-row justify-between items-center gap-6">
                                <div>
                                    <h3 class="font-['Pirata_One'] text-3xl text-[#C4975E] mb-1">
                                        <?= htmlspecialchars($adv['name']) ?>
                                    </h3>
                                    <div class="flex items-center gap-4 text-sm text-gray-400 italic">
                                        <span><i class="fas fa-map-marker-alt mr-2 text-amber-600"></i><?= htmlspecialchars($adv['chapter_title']) ?></span>
                                        <span class="text-gray-600">|</span>
                                        <span><i class="fas fa-clock mr-2"></i><?= date('d/m/Y H:i', strtotime($adv['start_date'])) ?></span>
                                    </div>
                                </div>

                                <a href="/DungeonXplorer/chapter/reprendre/<?= $adv['id'] ?>/<?= $adv['chapter_id'] ?>" 
                                   class="w-full md:w-auto flex items-center justify-center gap-3 bg-[#1A1A1A] border-2 border-[#C4975E] text-[#C4975E] px-8 py-3 rounded-full font-bold uppercase tracking-widest hover:bg-[#C4975E] hover:text-[#1A1A1A] transition-all transform hover:scale-105 shadow-lg">
                                    <i class="fas fa-play"></i> Continuer
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="flex flex-col items-center justify-center py-20 bg-[#2E2E2E]/30 rounded-lg border-2 border-dashed border-[#C4975E]/10 text-center">
                    <i class="fas fa-ghost text-6xl text-gray-700 mb-6"></i>
                    <p class="text-2xl text-gray-500 font-['Pirata_One']">Aucune légende n'est encore écrite...</p>
                    <a href="/DungeonXplorer/aventurecreate" class="mt-4 text-[#C4975E] hover:underline">Créez votre premier héros pour commencer</a>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-[#2E2E2E] text-center p-4 mt-auto">
        <p class="mb-2">&copy; 2025 DungeonXplorer. Tous droits réservés.</p>
        <a href="https://github.com/Briiice3R/DungeonXplorer" class="text-[#C4975E] mx-2 text-2xl">
            <i class="fa-brands fa-github"></i>
        </a>
    </footer>

</body>
</html>