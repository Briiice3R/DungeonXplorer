<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DungeonXplorer - <?php echo htmlspecialchars($chapter->getTitle()); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-['Roboto'] text-[#E5E5E5] bg-[#1A1A1A] min-h-screen flex flex-col">

    <?php include_once (__DIR__ . "/Navbar/Navbar.php"); ?>

    <main class="flex-1 flex flex-col items-center p-8">
        
        <h1 class="font-['Pirata_One'] text-5xl md:text-7xl text-[#C4975E] mb-8 tracking-wider text-center">
            <?= htmlspecialchars($chapter->getTitle()); ?>
        </h1>

        <div class="flex flex-col lg:flex-row gap-8 w-full max-w-6xl items-start">
            
            <div class="w-full lg:w-1/2">
                <div class="rounded-lg overflow-hidden border-2 border-[#C4975E]/30 shadow-[0_0_20px_rgba(196,151,94,0.15)]">
                    <img src="/DungeonXplorer/<?= ltrim($chapter->getImage()); ?>" 
                         alt="Illustration" 
                         class="w-full h-auto object-cover opacity-90 hover:opacity-100 transition-opacity">
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex flex-col gap-6">
                
                <div class="bg-[#2E2E2E] p-8 rounded-lg border border-[#C4975E]/20 shadow-lg">
                    <p class="text-xl leading-relaxed text-gray-300 italic">
                        "<?= nl2br(htmlspecialchars($chapter->getDescription())); ?>"
                    </p>
                </div>

                <div class="flex flex-col gap-4">
                    <h2 class="font-['Pirata_One'] text-3xl text-[#C4975E] mb-2">
                        <i class="fas fa-compass mr-2"></i> Quel sera votre choix ?
                    </h2>

                    <div class="grid grid-cols-1 gap-4">
                        <?php if (!empty($chapter->getChoices())): ?>
                            <?php foreach ($chapter->getChoices() as $choice): ?>
                                <a href="/DungeonXplorer/chapter/<?= $choice['to_chapter_id']; ?>" 
                                   class="group flex items-center justify-between bg-[#2E2E2E] border border-[#C4975E]/30 p-5 rounded-lg hover:bg-[#3d3d3d] hover:border-[#C4975E] hover:scale-[1.02] transition-all shadow-md">
                                    <span class="text-lg font-bold"><?= htmlspecialchars($choice['choice_text']); ?></span>
                                    <i class="fas fa-chevron-right text-[#C4975E] group-hover:translate-x-2 transition-transform"></i>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center p-6 bg-[#2E2E2E] rounded-lg border border-red-900/50">
                                <p class="text-red-400 italic mb-4">L'aventure s'achève ici...</p>
                                <a href="/DungeonXplorer/aventureaccueil" 
                                   class="inline-block bg-[#C4975E] text-[#1A1A1A] px-6 py-2 rounded-md font-bold hover:bg-[#8B1E1E] hover:text-white transition-colors">
                                    <i class="fas fa-undo mr-2"></i> Recommencer
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-[#2E2E2E] text-center p-4 mt-auto border-t border-[#C4975E]/10">
        <p class="mb-2 text-gray-400">&copy; 2025 DungeonXplorer. Tous droits réservés.</p>
        <a href="https://github.com/Briiice3R/DungeonXplorer" class="text-[#C4975E] mx-2 text-2xl hover:text-white transition-colors">
            <i class="fa-brands fa-github"></i>
        </a>
    </footer>

</body>
</html>