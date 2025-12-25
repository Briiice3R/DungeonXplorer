<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DungeonXplorer - Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Pirata+One&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #1A1A1A; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #C4975E; border-radius: 10px; }
    </style>
</head>
<body class="font-['Roboto'] text-[#E5E5E5] bg-[#1A1A1A] min-h-screen flex flex-col">

    <?php include_once (__DIR__ . "/Navbar/Navbar.php"); ?>

    <main class="flex-1 p-8 max-w-7xl mx-auto w-full">

        <?php if (isset($_GET['success'])): ?>
            <div class="bg-green-600/20 border border-green-600 text-green-500 p-4 rounded mb-6 text-center animate-pulse font-bold">
                <i class="fas fa-check-circle mr-2"></i>
                <?php 
                    // On affiche un texte différent selon la valeur de 'success'
                    switch($_GET['success']) {
                        case 'suppruser':
                            echo "Action réussie ! Le compte a été supprimé.";
                            break;
                        case 'supprchap':
                            echo "Action réussie ! Le chapitre a été supprimé.";
                            break;
                        case 'supprmonstre':
                            echo "Action réussie ! Le monstre a été supprimé.";
                            break;
                        case 'supprtreasure':
                            echo "Action réussie ! Le trésor a été supprimé.";
                            break;
                        case 'updateok':
                            echo "Action réussie ! Les modifications ont été effectuées !";
                            break;
                        case 'addok':
                            echo "Action réussie ! Le nouvel élément a été ajouté.";
                            break;
                        default:
                            echo "Action réussie !";
                    }
                ?>
            </div>
        <?php endif; ?>

        <div class="flex items-center gap-4 mb-12 border-b border-[#C4975E]/20 pb-6">
            <i class="fas fa-crown text-[#C4975E] text-5xl"></i>
            <h1 class="font-['Pirata_One'] text-6xl text-[#C4975E] tracking-wide">Dashboard Admin</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            
            <section class="bg-[#2E2E2E] rounded-lg border border-[#C4975E]/20 shadow-2xl flex flex-col overflow-hidden h-fit">
                <div class="p-6 border-b border-[#C4975E]/10 bg-[#1A1A1A]/30 flex justify-between items-center">
                    <h2 class="font-['Pirata_One'] text-3xl text-[#C4975E] flex items-center gap-3">
                        <i class="fas fa-users-slash"></i> Comptes des Joueurs
                    </h2>
                </div>
                
                <div class="p-4 max-h-[500px] overflow-y-auto custom-scrollbar">
                    <?php if (!empty($users)): ?>
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[#C4975E] font-['Pirata_One'] text-xl border-b border-[#C4975E]/10">
                                    <th class="p-2">Pseudo</th>
                                    <th class="p-2 hidden md:table-cell text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr class="border-b border-white/5 hover:bg-white/5 transition-colors group">
                                        <td class="p-3">
                                            <div class="font-bold"><?= htmlspecialchars($user['username']) ?></div>
                                            <div class="text-s text-gray-500"><?= htmlspecialchars($user['email']) ?></div>
                                        </td>
                                        <td class="p-3 text-right">
                                            <a href="/DungeonXplorer/admin/delete/user/<?= $user['id'] ?>" 
                                            onclick="return confirm('Voulez-vous vraiment supprimer <?= htmlspecialchars($user['username']) ?> à jamais ?');"
                                            class="inline-flex items-center justify-center px-4 py-2 rounded border border-red-600/30 text-red-600 font-bold uppercase text-[10px] tracking-widest hover:bg-red-600 hover:text-white hover:border-red-600 transition-all duration-300">
                                                <i class="fas fa-skull-crossbones mr-2"></i> Supprimer
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-center py-10 italic text-gray-500">Aucun compte ne hante le donjon...</p>
                    <?php endif; ?>
                </div>

                <div class="p-4 bg-[#1A1A1A]/30 border-t border-[#C4975E]/10">
                    <p class="text-xs text-red-500 text-center uppercase tracking-tighter font-bold">
                        <i class="fas fa-exclamation-triangle mr-1"></i> Lorsqu'un compte est supprimé, c'est définitif, soyez vigilant ! (Les administrateurs ne peuvent pas être supprimés)
                    </p>
                </div>
            </section>

            <section class="bg-[#2E2E2E] rounded-lg border border-[#C4975E]/20 shadow-2xl flex flex-col h-fit">
                <div class="p-6 border-b border-[#C4975E]/10 bg-[#1A1A1A]/30 flex justify-between items-center">
                    <h2 class="font-['Pirata_One'] text-3xl text-[#C4975E] flex items-center gap-3">
                        <i class="fas fa-hammer"></i> Forge du Monde
                    </h2>
                    <button onclick="openAddModal('<?= $type ?>')" class="bg-[#C4975E] text-[#1A1A1A] px-4 py-2 rounded-md text-s font-bold uppercase hover:bg-white transition-all">
                        <i class="fas fa-plus"></i> Ajouter
                    </button>
                </div>

                <div class="flex border-b border-[#C4975E]/10 bg-[#1A1A1A]/20">
                    <?php $type = $_GET['type'] ?? 'chapters'; ?>
                    <a href="?type=chapters" class="flex-1 text-center py-3 text-xs font-bold uppercase tracking-widest <?= $type === 'chapters' ? 'text-[#C4975E] border-b-2 border-[#C4975E] bg-white/5' : 'text-gray-500 hover:text-white' ?>">Chapitres</a>
                    <a href="?type=monsters" class="flex-1 text-center py-3 text-xs font-bold uppercase tracking-widest <?= $type === 'monsters' ? 'text-[#C4975E] border-b-2 border-[#C4975E] bg-white/5' : 'text-gray-500 hover:text-white' ?>">Monstres</a>
                    <a href="?type=treasures" class="flex-1 text-center py-3 text-xs font-bold uppercase tracking-widest <?= $type === 'treasures' ? 'text-[#C4975E] border-b-2 border-[#C4975E] bg-white/5' : 'text-gray-500 hover:text-white' ?>">Trésors</a>
                </div>
                
                <div class="p-4 max-h-[500px] overflow-y-auto custom-scrollbar">
                    <?php if (!empty($forgeItems)): ?>
                        <table class="w-full text-left border-collapse">
                            <tbody>
                            <?php foreach ($forgeItems as $item): ?>
                                <tr class="border-b border-white/5 hover:bg-white/5 transition-colors group">
                                    <td class="p-3">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 flex items-center justify-center rounded border border-[#C4975E]/20 bg-[#1A1A1A]">
                                                <?php if(!empty($item['image'])): ?>
                                                    <img src="/DungeonXplorer/<?= ltrim(htmlspecialchars($item['image']), '/') ?>" class="w-full h-full object-cover rounded">
                                                <?php else: ?>
                                                    <?php if ($type === 'treasures'): ?>
                                                        <i class="fas fa-coins text-[#C4975E]"></i>
                                                    <?php elseif ($type === 'monsters'): ?>
                                                        <i class="fas fa-dragon text-[#C4975E]"></i>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div>
                                                <div class="font-bold text-sm">
                                                    <?= htmlspecialchars($item['title'] ?? $item['name']) ?>
                                                </div>
                                                
                                                <?php if ($type === 'monsters'): ?>
                                                    <div class="text-[11px] text-[#C4975E] font-bold uppercase">
                                                        <?= htmlspecialchars($item['description'] ?? 'Pas de description') ?>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if ($type === 'treasures'): ?>
                                                    <div class="text-[15px] text-[#C4975E] uppercase italic">
                                                    Chapitre <?= htmlspecialchars($item['chapter_num']) ?> • Items : <?= htmlspecialchars($item['title']) ?> • Qté: <?= htmlspecialchars($item['quantity']) ?>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="text-[15px] text-gray-500 uppercase italic">
                                                        ID: <?= $item['id'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-3 text-right flex justify-end gap-2">
                                        <button onclick="openEditModal('<?= $type ?>', '<?= $item['id'] ?>')" class="p-2 text-gray-500 hover:text-[#C4975E] transition-colors">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="/DungeonXplorer/admin/delete/<?= $type ?>/<?= $item['id'] ?>"
                                            onclick="return confirm('Supprimer cet élément de la Forge ?');"
                                            class="p-2 text-gray-500 hover:text-red-500 transition-colors">
                                                <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-center py-10 italic text-gray-500">La forge est vide pour cette catégorie...</p>
                    <?php endif; ?>
                </div>
            </section>
        </div>

        <section class="mt-12 bg-[#2E2E2E] rounded-lg border border-[#C4975E]/20 shadow-2xl overflow-hidden">
            <div class="p-6 border-b border-[#C4975E]/10 bg-[#1A1A1A]/30 flex justify-between items-center">
                <h2 class="font-['Pirata_One'] text-3xl text-[#C4975E] flex items-center gap-3">
                    <i class="fas fa-images"></i> Bibliothèque d'Images
                </h2>
                <span class="text-xs text-gray-500 uppercase font-bold"><?= count($images) ?> Fichiers</span>
            </div>
            
            <div class="p-6 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 max-h-[400px] overflow-y-auto custom-scrollbar">
                <?php foreach ($images as $img): ?>
                    <div class="group relative aspect-square bg-[#1A1A1A] rounded border border-white/5 overflow-hidden hover:border-[#C4975E]/50 transition-all">
                        <img src="/DungeonXplorer/resources/images/<?= $img ?>" 
                            class="w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity" 
                            alt="<?= $img ?>">
                        
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                            <a href="/DungeonXplorer/admin/delete/image/<?= $img ?>" 
                            onclick="return confirm('Supprimer définitivement ce fichier ? (Assurez-vous qu\'il n\'est plus utilisé)');"
                            class="bg-red-600 text-white p-2 rounded-full hover:bg-red-700 transition-colors shadow-lg">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </a>
                        </div>

                        <div class="absolute bottom-0 left-0 right-0 bg-black/80 p-1 text-[8px] text-center truncate opacity-0 group-hover:opacity-100 transition-opacity">
                            <?= $img ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-[#1A1A1A]/60 border border-[#C4975E]/10 p-4 rounded-lg text-center shadow-lg">
                <span class="block text-[#C4975E] text-3xl font-['Pirata_One'] tracking-widest"><?= count($users) ?></span>
                <span class="text-[15px] uppercase text-gray-500 font-bold tracking-tighter">Total Joueurs</span>
            </div>
            <div class="bg-[#1A1A1A]/60 border border-[#C4975E]/10 p-4 rounded-lg text-center shadow-lg">
                <span class="block text-[#C4975E] text-3xl font-['Pirata_One'] tracking-widest"><?= $stats['chapters'] ?? '?' ?></span>
                <span class="text-[15px] uppercase text-gray-500 font-bold tracking-tighter">Total Chapitres</span>
            </div>
            <div class="bg-[#1A1A1A]/60 border border-[#C4975E]/10 p-4 rounded-lg text-center shadow-lg">
                <span class="block text-[#C4975E] text-3xl font-['Pirata_One'] tracking-widest"><?= $stats['monsters'] ?? '?' ?></span>
                <span class="text-[15px] uppercase text-gray-500 font-bold tracking-tighter">Total Monstres</span>
            </div>
            <div class="bg-[#1A1A1A]/60 border border-[#C4975E]/10 p-4 rounded-lg text-center shadow-lg">
                <span class="block text-[#C4975E] text-3xl font-['Pirata_One'] tracking-widest"><?= $stats['heroes'] ?? '?' ?></span>
                <span class="text-[15px] uppercase text-gray-500 font-bold tracking-tighter">Total Aventures</span>
            </div>
        </div>
    </main>

    <div id="editModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-[#2E2E2E] border-2 border-[#C4975E]/50 rounded-lg shadow-2xl w-full max-w-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
            
            <div class="p-6 border-b border-[#C4975E]/20 bg-[#1A1A1A]/50 flex justify-between items-center">
                <h2 id="modalTitle" class="font-['Pirata_One'] text-4xl text-[#C4975E] tracking-wide">Modifier l'élément</h2>
                <button onclick="closeModal()" class="text-gray-400 hover:text-white text-2xl">&times;</button>
            </div>

            <form id="editForm" action="" method="POST" enctype="multipart/form-data" class="p-8 space-y-6 max-h-[70vh] overflow-y-auto custom-scrollbar">
                <div id="modalInputs">
                    <p class="text-center italic text-gray-500">Chargement des données...</p>
                </div>

                <div class="flex justify-end gap-4 pt-6 border-t border-[#C4975E]/10">
                    <button type="button" onclick="closeModal()" class="px-6 py-2 rounded font-bold uppercase text-xs text-gray-400 hover:text-white transition-all">Annuler</button>
                    <button type="submit" class="bg-[#C4975E] text-[#1A1A1A] px-8 py-3 rounded font-bold hover:bg-white transition-all shadow-lg uppercase tracking-widest">
                        Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-[#2E2E2E] text-center p-4 mt-auto">
        <p class="mb-2">&copy; 2025 DungeonXplorer. Tous droits réservés.</p>
        <a href="https://github.com/Briiice3R/DungeonXplorer" class="text-[#C4975E] mx-2 text-2xl">
            <i class="fa-brands fa-github"></i>
        </a>
    </footer>

    <script>
        // Gère la prévisualisation de l'image sélectionnée sur l'ordi
        function initImageLogic() {
            const imageInput = document.getElementById('imageInput');
            const previewImage = document.getElementById('previewImage');

            if (imageInput && previewImage) {
                imageInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => { previewImage.src = e.target.result; };
                        reader.readAsDataURL(file);
                    }
                });
            }
        }

        // Injection des données PHP dans le JavaScript
        const monsterList = <?= json_encode($allMonsters ?? []) ?>;
        const itemList    = <?= json_encode($allItems ?? []) ?>;
        const chapterList = <?= json_encode($allChapters ?? []) ?>;
        const monsterTypeList = <?= json_encode($monsterTypes ?? []) ?>;

        function renderForgeInputs(type, data = {}, showImage = true) {
            let html = `<div class="space-y-4">`;

            if (type === 'monsters') {
                html += `
                    <div>
                        <label class="block text-[#C4975E] text-xs font-bold uppercase mb-2">Nom du Monstre</label>
                        <input type="text" name="display_name" value="${data.name || ''}" required class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-3 rounded text-white focus:border-[#C4975E] outline-none">
                    </div>
                    <div>
                        <label class="block text-[#C4975E] text-xs font-bold uppercase mb-2">Description / Capacités</label>
                        <textarea name="display_desc" rows="3" class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-3 rounded text-white focus:border-[#C4975E] outline-none">${data.description || ''}</textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div><label class="block text-[#C4975E] text-[10px] font-bold uppercase mb-1">PV</label><input type="number" step="0.1" name="pv" value="${data.pv || 0}" class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-2 rounded text-white"></div>
                        <div><label class="block text-[#C4975E] text-[10px] font-bold uppercase mb-1">Mana</label><input type="number" step="0.1" name="mana" value="${data.mana || 0}" class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-2 rounded text-white"></div>
                        <div><label class="block text-[#C4975E] text-[10px] font-bold uppercase mb-1">Force</label><input type="number" step="0.1" name="strength" value="${data.strength || 0}" class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-2 rounded text-white"></div>
                        <div><label class="block text-[#C4975E] text-[10px] font-bold uppercase mb-1">Initiative</label><input type="number" step="0.1" name="initiative" value="${data.initiative || 0}" class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-2 rounded text-white"></div>
                        <div><label class="block text-[#C4975E] text-[10px] font-bold uppercase mb-1">XP Drop</label><input type="number" step="0.1" name="drop_xp" value="${data.drop_xp || 0}" class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-2 rounded text-white"></div>
                        <div>
                            <label class="block text-[#C4975E] text-[10px] font-bold uppercase mb-1">Type de Monstre</label>
                            <select name="monster_type_id" class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-2 rounded text-white outline-none focus:border-[#C4975E]">
                                <option value="">-- Choisir un type --</option>
                                ${monsterTypeList.map(t => `
                                    <option value="${t.id}" ${data.monster_type_id == t.id ? 'selected' : ''}>
                                        ${t.name.replace('_', ' ')}
                                    </option>
                                `).join('')}
                            </select>
                        </div>
                    </div>`;
            } 
            else if (type === 'chapters') {
                const imgPath = data.image ? `/DungeonXplorer/${data.image}` : '/DungeonXplorer/resources/images/default_chapter.webp';
                const title = data.title || data.name || '';
                const description = data.description || '';
                const choices = data.choices || []; // Liste des choix d'un chapitre
                
                html += `
                    <div class="space-y-4 bg-[#1A1A1A]/50 p-4 rounded border border-[#C4975E]/10">
                        <h3 class="text-[#C4975E] font-['Pirata_One'] text-xl underline italic">Identité du Chapitre</h3>
                        
                        <input type="text" name="display_name" value="${data.title || data.name || ''}" placeholder="Titre du Chapitre" required 
                            class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-3 rounded text-white focus:border-[#C4975E] outline-none">
                        
                        <textarea name="description" placeholder="Récit de l'aventure..." rows="4" 
                            class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-3 rounded text-white focus:border-[#C4975E] outline-none">${data.description || ''}</textarea>
                        
                        <input type="file" name="image" id="imageInput" class="hidden" accept="image/*">
                        <label for="imageInput" class="cursor-pointer border border-dashed border-[#C4975E]/30 p-4 text-center block hover:bg-[#C4975E]/10 transition-colors">
                            <img src="${imgPath}" id="previewImage" class="h-24 mx-auto mb-2 object-cover rounded">
                            <span class="text-[10px] uppercase text-gray-500">Cliquer pour uploader une illustration</span>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-red-900/10 border border-red-900/20 rounded">
                            <label class="block text-red-500 text-[10px] font-bold uppercase mb-2">Monstre Présent</label>
                            <select name="monster_id" class="w-full bg-[#1A1A1A] border border-red-900/30 p-2 rounded text-white text-sm focus:border-red-500 outline-none">
                                <option value="">Aucun monstre</option>
                                ${monsterList.map(m => `<option value="${m.id}" ${data.monster_id == m.id ? 'selected' : ''}>${m.name}</option>`).join('')}
                            </select>
                        </div>

                        <div class="p-4 bg-yellow-900/10 border border-yellow-900/20 rounded">
                            <label class="block text-yellow-500 text-[10px] font-bold uppercase mb-2">Objet à ramasser</label>
                            <select name="item_id_simple" class="w-full bg-[#1A1A1A] border border-yellow-900/30 p-2 rounded text-white text-sm focus:border-yellow-500 outline-none">
                                <option value="">Aucun objet</option>
                                ${itemList.map(i => `<option value="${i.id}" ${data.item_id_simple == i.id ? 'selected' : ''}>${i.name}</option>`).join('')}
                            </select>
                        </div>

                        <div class="p-4 bg-blue-900/10 border border-blue-900/20 rounded">
                            <label class="block text-blue-500 text-[10px] font-bold uppercase mb-2">Butin Quantifiable</label>
                            <div class="flex gap-2">
                                <select name="treasure_item_id" class="flex-1 bg-[#1A1A1A] border border-blue-900/30 p-2 rounded text-white text-sm focus:border-blue-500 outline-none">
                                    <option value="">Objet...</option>
                                    ${itemList.map(i => `<option value="${i.id}" ${data.treasure_item_id == i.id ? 'selected' : ''}>${i.name}</option>`).join('')}
                                </select>
                                <input type="number" name="treasure_qty" value="${data.treasure_qty || ''}" placeholder="Qté" class="w-16 bg-[#1A1A1A] border border-blue-900/30 p-2 rounded text-white text-sm">
                            </div>
                        </div>
                        
                        <div class="p-4 bg-green-900/10 border border-green-900/20 rounded col-span-full">
                            <div class="flex justify-between items-center mb-4">
                                <label class="block text-green-500 text-[10px] font-bold uppercase">Suite de l'Aventure (Choix multiples)</label>
                                <button type="button" onclick="addChoiceRow()" class="text-[10px] bg-green-600 text-white px-2 py-1 rounded hover:bg-green-500 transition">
                                    <i class="fas fa-plus mr-1"></i> Ajouter un choix
                                </button>
                            </div>
                            
                            <div id="choicesContainer" class="space-y-3">
                                ${choices.length > 0 ? 
                                    choices.map((c, index) => generateChoiceHtml(c, index)).join('') : 
                                    generateChoiceHtml()
                                }
                            </div>
                        </div>
                    </div>
                `;
            } 
            else if (type === 'treasures') {
                html += `
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[#C4975E] text-xs font-bold uppercase mb-2">Chapitre lié</label>
                            <select name="display_chapter" required class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-3 rounded text-white focus:border-[#C4975E] outline-none">
                                <option value="">-- Sélectionner un chapitre --</option>
                                ${chapterList.map(c => `
                                    <option value="${c.id}" ${data.chapter_id == c.id ? 'selected' : ''}>
                                        Chapitre ${c.id} : ${c.title}
                                    </option>
                                `).join('')}
                            </select>
                        </div>

                        <div>
                            <label class="block text-[#C4975E] text-xs font-bold uppercase mb-2">Objet du trésor</label>
                            <select name="item_id" required class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-3 rounded text-white focus:border-[#C4975E] outline-none">
                                <option value="">-- Sélectionner un objet --</option>
                                ${itemList.map(i => `
                                    <option value="${i.id}" ${data.item_id == i.id ? 'selected' : ''}>
                                        ${i.name}
                                    </option>
                                `).join('')}
                            </select>
                        </div>

                        <div>
                            <label class="block text-[#C4975E] text-xs font-bold uppercase mb-2">Quantité</label>
                            <input type="number" name="quantite" value="${data.quantity || 1}" min="1" required 
                                class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-3 rounded text-white outline-none focus:border-[#C4975E]">
                        </div>
                    </div>`;
            }

            html += `</div>`;
            return html;
        }

        async function openEditModal(type, id) {
            const modal = document.getElementById('editModal');
            const inputsContainer = document.getElementById('modalInputs');
            modal.classList.remove('hidden');
            inputsContainer.innerHTML = '<p class="text-center italic text-gray-500">Chargement...</p>';

            try {
                const response = await fetch(`/DungeonXplorer/admin/forge/data/${type}/${id}`);
                const data = await response.json();
                document.getElementById('editForm').action = `/DungeonXplorer/admin/forge/update/${type}/${id}`;
                document.getElementById('modalTitle').innerText = `Modifier : ${data.title || data.name}`;
                inputsContainer.innerHTML = renderForgeInputs(type, data, true);
                initImageLogic(); // Active la prévisualisation
            } catch (error) {
                inputsContainer.innerHTML = '<p class="text-red-500">Erreur de lecture.</p>';
            }
        }

        function openAddModal(type) {
            const modal = document.getElementById('editModal');
            const inputsContainer = document.getElementById('modalInputs');
            modal.classList.remove('hidden');
            document.getElementById('editForm').action = `/DungeonXplorer/admin/forge/add/${type}`;
            document.getElementById('modalTitle').innerText = `Ajouter un nouveau ${type.slice(0, -1)}`;
            inputsContainer.innerHTML = renderForgeInputs(type, {}, true);
            initImageLogic(); // Active la prévisualisation
        }

        function generateChoiceHtml(choice = {}, index = Date.now()) {
            return `
                <div class="flex gap-2 items-start animate-in fade-in slide-in-from-left-2 duration-200" id="choice_row_${index}">
                    <input type="text" name="choice_text[]" value="${choice.choice_text || ''}" placeholder="Texte du bouton..." 
                        class="flex-1 bg-[#1A1A1A] border border-green-900/30 p-2 rounded text-white text-sm focus:border-green-500 outline-none">
                    
                    <select name="to_chapter_id[]" class="w-48 bg-[#1A1A1A] border border-green-900/30 p-2 rounded text-white text-sm focus:border-green-500 outline-none">
                        <option value="">Vers...</option>
                        ${chapterList.map(c => `<option value="${c.id}" ${choice.to_chapter_id == c.id ? 'selected' : ''}>Ch. ${c.id} : ${c.title}</option>`).join('')}
                    </select>

                    <button type="button" onclick="document.getElementById('choice_row_${index}').remove()" class="text-red-500 p-2 hover:bg-red-500/10 rounded transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
        }

        function addChoiceRow() {
            const container = document.getElementById('choicesContainer');
            if (container) {
                const div = document.createElement('div');
                div.innerHTML = generateChoiceHtml();
                container.appendChild(div.firstElementChild);
            }
        }

        function closeModal() { document.getElementById('editModal').classList.add('hidden'); }
    </script>

</body>
</html>