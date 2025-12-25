<?php 
@session_start();
// On récupère l'objet User pour vérifier le rôle si l'utilisateur est connecté
$isAdmin = false;
if (isset($_SESSION['userId'])) {
    $currentUser = \App\Models\User::find($_SESSION['userId']);
    // On suppose que ta colonne en BDD s'appelle 'role'
    if ($currentUser && $currentUser->isAdmin()) {
        $isAdmin = true;
    }
}
?>

<header class="bg-[#2E2E2E] border-b border-[#C4975E]/30 shadow-2xl px-6 py-3 w-full sticky top-0 z-50">
    <div class="max-w-full mx-auto flex items-center h-12">
        
        <div class="flex-1 flex justify-start">
            <a href="/DungeonXplorer/" class="flex items-center gap-4 group no-underline">
                <img src="/DungeonXplorer/resources/images/logoDungeon.png" 
                     class="w-12 h-auto transition-transform group-hover:scale-105 duration-300" 
                     alt="Logo">
                <h1 class="font-['Pirata_One'] text-3xl text-[#C4975E] tracking-wider m-0 hidden xl:block">
                    DUNGEONXPLORER
                </h1>
            </a>
        </div>

        <nav class="flex items-center justify-center gap-8 bg-[#1A1A1A]/40 px-6 py-2 rounded-full border border-[#C4975E]/10">
            <a href="/DungeonXplorer/" class="inline-flex items-center text-[#C4975E] font-['Pirata_One'] text-2xl no-underline hover:text-white transition-all hover:scale-110 tracking-widest uppercase">
                <i class="fas fa-home text-lg mr-3"></i>Accueil
            </a>
            
            <a href="/DungeonXplorer/aventureaccueil" class="inline-flex items-center text-[#C4975E] font-['Pirata_One'] text-2xl no-underline hover:text-white transition-all hover:scale-110 tracking-widest uppercase">
                <i class="fas fa-compass text-lg mr-3"></i>Aventure
            </a>

            <?php if ($isAdmin): ?>
                <div class="w-px h-6 bg-[#C4975E]/20 mx-2"></div> <a href="/DungeonXplorer/admin/dashboard" class="inline-flex items-center text-amber-400 font-['Pirata_One'] text-2xl no-underline hover:text-white transition-all hover:scale-110 tracking-widest uppercase">
                    <i class="fas fa-crown text-lg mr-3"></i>Admin
                </a>
            <?php endif; ?>
        </nav>

        <div class="flex-1 flex justify-end">
            <?php if (empty($_SESSION["userId"])): ?>
                <div class="flex items-center gap-4">
                    <a href="/DungeonXplorer/signup" class="text-[#C4975E] font-['Pirata_One'] text-2xl no-underline hover:text-white">Inscription</a>
                    <a href="/DungeonXplorer/login" class="bg-[#C4975E] text-[#1A1A1A] px-5 py-1 rounded font-['Pirata_One'] text-2xl no-underline hover:bg-[#8B1E1E] hover:text-white transition-all">Connexion</a>
                </div>
            <?php else: ?>
                <div class="flex items-center gap-6">
                    <a href='<?php echo "/DungeonXplorer/profile/" . $_SESSION["userId"];?>' class="flex items-center gap-2 text-[#C4975E] font-['Pirata_One'] text-2xl no-underline hover:text-white group">
                        <i class="fa-solid fa-user text-lg group-hover:animate-bounce"></i>
                        <span>Profil</span>
                    </a>
                    <a href="/DungeonXplorer/logout" class="flex items-center gap-2 bg-[#8B1E1E]/20 text-[#E5E5E5] px-4 py-1 rounded border border-[#8B1E1E]/40 font-['Pirata_One'] text-2xl no-underline hover:bg-[#8B1E1E] transition-all">
                        <i class="fa-solid fa-power-off"></i>
                        <span>Déconnexion</span>
                    </a>
                </div>
            <?php endif; ?>
        </div>

    </div>
</header>