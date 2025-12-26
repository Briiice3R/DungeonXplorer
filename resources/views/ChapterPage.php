<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="icon" href="/DungeonXplorer/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DungeonXplorer - <?= htmlspecialchars($chapter->getTitle()); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #1A1A1A; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #C4975E; border-radius: 10px; }
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
        .animate-popup { animation: fadeIn 0.3s ease-out; }
        
        .equipment-button.active {
            background-color: #C4975E !important;
            color: #1A1A1A !important;
            font-weight: bold;
        }
    </style>
</head>
<body class="font-['Roboto'] text-[#E5E5E5] bg-[#1A1A1A] min-h-screen flex flex-col">

    <?php include_once (__DIR__ . "/Navbar/Navbar.php"); ?>

    <main class="flex-1 flex flex-col items-center p-8 relative">
        <?php if (isset($_GET['success']) && $_GET['success'] === 'equipok'): ?>
            <div id="success-alert" class="w-full max-w-6xl bg-green-600/20 border border-green-500 text-green-400 p-4 rounded-lg mb-6 flex items-center justify-between animate-bounce">
                <div class="flex items-center gap-3">
                    <i class="fas fa-check-circle text-2xl"></i>
                    <span class="font-bold uppercase tracking-widest text-sm">Équipement mis à jour avec succès !</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-white/50 hover:text-white">&times;</button>
            </div>
            <script>
                setTimeout(() => {
                    const alert = document.getElementById('success-alert');
                    if(alert) alert.style.display = 'none';
                }, 4000);
            </script>
        <?php endif; ?>
        <?php if (isset($_SESSION['item_collected']) && $_SESSION['item_collected']): ?>
            <div id="item-alert" class="w-full max-w-6xl bg-blue-600/20 border border-blue-400 text-blue-300 p-4 rounded-lg mb-6 flex items-center justify-between animate-pulse">
                <div class="flex items-center gap-3">
                    <i class="fas fa-treasure-chest text-2xl text-[#C4975E]"></i>
                    <span class="font-bold uppercase tracking-widest text-sm">Nouveau trésor trouvé ! L'objet a été ajouté à votre inventaire.</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-white/50 hover:text-white">&times;</button>
            </div>
            <?php unset($_SESSION['item_collected']); ?>
        <?php endif; ?>

        <h1 class="font-['Pirata_One'] text-5xl md:text-7xl text-[#C4975E] mb-8 tracking-wider text-center">
            <?= htmlspecialchars($chapter->getTitle()); ?>
        </h1>

        <div class="flex flex-col lg:flex-row gap-8 w-full max-w-6xl items-start">
            <div class="w-full lg:w-1/2">
                <div class="rounded-lg overflow-hidden border-2 border-[#C4975E]/30 shadow-[0_0_20px_rgba(196,151,94,0.15)]">
                    <img src="/DungeonXplorer/<?= ltrim($chapter->getImage(), '/'); ?>" alt="Illustration" class="w-full h-auto object-cover opacity-90 hover:opacity-100 transition-opacity">
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex flex-col gap-6">
                <div class="bg-[#2E2E2E] p-8 rounded-lg border border-[#C4975E]/20 shadow-lg">
                    <p class="text-xl leading-relaxed text-gray-300 italic">
                        "<?= nl2br(htmlspecialchars($chapter->getDescription())); ?>"
                    </p>
                </div>

                <div class="flex flex-col gap-4">
                    <h2 class="font-['Pirata_One'] text-3xl text-[#C4975E] mb-2"><i class="fas fa-compass mr-2"></i> Quel sera votre choix ?</h2>
                    <div class="grid grid-cols-1 gap-4">
                        <?php if($chapter->getMonsterId() == -1): ?>
                            <?php if (!empty($chapter->getChoices())): ?>
                                <?php foreach ($chapter->getChoices() as $choice): ?>
                                    <a href="/DungeonXplorer/chapter/<?= $choice['to_chapter_id']; ?>" class="group flex items-center justify-between bg-[#2E2E2E] border border-[#C4975E]/30 p-5 rounded-lg hover:bg-[#3d3d3d] hover:border-[#C4975E] hover:scale-[1.02] transition-all shadow-md">
                                        <span class="text-lg font-bold"><?= htmlspecialchars($choice['choice_text']); ?></span>
                                        <i class="fas fa-chevron-right text-[#C4975E] group-hover:translate-x-2 transition-transform"></i>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center p-6 bg-[#2E2E2E] rounded-lg border border-red-900/50">
                                    <p class="text-red-400 italic mb-4">L'aventure s'achève ici...</p>
                                    <a href="/DungeonXplorer/aventureaccueil" class="bg-[#C4975E] text-[#1A1A1A] px-6 py-2 rounded-md font-bold hover:bg-white transition-colors uppercase">Recommencer</a>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <button onclick="toggleInventory()" class="group flex items-center justify-between bg-[#C4975E]/10 border border-[#C4975E]/50 p-5 rounded-lg hover:bg-[#C4975E] hover:text-black transition-all shadow-md">
                                <span class="text-lg font-bold uppercase tracking-widest italic">Accéder à l'inventaire</span>
                                <i class="fas fa-briefcase text-[#C4975E] group-hover:text-black"></i>
                            </button>
                            <a href="/DungeonXplorer/fight/<?= $chapter->getId() ?>" class="group flex items-center justify-between bg-[#8B1E1E] border border-red-500/30 p-5 rounded-lg hover:bg-red-700 hover:border-white hover:scale-[1.02] transition-all shadow-md">
                                <span class="text-lg font-bold uppercase tracking-widest">Entrer en Combat</span>
                                <i class="fas fa-skull text-white group-hover:animate-pulse"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="inventoryModal" class="fixed inset-0 bg-black/85 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-[#2E2E2E] border-2 border-[#C4975E]/50 rounded-xl shadow-2xl w-full max-w-4xl overflow-hidden animate-popup">
            <div class="p-6 border-b border-[#C4975E]/20 bg-[#1A1A1A]/50 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <i class="fas fa-scroll text-[#C4975E] text-2xl"></i>
                    <h2 class="font-['Pirata_One'] text-4xl text-[#C4975E] tracking-wide">Equipement de <?= htmlspecialchars($hero->getName()) ?></h2>
                </div>
                <button onclick="toggleInventory()" class="text-gray-500 hover:text-white text-3xl transition-colors">&times;</button>
            </div>

            <div class="p-8 max-h-[65vh] overflow-y-auto custom-scrollbar">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php if ($hero->getInventoryItems() && !empty($hero->getInventoryItems()->getItems())): ?>
                        <?php foreach ($hero->getInventoryItems()->getItems() as $slot): ?>
                            <?php 
                                $item = $slot->getItem();
                                $type = $item->getItemType()->getCategory();
                                $itemId = $item->getId();
                                $quantity = $slot->getQuantity();
                            ?>
                            <div class="item-card bg-[#1F1F1F] p-4 rounded-lg border border-[#C4975E]/20 shadow-md hover:border-[#C4975E]/50 transition-colors"
                                 data-itemid="<?= $itemId ?>"
                                 data-type="<?= htmlspecialchars($type) ?>"
                                 data-qty="<?= $quantity ?>">
                                
                                <h3 class="text-[#C4975E] font-bold text-lg mb-1"><?= htmlspecialchars($item->getName()) ?></h3>
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-gray-500 text-[10px] uppercase font-bold tracking-tighter italic"><?= htmlspecialchars($type) ?></span>
                                    <span class="text-white text-xs bg-[#2E2E2E] px-2 py-0.5 rounded border border-white/5">x<?= $quantity ?></span>
                                </div>
                                <div class="flex gap-2">
                                    <?php if ($type === "Arme"): ?>
                                        <button class="equipment-button left flex-1 bg-[#C4975E]/10 border border-[#C4975E]/30 text-[10px] py-2 rounded hover:bg-[#C4975E]/30 transition uppercase font-bold <?= ($hero->getPrimaryWeapon() && $hero->getPrimaryWeapon()->getId() == $itemId) ? 'active' : '' ?>" data-equipmentType="left">Main G.</button>
                                        <button class="equipment-button right flex-1 bg-[#C4975E]/10 border border-[#C4975E]/30 text-[10px] py-2 rounded hover:bg-[#C4975E]/30 transition uppercase font-bold <?= ($hero->getSecondaryWeapon() && $hero->getSecondaryWeapon()->getId() == $itemId) ? 'active' : '' ?>" data-equipmentType="right">Main D.</button>
                                    <?php elseif ($type === "Armure"): ?>
                                        <button class="equipment-button armor w-full bg-[#C4975E]/10 border border-[#C4975E]/30 text-[10px] py-2 rounded hover:bg-[#C4975E]/30 transition uppercase font-bold <?= ($hero->getArmor() && $hero->getArmor()->getId() == $itemId) ? 'active' : '' ?>" data-equipmentType="armor">Equiper</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <form id="equipForm" action="/DungeonXplorer/saveInventory/<?= $hero->getId() ?>" method="POST" class="mt-10 text-center border-t border-[#C4975E]/10 pt-8">
                    <input type="hidden" id="inventoryDataField" name="equippedData">
                    <button type="submit" class="bg-[#C4975E] text-[#1A1A1A] px-12 py-4 rounded font-bold hover:bg-white hover:scale-105 transition-all shadow-[0_0_20px_rgba(196,151,94,0.3)] uppercase tracking-widest font-['Pirata_One'] text-3xl">
                        Enregistrer l'équipement
                    </button>
                </form>
            </div>
        </div>
    </div>

    <footer class="bg-[#2E2E2E] text-center p-4 mt-auto border-t border-[#C4975E]/10">
        <p class="mb-2 text-gray-400">&copy; 2025 DungeonXplorer. Tous droits réservés.</p>
        <a href="https://github.com/Briiice3R/DungeonXplorer" class="text-[#C4975E] mx-2 text-2xl hover:text-white transition-colors"><i class="fa-brands fa-github"></i></a>
    </footer>

    <script>
        // Initialisation
        const equipped = { 
            left: <?= $hero->getPrimaryWeapon() ? "'" . $hero->getPrimaryWeapon()->getId() . "'" : 'null' ?>, 
            right: <?= $hero->getSecondaryWeapon() ? "'" . $hero->getSecondaryWeapon()->getId() . "'" : 'null' ?>, 
            armor: <?= $hero->getArmor() ? "'" . $hero->getArmor()->getId() . "'" : 'null' ?> 
        };

        const inputInventoryField = document.getElementById("inventoryDataField");

        function toggleInventory() {
            document.getElementById('inventoryModal').classList.toggle('hidden');
        }

        window.onclick = function(event) {
            const modal = document.getElementById('inventoryModal');
            if (event.target == modal) toggleInventory();
        }

        function updateHiddenField() {
            if(inputInventoryField) {
                inputInventoryField.value = 'Left: ' + equipped.left + ' Right: ' + equipped.right + ' Armor: ' + equipped.armor;
                console.log("Champ envoyé :", inputInventoryField.value);
            }
        }

        document.querySelectorAll('.equipment-button').forEach(button => {
            button.addEventListener("click", (event) => {
                const clickedButton = event.currentTarget;
                const slotType = clickedButton.dataset.equipmenttype;
                const itemCard = clickedButton.closest(".item-card");
                const itemId = String(itemCard.dataset.itemid);
                const itemQty = parseInt(itemCard.dataset.qty);

                if (clickedButton.classList.contains("active")) {
                    clickedButton.classList.remove("active");
                    equipped[slotType] = null;
                } else {
                    if (slotType === 'left' || slotType === 'right') {
                        const otherHand = (slotType === 'left') ? 'right' : 'left';
                        
                        if (String(equipped[otherHand]) === itemId && itemQty < 2) {
                            equipped[otherHand] = null;
                            document.querySelectorAll(`.item-card[data-itemid="${itemId}"] .equipment-button[data-equipmenttype="${otherHand}"]`)
                                .forEach(btn => btn.classList.remove("active"));
                        }
                    }

                    // Désactiver l'ancien item du même slot (ex: ancienne main gauche)
                    document.querySelectorAll(`.equipment-button[data-equipmenttype="${slotType}"]`).forEach(btn => {
                        btn.classList.remove("active");
                    });
                    
                    clickedButton.classList.add("active");
                    equipped[slotType] = itemId;
                }

                updateHiddenField();
            });
        });

        // Init au chargement
        updateHiddenField();
    </script>
</body>
</html>