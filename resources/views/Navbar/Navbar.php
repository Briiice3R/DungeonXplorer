<?php 
@session_start();
if (isset($_GET["logout"])) {
    unset($_SESSION["USER_ID"]);
    header("location: index.php");
    exit();
}
?>

<!-- Navigation -->
<header class="flex justify-between items-center bg-[#2E2E2E] p-2 w-full">
    <img src="resources/images/logoDungeon.png" class="w-20">
    <h1 class="font-['Pirata_One'] text-4xl text-[#C4975E] m-0 pl-4">DUNGEONXPLORER</h1>
    <div class="flex items-center flex-1 relative pr-4">
        <nav class="flex absolute left-1/2 transform -translate-x-1/2">
            <a href="/" class="text-[#C4975E] mx-4 font-['Pirata_One'] text-3xl no-underline hover:text-[#8B1E1E]">Accueil</a>
            <a href="/aventure" class="text-[#C4975E] mx-4 font-['Pirata_One'] text-3xl no-underline hover:text-[#8B1E1E]">Aventure</a>
        </nav>
        <?php if (empty($_SESSION["USER_ID"])): ?>
            <nav class="flex ml-auto">
                <a href="inscription.php" class="text-[#C4975E] mx-4 font-['Pirata_One'] text-3xl no-underline hover:text-[#8B1E1E]">Créer un compte</a>
                <a href="connexion.php" class="text-[#C4975E] mx-4 font-['Pirata_One'] text-3xl no-underline hover:text-[#8B1E1E]">Connexion</a>
            </nav>
        <?php else: ?>
        <nav class="flex ml-auto">
            <a href="/profile" class="text-[#C4975E] mx-4 font-['Pirata_One'] text-3xl no-underline hover:text-[#8B1E1E]"><i class="fa-solid fa-user mx-4"></i>Profil</a>
        </nav>
        <?php endif; ?>
    </div>
</header>