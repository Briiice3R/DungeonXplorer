<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>DungeonXplorer</title>
</head>
<body>
    <header>
        <h1>Profil</h1>
    </header>
    <main>
        <?php echo '<img src="'.$profile->get_Photo().'" alt="Votre photo de profil" />'."</br>"; ?>
        <?php echo $profile->get_Name()."</br>"?>
        <?php echo $profile->get_Mail()."</br>"?>
        <form action="ProfileUpdatePage.php" method="post">
            <input type="submit" value="Modifier">
            <input type="submit" value="Supprimer">
        </form>
    </main>
    <footer>
</footer>
</body>

</html>