<?php
use App\Utils\SessionInitializer;
if (!isset($_SESSION["alreadyUsedEmail"])) {
    $_SESSION["alreadyUsedEmail"] = "False";
}
if (!isset($_SESSION["alreadyUsedUsername"])) {
    $_SESSION["alreadyUsedUsername"] = "False";
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h1>SignUp</h1>
    <form action="/signup" method="POST">
        <label>Username : </label><input id="username" name="username" type="text">
        <?php 
            if($_SESSION["alreadyUsedUsername"]=="True"){
                echo "<label>Nom d'utilisateur déjà utilisé</label>";
            }
        ?>
        <label>Email address : </label><input id="email" name="email" type="text">
        <?php 
            if($_SESSION["alreadyUsedEmail"]=="True"){
                echo "<label>Adresse email déjà utilisé</label>";
            }
        ?>
        <label>Password : </label><input id="password_1" name="password_1" type="password">
        <label>Confirm Password : </label><input id="password_2" name="password_2" type="password">
        <label><input type="radio" name="genre" value="H">Homme</label><label><input type="radio" name="genre" value="F">Femme</label><label><input type="radio" name="genre" value="A">Autre</label>
        
        <input type="submit" value="Send">
    </form>
</body>
</html>