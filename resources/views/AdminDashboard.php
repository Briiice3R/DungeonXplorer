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
                                                
                                                <?php if ($type === 'treasures'): ?>
                                                    <div class="text-[15px] text-[#C4975E] uppercase italic">
                                                        Chapitre <?= $item['subtitle'] ?> • Qté: <?= $item['quantity'] ?>
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
                <span class="text-[15px] uppercase text-gray-500 font-bold tracking-tighter">Total Aventures en cours</span>
            </div>
        </div>
    </main>

    <div id="editModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-[#2E2E2E] border-2 border-[#C4975E]/50 rounded-lg shadow-2xl w-full max-w-2xl overflow-hidden animate-in fade-in zoom-in duration-300">
            
            <div class="p-6 border-b border-[#C4975E]/20 bg-[#1A1A1A]/50 flex justify-between items-center">
                <h2 id="modalTitle" class="font-['Pirata_One'] text-4xl text-[#C4975E] tracking-wide">Modifier l'élément</h2>
                <button onclick="closeModal()" class="text-gray-400 hover:text-white text-2xl">&times;</button>
            </div>

            <form id="editForm" action="" method="POST" class="p-8 space-y-6 max-h-[70vh] overflow-y-auto custom-scrollbar">
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
        // Génère dynamiquement les champs du formulaire selon le type d'entité
        function renderForgeInputs(type, data = {}) {
            let html = `<div class="space-y-4">`;

            // Configuration pour les MONSTRES
            if (type === 'monsters') {
                html += `
                    <div>
                        <label class="block text-[#C4975E] text-xs font-bold uppercase mb-2">Nom du Monstre</label>
                        <input type="text" name="display_name" value="${data.name || ''}" required class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-3 rounded text-white focus:border-[#C4975E] outline-none">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div><label class="block text-[#C4975E] text-[10px] font-bold uppercase mb-1">PV</label><input type="number" step="0.1" name="pv" value="${data.pv || 0}" class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-2 rounded text-white"></div>
                        <div><label class="block text-[#C4975E] text-[10px] font-bold uppercase mb-1">Mana</label><input type="number" step="0.1" name="mana" value="${data.mana || 0}" class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-2 rounded text-white"></div>
                        <div><label class="block text-[#C4975E] text-[10px] font-bold uppercase mb-1">Force</label><input type="number" step="0.1" name="strength" value="${data.strength || 0}" class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-2 rounded text-white"></div>
                        <div><label class="block text-[#C4975E] text-[10px] font-bold uppercase mb-1">XP Drop</label><input type="number" step="0.1" name="drop_xp" value="${data.drop_xp || 0}" class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-2 rounded text-white"></div>
                    </div>
                `;
            } 
            // --- Configuration pour les CHAPITRES
            else if (type === 'chapters') {
                html += `
                    <div>
                        <label class="block text-[#C4975E] text-xs font-bold uppercase mb-2">Titre du Chapitre</label>
                        <input type="text" name="display_name" value="${data.title || ''}" required class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-3 rounded text-white focus:border-[#C4975E] outline-none">
                    </div>
                    <div>
                        <label class="block text-[#C4975E] text-xs font-bold uppercase mb-2">Image (Chemin)</label>
                        <input type="text" name="image" value="${data.image || ''}" placeholder="resources/images/nom.jpg" class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-3 rounded text-white focus:border-[#C4975E] outline-none">
                    </div>
                    <div>
                        <label class="block text-[#C4975E] text-xs font-bold uppercase mb-2">Récit du Chapitre</label>
                        <textarea name="description" rows="6" class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-3 rounded text-white focus:border-[#C4975E] outline-none">${data.description || ''}</textarea>
                    </div>
                `;
            } 
            // Configuration pour les TRESORS
            else if (type === 'treasures') {
                html += `
                    <div>
                        <label class="block text-[#C4975E] text-xs font-bold uppercase mb-2">ID du Chapitre lié</label>
                        <input type="number" name="display_chapter" value="${data.chapter_id || ''}" required class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-3 rounded text-white focus:border-[#C4975E] outline-none">
                    </div>
                    <div>
                        <label class="block text-[#C4975E] text-xs font-bold uppercase mb-2">ID de l'Objet</label>
                        <input type="number" name="item_id" required class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-3 rounded text-white">
                    </div>
                    <div>
                        <label class="block text-[#C4975E] text-xs font-bold uppercase mb-2">Quantité</label>
                        <input type="number" name="quantite" value="${data.quantity || 1}" required class="w-full bg-[#1A1A1A] border border-[#C4975E]/30 p-3 rounded text-white focus:border-[#C4975E] outline-none">
                    </div>
                `;
            }

            html += `</div>`;
            return html;
        }

        // Ouvre le modèle en mode MODIFICATION
        async function openEditModal(type, id) {
            const modal = document.getElementById('editModal');
            const inputsContainer = document.getElementById('modalInputs');
            modal.classList.remove('hidden');
            inputsContainer.innerHTML = '<p class="text-center italic text-gray-500">Lecture du grimoire...</p>';

            try {
                const response = await fetch(`/DungeonXplorer/admin/forge/data/${type}/${id}`);
                const data = await response.json();

                document.getElementById('editForm').action = `/DungeonXplorer/admin/forge/update/${type}/${id}`;
                document.getElementById('modalTitle').innerText = `Modifier : ${data.title || data.name}`;
                inputsContainer.innerHTML = renderForgeInputs(type, data);
            } catch (error) {
                inputsContainer.innerHTML = '<p class="text-red-500">Erreur lors de la lecture du grimoire.</p>';
            }
        }

        // Ouvre le modèle en mode AJOUT
        function openAddModal(type) {
            const modal = document.getElementById('editModal');
            const inputsContainer = document.getElementById('modalInputs');
            modal.classList.remove('hidden');

            // On change l'action vers 'store' au lieu de 'update'
            document.getElementById('editForm').action = `/DungeonXplorer/admin/forge/add/${type}`;
            document.getElementById('modalTitle').innerText = `Ajouter un nouveau ${type.slice(0, -1)}`;
            
            // On appelle render sans data pour avoir des champs vides
            inputsContainer.innerHTML = renderForgeInputs(type);
        }

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
        </script>

</body>
</html>