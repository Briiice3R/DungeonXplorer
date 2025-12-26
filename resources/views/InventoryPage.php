<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="icon" href="/DungeonXplorer/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DungeonXplorer - Inventaire</title>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../resources/js/InventoryPageSystem.js" defer></script>
</head>

<body class="font-['Roboto'] text-[#E5E5E5] bg-[#1A1A1A] min-h-screen flex flex-col">

    <?php include_once (__DIR__ . "/Navbar/Navbar.php"); ?>

    <main class="flex-1 flex flex-col items-center p-8">
        
        <h1 class="font-['Pirata_One'] text-5xl md:text-7xl text-[#C4975E] mb-8 tracking-wider text-center">
            Inventaire
        </h1>

        <div class="bg-[#2E2E2E] p-6 rounded-xl border border-[#C4975E]/30 shadow-lg w-full max-w-4xl">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($hero->getInventoryItems()->getItems() as $slot): ?>
                    <?php 
                        $item = $slot->getItem();
                        $itemId = $item->getId();
                        $type = $item->getItemType()->getCategory();
                    ?>
                    <div class="item-card bg-[#1F1F1F] p-4 rounded-lg border border-[#C4975E]/20 shadow-md"
                        data-itemid="<?= $itemId ?>"
                        data-type="<?= htmlspecialchars($type) ?>">

                        <h3 class="text-[#C4975E] font-bold text-lg mb-2">
                            <?= htmlspecialchars($item->getName()) ?>
                        </h3>

                        <p class="text-gray-400 text-sm mb-2">
                            Quantité : <?= htmlspecialchars($slot->getQuantity()) ?>
                        </p>

                        <p class="text-gray-500 text-xs mb-3 italic">
                            <?= htmlspecialchars($type) ?>
                        </p>

                        <div class="flex gap-2">
                            <?php if ($type === "Arme"): ?>
                                <button class="equipment-button left bg-[#C4975E]/30 hover:bg-[#C4975E] text-xs py-1 px-2 rounded" data-equipmentType="left" >
                                    Main Gauche
                                </button>
                                <button class="equipment-button right bg-[#C4975E]/30 hover:bg-[#C4975E] text-xs py-1 px-2 rounded" data-equipmentType="right">
                                    Main Droite
                                </button>
                            <?php elseif ($type === "Armure"): ?>
                                <button class="equipment-button armor bg-[#C4975E]/30 hover:bg-[#C4975E] text-xs py-1 px-2 rounded" data-equipmentType="armor">
                                    Équiper
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>

                <form action="../saveInventory/<?=$hero->getId()?>" method="POST" class="text-center mt-6">
                    <input type="hidden" id="inventoryDataField" name="equippedData">
                    <input type="submit" value="Sauvegarder" 
                        class="w-1/2 bg-[#C4975E] hover:bg-red-800 text-white rounded-md p-2 cursor-pointer font-['Pirata_One'] text-2xl mx-auto block">
                </form>
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